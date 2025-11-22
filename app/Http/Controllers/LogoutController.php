<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function Logout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
