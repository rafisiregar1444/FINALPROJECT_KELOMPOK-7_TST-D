<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserList;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function List()
    {
        $data = UserList::orderByRaw("
            CASE 
                WHEN role = 'admin' THEN 0 
                WHEN role = 'user' THEN 1 
                WHEN role = 'mahasiswa' THEN 2 
                ELSE 3 
            END
        ")->get();
    
        return view('user.listuser', compact('data'));

    }
    
    public function userAdd()
    {
        $data = UserList::orderBy('id_userx', 'asc')->get();

        return view('user.adduser', compact('data'));

    }
    public function userAddmahasiswa()
    {
        $data = UserList::orderBy('id_userx', 'asc')->get();

		$allUser = UserList::all();
        return view('user.addusermahasiswa', compact('data', 'allUser'));

    }
    public function userEdit(string $id_userx)
    {
        $data = UserList::where('id_userx', $id_userx)->first();

        $dataU = UserList::where('id_userx', $id_userx)->get();

        return view('user.edituser', compact('data', 'dataU'));

    }
    public function userResetPass(string $id_userx)
    {
        $data = UserList::where('id_userx', $id_userx)->first();

        return view('user.resetuserpass', compact('data'));

    }
    public function Profile($id_userx)
    {
        $data = UserList::find($id_userx);
        return view('profile', compact('data'));
    }
    public function uploadImage(Request $request, $id_userx)
    {
        $request->validate([
            'nama_pt' => 'required|max:300',
            'password' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);
    
        try {
            // Temukan pengguna berdasarkan id_userx
            $user = User::findOrFail($id_userx);
    
            // Simpan gambar ke dalam folder yang diinginkan (misalnya, folder 'uploads')
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $fileName);
    
            // Update avatar dengan path gambar yang disimpan
            $user->avatar = '/storage/' . $path;
    
            // Update nama_pt dan password
            $user->nama_pt = $request->nama_pt;
            $user->password = bcrypt($request->password); // Pastikan untuk mengenkripsi kata sandi sebelum menyimpannya
            $user->save();
    
            return redirect()->back()->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            // Tangani error jika pengguna tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->with('error', 'Failed to upload file. Please try again.');
        }
    }
    


public function deleteImage(Request $request)
{
    $user = Auth::user();

    // Hapus avatar dari database
    if ($user->avatar) {
        $user->avatar = null;
        $user->save();
    }

    return redirect()->back()->with('success', 'File deleted successfully.');
}


    public function userStore(Request $request)
    {
        try {
            // Validasi data yang diterima dari request
            $request->validate([
                'kode_pt' => 'required|string|max:7',
                'nama_pt' => 'required|max:300',
                'username' => 'required|string|max:15',
                'type' => 'required|in:5,3,2,1,4',
                'status_user' => 'required|in:1,0',
                'role' => 'required',
                'password' => 'required',
                
            ]);
            $maxId = UserList::max('id_userx');
            $newIdUserx = $maxId + 1;
            $id_pass = $request->input('id_pass');

            // Membuat data baru
            $newData = new UserList();
            $newData->id_userx = $newIdUserx;
            $newData->kode_pt = $request->kode_pt;
            $newData->nama_pt = $request->nama_pt;
            $newData->username = $request->username;
            $newData->type = $request->type;
            $newData->status_user = $request->status_user;
            $newData->id_pass = $id_pass;
            $newData->role = $request->role;
            $newData->password = Hash::make($request->password);
            $newData->save();

            // Tampilkan pesan sukses jika data berhasil disimpan
            return redirect()->route('listuser')->with('success', 'Data berhasil dibuat');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    public function userUpdate(Request $request, $id_userx)
{
    try {
        // Validasi data yang diterima dari request
        $request->validate([ 
            'nama_pt' => 'required|max:300',
            'username' => 'required|string|max:15',
            'status_user' => 'required|in:1,0',
        ]);

        // Mengambil data pengguna berdasarkan ID
        $userData = UserList::findOrFail($id_userx);

        // Mengisi data pengguna dengan data yang diterima dari request
        $userData->nama_pt = $request->nama_pt;
        $userData->username = $request->username;
        $userData->status_user = $request->status_user;
        $userData->save();

        // Tampilkan pesan sukses jika data berhasil diperbarui
        return redirect()->route('listuser')->with('success', 'Data berhasil diperbarui');
    } catch (\Exception $e) {
        // Tampilkan pesan error jika terjadi kesalahan
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}
public function userResetPassUpdate(Request $request, $id_userx)
{
    try {
        // Validasi data yang diterima dari request
        $request->validate([
            'password' => 'required',
        ]);

        // Mengambil data pengguna berdasarkan ID
        $updateData = UserList::findOrFail($id_userx);

        // Mengisi data pengguna dengan data yang diterima dari request
        $updateData->password = Hash::make($request->password);
        $updateData->save();

        // Tampilkan pesan sukses jika data berhasil diperbarui
        return redirect()->route('listuser')->with('success', 'Data berhasil diperbarui');
    } catch (\Exception $e) {
        // Tampilkan pesan error jika terjadi kesalahan
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
    }
}

public function roleuserEdit(string $id_userx)
	{
		$data = UserList::where('id_userx', $id_userx)
				->first();

		// Mengambil nama_kota yang sesuai dengan nm_kota pada model PT

		return view('user.roleuseredit', compact('data'));
	}

    public function roleuserUpdate(Request $request, $id_userx)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
				'role' => 'required',
                // Aturan validasi lainnya jika diperlukan
            ]);

            // Ambil data yang akan diupdate
            $data = UserList::findOrFail($id_userx);

            // Update data berdasarkan input yang valid
            $data->update([
                'role' => $request->role,
                // Atribut lainnya yang diperlukan
            ]);

            // Berhasil update, kembalikan respons berhasil
            return redirect()->route('edituser', ['id_userx' => $id_userx])->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }
public function userDelete(Request $request, $id_userx)
    {
        try {
            $delete = UserList::find($id_userx);

            if ($delete) {
                // Delete the Dokung record
                $delete->delete();

                return redirect()->back()->with('success', 'Data telah berhasil diperbarui.');
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

}