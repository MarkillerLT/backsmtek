<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->rol === 'admin') {
            return redirect()->route('admin.index');
        }

        return redirect()->route('dashboard');
    }
}
