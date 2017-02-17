<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Route;
use DB;

class TestController extends Controller
{
    public static function routes()
    {
        Route::get('test', 'TestController@create_users');
    }

    public function select_users_from_all()
    {
        $users = User::where('username', 'like', '9231%')->get();
        foreach ($users as $u) {
            $temp =
                [
                    '_id' => $u->id,
                    'username' => $u->username,
                    'email' => $u->email,
                    'mobile' => $u->mobile,
                    'first_name' => $u->aut_data['first_name'],
                    'last_name' => $u->aut_data['last_name'],
                    'sex' => $u->aut_data['sex'],
                    'order' => substr($u->username, -3)
                ];
            DB::collection('user2')->insert($temp);
        }
    }

    public function create_users()
    {
        $users = DB::collection('user2')->orderBy('order')->get();
        foreach ($users as $u) {
            $pass = str_random(11);
            User::create(
                [
                    'username' => $u['username'],
                    'email' => $u['email'],
                    'mobile' => $u['mobile'],
                    'first_name' => $u['first_name'],
                    'last_name' => $u['last_name'],
                    'sex' => $u['sex'],
                    'password' => bcrypt($pass)
                ]);
            DB::collection('pass')->insert([
                'username' => $u['username'],
                'password' => $pass,
                'email' => $u['email'],
                'mobile' => $u['mobile'],
            ]);
        }
    }
}
