<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Route;
use DB;

class TestController extends Controller
{

    public static function routes()
    {
        Route::get('test', 'TestController@test');
        Route::get('snapshot', 'TestController@snapshot');
    }

    public function test()
    {

    }

    public function snapshot()
    {
        $users = User::where('username', 'like', '92%')->orderBy('username')->get()->toArray();
        foreach ($users as $u) {
            DB::table('data')->insert([
                'username' => $u['username'],
                'mini' => isset($u['mini_q']) ? $u['mini_q'] : '',
                'questions' => isset($u['questions']) ? $u['questions'] : '',
                'bests' => isset($u['bests_q']) ? $u['bests_q'] : '',
                'bests_inst' => isset($u['bests_q_inst']) ? $u['bests_q_inst'] : '',
                'time' => Carbon::now(),
            ]);
        }
    }


    public function select_users_from_all()
    {
        $users = DB::table('all_users')->where('username', 'like', '9231%')
            ->orWhere('username', '9213035')
            ->get();
        foreach ($users as $u) {
            $temp =
                [
                    '_id' => $u['_id'],
                    'username' => $u['username'],
                    'email' => $u['email'],
                    'mobile' => $u['mobile'],
                    'first_name' => $u['aut_data']['first_name'],
                    'last_name' => $u['aut_data']['last_name'],
                    'sex' => $u['aut_data']['sex'],
                    'order' => substr($u['username'], -3)
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
                    'email' => strtolower($u['email']),
                    'mobile' => $u['mobile'],
                    'first_name' => $u['first_name'],
                    'last_name' => $u['last_name'],
                    'sex' => $u['sex'],
                    'password' => bcrypt($pass)
                ]);
            DB::collection('pass')->insert([
                'username' => $u['username'],
                'password' => $pass,
                'email' => strtolower($u['email']),
                'mobile' => $u['mobile'],
            ]);
        }
    }
}
