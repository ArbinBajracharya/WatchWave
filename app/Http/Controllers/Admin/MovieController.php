<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Video;
use App\Models\Admin\Cast;
use App\Models\Admin\Director;
use App\Models\User;
use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Video::get();

        foreach ($movies as $movie) {
            $movie->genre = json_decode($movie->genre);
            $movie->cast = json_decode($movie->cast);
            $movie->director = json_decode($movie->director);
        }

        return view('admin.movies.movies_list', compact('movies'));
    }

    public function active_list()
    {
        $actives = Video::where('homepage', 'active')->get();

        foreach ($actives as $movie) {
            $movie->genre = json_decode($movie->genre);
            $movie->cast = json_decode($movie->cast);
            $movie->director = json_decode($movie->director);
        }

        $movies = Video::where('homepage',NUll)->get();

        foreach ($movies as $movie) {
            $movie->genre = json_decode($movie->genre);
            $movie->cast = json_decode($movie->cast);
            $movie->director = json_decode($movie->director);
        }

        return view('admin.movies.movies_sider', compact('movies', 'actives'));
    }

    public function add()
    {
        return view('admin.movies.movies_add');
    }

    public function edit($id)
    {
        $video = Video::find($id);
        return view('admin.movies.movies_edit', compact('video'));
    }

    public function delete($id)
    {
        $video = Video::find($id);
        if ($video) {
            // Delete the video file
            $videoPath = public_path('videos/' . $video->video);
            if (!empty($video->video) && file_exists($videoPath) && is_file($videoPath)) {
                unlink($videoPath);
            }

            // Delete the picture file
            $picturePath = public_path('images/' . $video->picture);
            if (!empty($video->picture) && file_exists($picturePath) && is_file($picturePath)) {
                unlink($picturePath);
            }

            // Delete the trailer file
            $trailerPath = public_path('videos/' . $video->trailer);
            if (!empty($video->trailer) && file_exists($trailerPath) && is_file($trailerPath)) {
                unlink($trailerPath);
            }

            // Delete the DB record
            $video->delete();
        }


        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully!');
        
    }

    public function active_movie($id)
    {
        $video = Video::find($id);
        if ($video) {
            $video->homepage = 'active';
            $video->save();
        }

        return redirect()->route('admin.movies.sidebar')->with('success', 'Movie activated successfully!');
    }

    public function inactive_movie($id)
    {
        $video = Video::find($id);
        if ($video) {
            $video->homepage = NULL;
            $video->save();
        }

        return redirect()->route('admin.movies.sidebar')->with('success', 'Movie deactivated successfully!');
    }

    public function save(Request $request)
    {
        $videoData['title'] = $request->input('title');
        $videoData['genre'] = json_encode($request->input('genre'));
        $videoData['country'] = $request->input('country');
        $videoData['type'] = $request->input('type');
        $videoData['language'] = $request->input('language');
        $videoData['countyry'] = $request->input('country');
        $videoData['cast'] = json_encode(array_map('trim', explode(',', $request->input('cast')[0])));
        $videoData['director'] = json_encode(array_map('trim', explode(',', $request->input('director')[0])));
        $videoData['relase_date'] = $request->input('release_date');
        $videoData['duration'] = $request->input('duration');
        $videoData['description'] = $request->input('description');

        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $pictureName = time() . '.' . $picture->getClientOriginalExtension();
            
            // Compress and save the image
            $compressedImage = Image::make($picture)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize();      // Prevent upsizing
                })
                ->encode('jpg', 75); // Adjust quality (75% here)
            
            $compressedImage->save(public_path('images/' . $pictureName));
            
            $videoData['picture'] = $pictureName;
        }

        if ($request->filled('video_path')) {
            $videoData['video'] = basename($request->input('video_path'));
        }

        if ($request->hasFile('trailer')) {
            $videoFile = $request->file('trailer');
            $videoName = time() . '.' . $videoFile->getClientOriginalExtension();
            
            // Move the video to the public/videos directory
            $videoFile->move(public_path('videos'), $videoName);
            
            // Add the video name to your data array
            $videoData['trailer'] = $videoName;
        }

        $video = Video::create($videoData);

        // Save the video ID to the cast tables
        $casts = json_decode($video->cast);

        foreach ($casts as $castName) {
            // Find if cast already exists
            $existingCast = Cast::where('name', $castName)->first();
        
            if ($existingCast) {
                // Decode the current video_id array (if it exists), or create an empty array if not
                $videoIds = json_decode($existingCast->movie_id, true) ?: [];
        
                // Add the new video_id to the array, if it's not already there
                if (!in_array($video->id, $videoIds)) {
                    $videoIds[] = $video->id;
                }
        
                // Update the cast with the new video_id array (without replacing)
                $existingCast->movie_id = json_encode($videoIds);
                $existingCast->save();
            } else {
                // Create a new cast with the video_id as a JSON array
                Cast::create([
                    'name' => $castName,
                    'movie_id' => json_encode([$video->id]),
                ]);
            }
        }

        // Save the video ID to the director tables
        $directors = json_decode($video->director);

        foreach ($directors as $directorName) {
            // Find if cast already exists
            $existingDirector = Director::where('name', $directorName)->first();
        
            if ($existingDirector) {
                // Decode the current video_id array (if it exists), or create an empty array if not
                $videoIds = json_decode($existingDirector->movie_id, true) ?: [];
        
                // Add the new video_id to the array, if it's not already there
                if (!in_array($video->id, $videoIds)) {
                    $videoIds[] = $video->id;
                }
        
                // Update the cast with the new video_id array (without replacing)
                $existingDirector->movie_id = json_encode($videoIds);
                $existingDirector->save();
            } else {
                // Create a new cast with the video_id as a JSON array
                Director::create([
                    'name' => $directorName,
                    'movie_id' => json_encode([$video->id]),
                ]);
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie added successfully!');
    }

    public function update(Request $request)
    {
       
        $video = Video::find($request->input('id'));
        $video->title = $request->input('title');   
        $video->genre = json_encode($request->input('genre'));
        $video->country = $request->input('country');
        $video->type = $request->input('type');
        $video->language = $request->input('language');
        $video->country = $request->input('country');
        $video->cast = json_encode(array_map('trim', explode(',', $request->input('cast')[0])));
        $video->director = json_encode(array_map('trim', explode(',', $request->input('director')[0])));
        $video->relase_date = $request->input('release_date');
        $video->duration = $request->input('duration');
        $video->description = $request->input('description');

        if ($request->hasFile('picture')) {
            // Delete the old picture if it exists
            if (!empty($video->picture)) {
                $oldPath = public_path('images/' . $video->picture);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
        
            $picture = $request->file('picture');
            $pictureName = time() . '.' . $picture->getClientOriginalExtension();
        
            // Compress and save the image
            $compressedImage = Image::make($picture)
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio(); // Maintain aspect ratio
                    $constraint->upsize();      // Prevent upsizing
                })
                ->encode('jpg', 75); // Adjust quality (75% here)
        
            $compressedImage->save(public_path('images/' . $pictureName));
        
            $video->picture = $pictureName;
        }

        if ($request->filled('video_path')) {
            // Delete old video file
            if (!empty($video->video)) {
                $oldVideoPath = public_path('videos/' . $video->video);
                if (file_exists($oldVideoPath) && is_file($oldVideoPath)) {
                    unlink($oldVideoPath);
                }
            }

            if (!empty($video->trailer)) {
                $oldTrailerPath = public_path('videos/' . $video->trailer);
                if (file_exists($oldTrailerPath) && is_file($oldTrailerPath)) {
                    unlink($oldTrailerPath);
                }
            }

            $video->video = basename($request->input('video_path'));
            $video->trailer = NULL;
        }
        
        // Update trailer file
        if ($request->hasFile('trailer')) {
            // Delete old trailer file
            if (!empty($video->trailer)) {
                $oldTrailerPath = public_path('trailer/' . $video->trailer);
                if (file_exists($oldTrailerPath) && is_file($oldTrailerPath)) {
                    unlink($oldTrailerPath);
                }
            }
        
            $trailerFile = $request->file('trailer');
            $trailerName = time() . '.' . $trailerFile->getClientOriginalExtension();
        
            // Move new trailer to public/trailer
            $trailerFile->move(public_path('trailer'), $trailerName);
        
            $video->trailer = $trailerName;
        }

        $video->save();


        // --- HANDLE CASTS ---
        $oldCasts = Cast::whereJsonContains('movie_id', $video->id)->get();
        $newCastNames = json_decode($video->cast) ?? [];

        // Remove video ID from casts that are no longer assigned
        foreach ($oldCasts as $oldCast) {
            if (!in_array($oldCast->name, $newCastNames)) {
                $videoIds = json_decode($oldCast->movie_id, true) ?: [];
                $videoIds = array_filter($videoIds, fn($id) => $id != $video->id); // Remove this movie ID
                $oldCast->movie_id = json_encode(array_values($videoIds)); // Reset index
                $oldCast->save();
            }
        }

        // Add or update casts
        foreach ($newCastNames as $castName) {
            $existingCast = Cast::where('name', $castName)->first();

            if ($existingCast) {
                $videoIds = json_decode($existingCast->movie_id, true) ?: [];
                if (!in_array($video->id, $videoIds)) {
                    $videoIds[] = $video->id;
                }
                $existingCast->movie_id = json_encode($videoIds);
                $existingCast->save();
            } else {
                Cast::create([
                    'name' => $castName,
                    'movie_id' => json_encode([$video->id]),
                ]);
            }
        }


        // --- HANDLE DIRECTORS ---
        $oldDirectors = Director::whereJsonContains('movie_id', $video->id)->get();
        $newDirectorNames = json_decode($video->director) ?? [];

        // Remove video ID from directors no longer assigned
        foreach ($oldDirectors as $oldDirector) {
            if (!in_array($oldDirector->name, $newDirectorNames)) {
                $videoIds = json_decode($oldDirector->movie_id, true) ?: [];
                $videoIds = array_filter($videoIds, fn($id) => $id != $video->id);
                $oldDirector->movie_id = json_encode(array_values($videoIds));
                $oldDirector->save();
            }
        }

        // Add or update directors
        foreach ($newDirectorNames as $directorName) {
            $existingDirector = Director::where('name', $directorName)->first();

            if ($existingDirector) {
                $videoIds = json_decode($existingDirector->movie_id, true) ?: [];
                if (!in_array($video->id, $videoIds)) {
                    $videoIds[] = $video->id;
                }
                $existingDirector->movie_id = json_encode($videoIds);
                $existingDirector->save();
            } else {
                Director::create([
                    'name' => $directorName,
                    'movie_id' => json_encode([$video->id]),
                ]);
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }
}
