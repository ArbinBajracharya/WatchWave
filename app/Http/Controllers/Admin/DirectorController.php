<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Director;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DirectorController extends Controller
{
    public function index()
    {
        $directors = Director::get();
        return view('admin.director.director_list', compact('directors'));
    }
    public function edit($id)
    {
        $director = Director::find($id);
        return view('admin.director.director_edit', compact('director'));
    }
    public function update(Request $request)
    {
        $director = Director::find($request->id);
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
            
            $compressedImage->save(public_path('images/casts/' . $pictureName));
            
            $director['picture'] = $pictureName;
        }
        $director['name'] = $request->name;
        $director['dob'] = $request->dob;
        $director['country'] = $request->country;
        $director['descripton'] = $request->description;
        $director->save();

        return redirect()->route('admin.director.index')->with('success', 'Cast updated successfully!');
    }
    public function delete($id)
    {
        $director = Director::find($id);
        $director->delete();
        return redirect()->route('admin.director.index')->with('success', 'Cast deleted successfully!');
    }
}
