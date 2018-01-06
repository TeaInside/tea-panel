<?php

/**
 *	Generated by IceTea Framework 0.0.1
 *	Created at 2018-01-06 17:16:41
 *	Namespace App\Http\Controllers\Auth
 */

namespace App\Http\Controllers\Auth;

use App\Models\Auth;
use IceTea\Http\Controller;
use IceTea\Session\SessionHandler as S;

class LoginController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
    	return view('auth/login');
    }

    public function action()
    {
    	header("Content-type: application/json");
    	$a = json_decode(file_get_contents("php://input"), true);
    	if (isset($a['username'], $a['password'])) {
    		if ($auth = Auth::login($a['username'], $a['password'])) {
    			S::set("user", $auth);
    			print json_encode(
    				[
    					"redirect" => route('elfinder'),
    					"message" => "Login success!"
    				]
    			);
    		}
    	}
    }

    public function logout()
    {
        S::set('user', null);
        header("location:".route('login'));
        die;
    }
}
