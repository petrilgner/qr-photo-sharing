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
        dump($uploadedFiles);

        foreach ($uploadedFiles as $file) {
            dump($file);
            // Generate a unique name for the file
            $parts = [time()];
            $parts[] = $file->getClientOriginalName();
            $filename = implode('_', $parts);
            // Save the file to the storage (public disk)
            $path = $file->storeAs('uploads', $filename, 'public');
            // Store the file path
            $filePaths[] = $path;
            Log::info("$file:$name");
        }

        Log::info(implode($filePaths));

        // return the result
        return response()->json('success');
    }


}
