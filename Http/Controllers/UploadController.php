<?php

namespace Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function uploadLargeFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:102400', // max 100MB
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $uuid = (string) Str::uuid();

        $chunkDir = "chunks/{$uuid}";
        Storage::makeDirectory($chunkDir);

        $chunkSize = 5 * 1024 * 1024; // 5MB
        $fileStream = fopen($file->getRealPath(), 'rb');
        $index = 0;

        while (!feof($fileStream)) {
            $chunk = fread($fileStream, $chunkSize);
            Storage::put("{$chunkDir}/chunk_{$index}", $chunk);
            $index++;
        }

        fclose($fileStream);

        // Now assemble the chunks
        $finalPath = "uploads/{$originalName}";
        $assembledFile = '';

        for ($i = 0; $i < $index; $i++) {
            $assembledFile .= Storage::get("{$chunkDir}/chunk_{$i}");
        }

        Storage::put($finalPath, $assembledFile);
        Storage::deleteDirectory($chunkDir);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded and assembled successfully.',
            'file_path' => $finalPath,
        ]);
    }
}
