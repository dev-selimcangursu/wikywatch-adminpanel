<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Departments;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Kullanıcılar Sayfası
    public function index()
    {
        return view("users.index");
    }

    // Kullanıcılar Fetch
    public function fetch(Request $request)
    {
       $user = User::join('departments', 'departments.id', '=', 'users.department_id')
       ->join('roles','roles.id','users.role_id')
       ->select('users.*', 'departments.name as departmentName','roles.name as roleName')
       ->get();


        return DataTables()
            ->of($user)
            ->make(true);
    }

    // Yeni Kullanıcı Ekle Sayfası
    public function create()
    {
        $departments = Departments::all();
        $roles = Role::all();
        return view("users.create", compact("departments", "roles"));
    }

    // Yeni Kullanıcı Ekleme Formu
    public function store(Request $request)
    {
        try {
            $name = $request->input("name");
            $email = $request->input("email");
            $phone = $request->input("phone");
            $department_id = $request->input("department_id");
            $role_id = $request->input("role_id");
            $status_id = $request->input("status_id");
            $password = $request->input("password");
            $bcryptPassword = $request->input("password");

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->department_id = $department_id;
            $user->role_id = $role_id;
            $user->status_id = $status_id;
            $user->password = $bcryptPassword;
            $user->save();

            return response()->json([
                "success" => true,
                "message" => "Kullanıcı Başarıyla Oluşturuldu.",
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    // Kullanıcı Detay Sayfası
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $departments = Departments::all();
        $roles = Role::all();
        return view("users.edit", compact("user", "departments", "roles"));
    }

    // Kullanıcı Bilgilerini Güncelle
    public function update(Request $request)
    {
        try {
            $userId = $request->input("userId");
            $name = $request->input("name");
            $email = $request->input("email");
            $phone = $request->input("phone");
            $department_id = $request->input("department_id");
            $role_id = $request->input("role_id");
            $status_id = $request->input("status_id");

            DB::table("users")
                ->where("id", "=", $userId)
                ->update([
                    "name" => $name,
                    "email" => $email,
                    "phone" => $phone,
                    "department_id" => $department_id,
                    "role_id" => $role_id,
                    "status_id" => $status_id,
                ]);

            return response()->json([
                "success" => true,
                "message" => "Kullanıcı Bilgileri Başarıyla Güncellendi",
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

    // Kullanıcı Parolası Güncelle
    public function updatePassword(Request $request)
    {
        try {
            DB::table("users")
                ->where("id", "=", $request->input("user_id"))
                ->update(["password" => bcrypt($request->password)]);

            return response()->json([
                "success" => true,
                "message" => "Parolanız başarıyla güncellendi.",
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Bir hata oluştu: " . $e->getMessage(),
            ]);
        }
    }

    // Kullanıcıyı Veritabanından Sil
    public function remove(Request $request)
    {
        try {
            DB::table("users")
                ->where("id", "=", $request->input("removeId"))
                ->delete();
            return response()->json([
                "success" => true,
                "message" => "Kullanıcı Başarıyla Silindi !",
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Kullanıcı Silinemedi Bilinmeyen Bir Hata !",
            ]);
        }
    }
}
