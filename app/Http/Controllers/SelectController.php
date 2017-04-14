<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SelectController extends Controller
{

    public static function routes()
    {
        Route::group(['prefix' => 'select', 'as' => 'select.'], function () {
            Route::get('/all-users', 'SelectController@allUsers')->name('allUsers');
        });
    }

    public function allUsers(Request $request)
    {
        $requested = $request->get('q');
        $users = User::where('first_name', 'LIKE', $requested . '%')
            ->take(10)
            ->get(['id', 'first_name','last_name']);
        if (count($users) == 0)
            $users = User::where('last_name', 'LIKE', '%' . $requested . '%')
                ->take(10)
                ->get(['id', 'first_name','last_name']);
        return $this->userData($users);
    }



    protected function userData($users)
    {
        if (count($users) == 0)
            return '{}';
        foreach ($users as $u) {
            $tmp['id'] = $u['id'];
            $tmp['text'] = $u['first_name'].' '.$u['last_name'];
            $data[] = $tmp;
        }
        return $data;
    }
}
