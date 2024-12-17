<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $message = ""; // Inisialisasi pesan

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension(); // Ekstensi file
            $fileName = 'Logo.' . $extension;

            // Hapus file lama jika ada
            $filesToDelete = Storage::disk('logoUpload')->files('/Logo.*');
            foreach ($filesToDelete as $file) {
                Storage::disk('logoUpload')->delete($file);
            }

            // Simpan file baru
            $request->file('image')->storeAs('', $fileName, 'logoUpload');
            $message = "File upload completed";
        }

        return redirect('/dashboard')->with('message', $message);
    }
}
