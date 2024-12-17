<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangLayananController extends Controller
{

    public function TentangSistem(){
        return view('tentang');
    }
    

    public function uploadImage(Request $request)
{
    $pengembang = isset($_POST['pengembang']) ? $_POST['pengembang'] : '';

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

        // Mendapatkan nilai pengembang dari input form
        // Menambahkan nilai pengembang ke dalam pesan
        $message = "File upload completed. Pengembang: $pengembang";
    } else {
        $message = "No file uploaded";
    }

    return redirect('/tentang-sistem')->with('message', $message);
}
    public function deleteImage()
{
    $message = ""; // Inisialisasi pesan

    // Mendefinisikan daftar ekstensi yang ingin dihapus
    $extensions = ['png', 'jpg'];

    $deletedFiles = false; // Menyimpan status apakah ada file yang dihapus

    foreach ($extensions as $extension) {
        $fileName = 'Logo.' . $extension;

        // Memeriksa apakah file ada
        if (Storage::disk('logoUpload')->exists($fileName)) {
            // Jika ada, hapus file
            Storage::disk('logoUpload')->delete($fileName);
            $deletedFiles = true; // Set status bahwa ada file yang dihapus
        }
    }

    if ($deletedFiles) {
        $message = "File(s) deleted successfully";
    } else {
        $message = "No file to delete";
    }

    return redirect('tentang-sistem')->with('message', $message);
}



}
