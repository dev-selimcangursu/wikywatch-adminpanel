<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;

class LoginController extends Controller
{
    // Login Giriş Sayfası
    public function index()
    {
        return view("login");
    }

    // Login Post İşlemi
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                "email" => ["required", "email"],
                "password" => ["required"],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return response()->json([
                    "success" => true,
                    "message" =>
                        "Giriş Başarılı Kontrol Paneline Yönlendiriliyorsunuz",
                ]);
            }

            // Giriş başarısızsa
            return response()->json([
                "success" => false,
                "message" => "E-posta veya şifre hatalı.",
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Bilinmeyen bir hata: " . $e->getMessage(),
            ]);
        }
    }
}
