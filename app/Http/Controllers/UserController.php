<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Tb User',
            'users' => User::all(),
        ];

        return view('user.user',$data);
    }

    public function save_user(Request $r)
    {

        $user = User::create([
            'name' => $r->name,
            'email' => $r->email,
            'role' => $r->role,
            'password' => Hash::make($r->password),
        ]);


        return redirect()->route('tb_user')->with('sukses', 'Berhasil tambah user');
    }

    public function delete_user($id)
    {
        User::find($id)->delete();
        return redirect()->route('tb_user')->with('sukses', 'Berhasil hapus user');
    }

    public function logout(Request $r)
    {
        Auth::guard('web')->logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();

        return redirect('http://127.0.0.1:8000/');
    }

    public function verifikasi($val, $id)
    {

        User::find($id)->update(['verifikasi' => $val]);
        return redirect()->route('tb_user')->with('sukses', 'Berhasil verifikasi user');
    }

    public function permission(Request $r)
    {
        $id_user = $r->id;
        $data = [
            'title' => 'Data User',
            'menu' => DB::table('tb_menu')->get(),
            'id_user' => $id_user,
            'logout' => $r->session()->get('logout'),
        ];

        return view('user.permission', $data);
    }

    public function save_permission(Request $r)
    {
        $id_user = $r->kd_user;
        $permission =  $r->permission;


        DB::table('tb_permission')->where('id_user', $id_user)->delete();

        for ($i = 0; $i < count($r->permission); $i++) {
            $data_permission = [
                'id_user' => $id_user,
                'permission' => $permission[$i]
            ];

            // var_dump($id_user);
            DB::table('tb_permission')->insert($data_permission);
        }
        return redirect()->route('tb_user')->with('sukses', 'Sukses atur permssion');
    }
}
