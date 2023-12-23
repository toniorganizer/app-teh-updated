<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon; 
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('dashboard.auth.email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'Link reset password berhasil dikirim ke E-mail!');
      }

      public function showResetPasswordForm($token) { 
        return view('dashboard.auth.forgetPasswordLink', ['token' => $token]);
     }

     public function submitResetPasswordForm(Request $request){
      $request->validate([
          'email' => 'required',
          'password_baru' => 'required|same:ulangi_password',
          'ulangi_password' => 'required|same:password_baru',
      ], [
          'email.required' => 'E-mail tidak boleh kosong',
          'password_baru.required' => 'Password tidak boleh kosong',
          'ulangi_password.required' => 'Password tidak boleh kosong',
          'password_baru.same' => 'Password harus sama dengan ulangi password',
          'ulangi_password.same' => 'Konfirmasi password harus sama dengan password baru',
      ]);
      
      $email = $request->input('email');
      $ulangi_password = $request->input('ulangi_password');

      $user = User::where('email', $email)->first();
      
      if (!$user) {
          return back()->with('not-registered', 'E-mail yang anda masukan belum terdaftar. Gunakan E-mail yang anda gunakan dalam proses registrasi!');
      }

      if($user){
          User::where('email',$request->email)->update([
              'password' => Hash::make($ulangi_password)
          ]);
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
          return redirect('/login')->with('success', 'Reset Password berhasil dilakukan');
      }

      
      return back()->with('error', 'Reset Password gagal');
  }

}
