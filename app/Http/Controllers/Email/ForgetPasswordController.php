<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\ResetPass;
use App\Models\User\Customer;
use Illuminate\Support\Facades\Hash;
use Throwable;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('User.ForgetPass');
    }
    public function forgetPass(Request $request)
    {
        // dd($request->all());
        $token = Str::random(length: 64);
        // $reset = new ResetPass();
        // $reset->email = $request->input('email');
        // $reset->token = $token;
        // $reset->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        // $reset->save();
        // $reset = ResetPass::create(['email' => $request->input('email'), 'token' => $token, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
        DB::table('password_reset_tokens')->insert(['email' => $request->input('email'), 'token' => $token, 'created_at' => Carbon::now('Asia/Ho_Chi_Minh')]);
        Mail::send("User.ForgetNotification", ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });
        return redirect(route('user.forgetPass'))->with("success", "Vui truy kiểm tra Email và truy cập vào link để reset password");
    }
    public function Notification($token)
    {
        return view('User.FormNewPass', ['token' => $token]);
    }
    public function resetPassword(Request $request)
    {
        // dd($request->all());
        // dd(Hash::make($request->input('password')));
        $request->validate(
            [
                // 'email' => [
                //     'exists:customer,email'
                // ],
                'password' => [
                    'bail',
                    'regex:/^[a-zA-Z0-9]{6,}$/'
                ],
                'password_confirmation' => 'same:password',
            ],
            [

                // 'email.required' => "Email không được để trống",
                // 'email.regex' => "Email không đúng định dạng",
                // 'email.exists' => "Email không đúng",
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.regex' => "Mật khẩu tối thiểu 6 ký tự",
                'password_confirmation.same' => 'Mật khẩu không trùng khớp'
            ]
        );
        $check = DB::table('password_reset_tokens')->where(['email' => $request->input('email'), 'token' => $request->input('token')])->first();
        if (!$check) {
            return redirect(route('user.NotiForgetPass', ['token' => $request->input('token')]))->with('status', 'Vui lòng nhập đúng Email của bạn !');
        }
        try {
            $pass = Hash::make($request->input('password'));
            Customer::where('email', $request->input('email'))->update(['password' => $pass]);
            DB::table('password_reset_tokens')->where('email', $request->input('email'))->delete();
        } catch (Throwable) {
            return redirect(route('user.NotiForgetPass', ['token' => $request->input('token')]))->with('status', 'Vui lòng nhập đúng Email của bạn !');
        }
        return redirect(route('user.login'))->with('status', 'Thay đổi mật khẩu thành công !');
    }
}
