<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoUploadController extends Controller
{
    public function uploadChunk(Request $request)
    {
        $chunkDir = storage_path('app/chunks');
        if (!is_dir($chunkDir)) {
            mkdir($chunkDir, 0777, true);
        }

        $identifier = $request->resumableIdentifier;
        $originalFilename = $request->resumableFilename;
        $chunkNumber = $request->resumableChunkNumber;

        $chunkPath = $chunkDir . "/{$identifier}.part{$chunkNumber}";

        $request->file('file')->move($chunkDir, "{$identifier}.part{$chunkNumber}");

        // Check if all chunks are uploaded
        $totalChunks = $request->resumableTotalChunks;
        $allChunksUploaded = true;

        for ($i = 1; $i <= $totalChunks; $i++) {
            if (!file_exists($chunkDir . "/{$identifier}.part{$i}")) {
                $allChunksUploaded = false;
                break;
            }
        }

        if ($allChunksUploaded) {
            // Rename file with timestamp + original extension
            $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
            $newFilename = time() . '.' . $extension;

            $finalPath = public_path('videos/' . $newFilename);
            $output = fopen($finalPath, 'ab');

            for ($i = 1; $i <= $totalChunks; $i++) {
                $chunk = file_get_contents($chunkDir . "/{$identifier}.part{$i}");
                fwrite($output, $chunk);
                unlink($chunkDir . "/{$identifier}.part{$i}");
            }

            fclose($output);

            return response()->json([
                'done' => true,
                'path' => '/videos/' . $newFilename,
                'filename' => $newFilename
            ]);
        }

        return response()->json(['chunk_received' => true]);
    }

}
