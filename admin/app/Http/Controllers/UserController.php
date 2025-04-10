<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    // Kullanıcılar Sayfası
    public function index()
    {
        return view('users.index');
    }

    // Kullanıcılar Fetch
    public function fetch(Request $request)
    {
        $user = User::all();

        return DataTables()->of($user)->make(true);
    }

    // Yeni Kullanıcı Ekle Sayfası
    public function create()
    {
        return view('users.create');
    }

    // Yeni Kullanıcı Ekleme Formu
    public function store(Request $request)
    {
     
      try {

        $name           = $request->input('name');
        $email          = $request->input('email');
        $phone          = $request->input('phone');
        $department_id  = $request->input('department_id');
        $role_id        = $request->input('role_id');
        $status_id      = $request->input('status_id');
        $password       = $request->input('password');
        $bcryptPassword = $request->input('password'); 

        $user                = new User();
        $user->name          = $name;
        $user->email         = $email;
        $user->phone         = $phone;
        $user->department_id = $department_id;
        $user->role_id       = $role_id;
        $user->status_id     = $status_id;
        $user->password      = $bcryptPassword;
        $user->save();

        return response()->json(['success'=>true,'message'=>'Kullanıcı Başarıyla Oluşturuldu.']);

      } catch (Exception $e) {

          return response()->json(['success'=>false , 'message'=>$e->getMessage()]);
      }


    }
}
