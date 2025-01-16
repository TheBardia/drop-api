<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Drop;
use App\Models\DropFile;

class FileUploadController extends Controller
{

    public function upload(Request $request)
    {
        \Log::info('Request Data:', $request->all());

        $request->validate([
            'user_id' => 'required', // Accept user_id as is, no validation against a table
            'files.*' => 'required|file|max:10240', // Each file max 10MB. Need to change this later
        ]);
    
        $folderName = uniqid('drop_');
    
        \Log::info('User ID:', [$request->input('user_id')]);

        $drop = Drop::create([
            'name' => $request->input('name', null),
            'user_id' => $request->input('user_id'),
        ]);

        \Log::info('User ID:', [$request->input('user_id')]);
    
        $uploadedFiles = [];
    
        foreach ($request->file('files') as $file) {
            $originalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $path = $file->storeAs($folderName, $originalName, 's3');
    
            $drop->files()->create([
                'original_name' => $originalName,
                'size' => $fileSize,
                'aws_path' => $path,
            ]);
    
            $uploadedFiles[] = [
                'original_name' => $originalName,
                'size' => $fileSize,
                'url' => Storage::disk('s3')->url($path),
            ];
        }
    
        return response()->json([
            'message' => 'Files uploaded successfully',
            'drop' => $drop,
            'files' => $uploadedFiles,
        ]);
    }

    public function getDrop($id)
    {
        $drop = Drop::with('files')->find($id);

        if (!$drop) {
            return response()->json(['error' => 'Drop not found'], 404);
        }

        return response()->json($drop);
    }

    public function getDropsByUser($userId)
    {
        $drops = Drop::with('files')->where('user_id', $userId)->get();

        if ($drops->isEmpty()) {
            return response()->json(['message' => 'No drops found for this user'], 404);
        }

        return response()->json($drops);
    }

}