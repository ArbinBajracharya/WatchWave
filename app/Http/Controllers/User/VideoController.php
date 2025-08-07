<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class VideoController extends Controller
{
    public function stream($filename)
    {
        // Set the path to your video file
        $path = public_path('videos/' . $filename);

        // Rest of the function remains exactly the same
        if (!file_exists($path)) {
            abort(404, 'Video file not found');
        }

        // Get file size
        $size = filesize($path);
        $mimeType = mime_content_type($path);
        
        // Validate mime type is video
        if (strpos($mimeType, 'video/') !== 0) {
            abort(400, 'Invalid video file');
        }

        // Open the file
        $stream = fopen($path, 'rb');
        if (!$stream) {
            abort(500, 'Could not open video file');
        }

        // Prepare response headers
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Length' => $size,
            'Accept-Ranges' => 'bytes',
        ];

        // Check for range request from the browser
        if (request()->hasHeader('Range')) {
            $range = request()->header('Range');
            
            // Parse the range header
            if (preg_match('/bytes=(\d+)-(\d+)?/', $range, $matches)) {
                $start = (int)$matches[1];
                $end = isset($matches[2]) ? (int)$matches[2] : $size - 1;
                
                // Validate range
                if ($start >= $size || $end >= $size || $start > $end) {
                    fclose($stream);
                    abort(416, 'Requested range not satisfiable');
                }
                
                $length = $end - $start + 1;
                fseek($stream, $start);
                
                // Set partial content headers
                $headers['Content-Range'] = sprintf('bytes %d-%d/%d', $start, $end, $size);
                $headers['Content-Length'] = $length;
                
                return response()->stream(function() use ($stream, $length) {
                    $bytesSent = 0;
                    $chunkSize = 8192; // 8KB chunks
                    
                    while ($bytesSent < $length && !feof($stream)) {
                        $bytesToSend = min($chunkSize, $length - $bytesSent);
                        echo fread($stream, $bytesToSend);
                        $bytesSent += $bytesToSend;
                        flush(); // Flush system output buffer
                    }
                    fclose($stream);
                }, 206, $headers);
            }
        }

        // Full file response if no range requested
        return response()->stream(function() use ($stream) {
            fpassthru($stream);
            fclose($stream);
        }, 200, $headers);
    }
}
