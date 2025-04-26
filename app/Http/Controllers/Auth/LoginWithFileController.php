<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\HashToken;
use App\Models\PrivatePolicy;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginWithFileController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
           'file' => 'required|file',
            'check' => 'accepted'
        ], [], ['check' => 'условия']);
        if ($request->file('file')->getClientOriginalExtension() === 'pfx') {
            $fileData = file_get_contents($request['file']);
            $decryptedData = json_decode(Crypt::decrypt($fileData), 1);
            if ($this->isValidUser($decryptedData, $request->file('file')->getClientOriginalName())) {
                if (Auth::user()->role_id == env('APP_ADMIN_ROLE', 1)) {
                    return redirect()->intended(RouteServiceProvider::AdminHome);
                } else if (Auth::user()->role_id == env('APP_MODER_ROLE', 2)) {
                    return redirect()->intended(RouteServiceProvider::ModerHome);
                }
                else if (Auth::user()->role_id == 3) {
                    return redirect()->intended(RouteServiceProvider::MayorHome);
                }
                else if (Auth::user()->role_id == 4) {
                    return redirect()->intended(RouteServiceProvider::AgronomHome);
                }
                else if (Auth::user()->role_id == 5) {
                    return redirect()->intended(RouteServiceProvider::ConsumerHome);
                }
                else if (Auth::user()->role_id == 6) {
                    return redirect()->intended(RouteServiceProvider::ChefHome);
                }
                else if (Auth::user()->role_id == 7) {
                    return redirect()->intended(RouteServiceProvider::AgronomistHome);
                }
                else if (Auth::user()->role_id == 8) {
                    return redirect()->intended(RouteServiceProvider::BrigadiertHome);
                }
                else {
                    return abort(404);
                }
            } else {
                toastr('Неправильные данные!', 'error');
                return redirect()->back();
            }
        } else {
            toastr('Не валидный файл!', 'error');
            return redirect()->back();
        }
    }

    private function isValidUser($fileData, $fileExt): bool
    {
        $user = \App\Models\User::where(['email' => $fileData['email'], 'password' => $fileData['password']])->first();
        if ($user) {
            $token = HashToken::where('user_id', $user->id)->first();
            if ($token) {
                if (Carbon::create($token->date) > Carbon::now()->startOfDay()) {
                    if ($token->file === $fileExt) {
                        auth()->login($user);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
//        return Auth::attempt(['email' => $fileData['email'], 'password' => $fileData['password']]);
    }

    public function privatePolicy()
    {
        $policy = PrivatePolicy::latest()->first();
        return view('auth.policy', compact('policy'));
    }
}
