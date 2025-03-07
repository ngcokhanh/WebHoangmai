<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '.' . $extension;

            $imageUrl = Storage::put('ckeditor/uploads', request()->file('upload'));

            $url = Storage::url($imageUrl);

            return response()->json(['url' => $url, 'fileName' => $fileName, 'uploaded' => 1]);

        }
    }
}
