<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Connect with MSGraph
     */
    public function connect()
    {   
        return MsGraph::connect();
    }

    /**
     * Logout/disconnect from MSGraph
     */
    public function logout()
    {
        Auth::logout();
        return MsGraph::disconnect();
    }
}