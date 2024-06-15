<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

class UploadController
{
    /**
     * Show the form page
     */
    public function indexUpload()
    {
        return view('upload');
    }

    public function thanks()
    {
        return view('thanks');
    }

    /**
     * Handle the form submission
     */
    public function submitUpload(Request $request)
    {
        $uploadedFiles = $request->file('file');
        $name = $request->input('name');
        $filePaths = [];

        foreach ($uploadedFiles as $file) {
            // Generate a unique name for the file
            $parts = [time()];
            $parts[] = $file->getClientOriginalName();
            $filename = implode('_', $parts);
            // Save the file to the storage (public disk)
            $path = $file->storeAs('uploads', $filename, 'public');

            Log::info("$filename:$name");
        }

        // return the result
        return response()->json('success');
    }


}
