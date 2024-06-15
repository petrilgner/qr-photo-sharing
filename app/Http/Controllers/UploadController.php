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
            if($name) {
                $parts[] = self::webalize($name);
            }
            $parts[] = $file->getClientOriginalName();

            // Save the file to the storage (public disk)
            $path = $file->storeAs('uploads', implode('_', $parts), 'public');
            // Store the file path
            $filePaths[] = $path;
        }

        Log::info(implode($filePaths));

        // return the result
        return response()->json('success');
    }

    private static function webalize($string)
    {
        // Convert to lowercase
        $string = strtolower($string);

        // Remove accents
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

        // Replace non-alphanumeric characters with dashes
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);

        // Trim dashes from the beginning and end
        $string = trim($string, '-');

        return $string;
    }


}
