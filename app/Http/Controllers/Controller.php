<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\User;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static  function getIdEmpresa()
    {
        if (isset(Auth::user()->id)) {
            return Auth::user()->empresa_id;
        }
        return 0;
    }

    public function existeEmail($email)
    {

        return User::where("email", "=", $email)->exists();
    }
}
