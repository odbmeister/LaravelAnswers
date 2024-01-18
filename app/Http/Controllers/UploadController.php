<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use File;

class UploadController extends Controller
{
    public function getUpload()
    {
        return view('upload');
    }

    public function postUpload(Request $request)
    {
        $user = Auth::user();

        // Check if a file is present in the request
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');

            // Ensure that the file is not null before trying to get properties
            if ($file->isValid()) {
                $filename = uniqid($user->id . "_") . "." . $file->getClientOriginalExtension();
                Storage::disk('public')->put($filename, File::get($file));

                $url = asset('storage/' . $filename);

                // Update the user record with the new profile pic filename
                $user->profile_pic = $filename;
                $user->save();

                // create the thumbnail and save it
                //$thumb = Image::make($file);
                //$thumb->fit(200);
                //$jpg = (string) $thumb->encode('jpg');

                //$thumbName = pathinfo($filename, PATHINFO_FILENAME).'-thumb.jpg';
                //Storage::disk('public')->put($thumbName, $jpg, 'public');

                return redirect('/upload-complete')->with('filename', $filename)->with('url', $url);
            } else {
                // Handle case where the file is not valid
                return redirect()->route('upload')->withErrors(['error' => 'Invalid file. Please upload a valid image file.'])->withInput();
            }
        } else {
            // Handle case where no file was uploaded
            return redirect()->route('upload')->withErrors(['error' => 'No file selected. Please choose an image file to upload.'])->withInput();
        }
    }
}
