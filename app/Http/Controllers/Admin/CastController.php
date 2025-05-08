<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Cast;
use Intervention\Image\Facades\Image;

class CastController extends Controller
{
    //
    public function index()
    {
        $casts = Cast::get();
        return view('admin.cast.cast_list', compact('casts'));
    }
    public function edit($id)
    {
        $cast = Cast::find($id);
        return view('admin.cast.cast_edit', compact('cast'));
    }
    public function update(Request $request)
    {
        $cast = Cast::find($request->id);
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
            
            $cast['picture'] = $pictureName;
        }
        $cast['name'] = $request->name;
        $cast['dob'] = $request->dob;
        $cast['country'] = $request->country;
        $cast['descripton'] = $request->description;
        $cast->save();

        return redirect()->route('admin.cast.index')->with('success', 'Cast updated successfully!');
    }
    public function delete($id)
    {
        $cast = Cast::find($id);
        $cast->delete();
        return redirect()->route('admin.cast.index')->with('success', 'Cast deleted successfully!');
    }
}
