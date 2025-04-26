<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HashToken;
use App\Models\User;
use App\Services\HashTokenService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TokenController extends Controller
{
    public function createToken()
    {
        $users = User::all();
        $tokens = HashToken::with('user')->latest()->get();
        return view('admin.tokens.index', compact('users', 'tokens'));
    }

    public function storeToken(Request $request)
    {
        $this->validate($request, [
           'user_id' => 'required|exists:users,id',
           'date' => 'required'
        ]);
        $data = $request->all();

        $user = User::findOrFail($data['user_id']);
        $data['file'] = HashTokenService::createToken($user);
        $data['date'] = HashTokenService::createDate($request['date']);
        $token = HashToken::where('user_id', $user->id)->first();
        if ($token) {
            $token->file = $data['file'];
            $token->date = $data['date'];
            $token->save();
        } else {
            HashToken::add($data);
        }
        toastr('Токен успешно создан');
        return redirect()->back();
    }

    public function destroyToken($id)
    {
        $token = HashToken::findOrFail($id);
        if (Storage::exists('tokens/' . $token->file)){
            Storage::delete('tokens/' . $token->file);
        }
        $token->delete();
        toastr('Токен успешно деактивирован!', 'info');
        return redirect()->back();
    }
}
