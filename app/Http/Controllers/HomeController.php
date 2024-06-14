<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Nếu đã đăng nhập, chuyển hướng đến trang home
            return view('home');
        } else {
            // Nếu chưa đăng nhập, hiển thị trang home với nút Login và Register
            return view('home');
        }
    }
}
