<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SelectController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ask.participation');
    }
    public static function routes()
    {
        Route::group(['prefix' => 'select', 'as' => 'select.'], function () {
            Route::get('/all-users', 'SelectController@allUsers')->name('allUsers');
            Route::get('/all-inst', 'SelectController@allInstructors')->name('allInst');
        });
    }

    public function allUsers(Request $request)
    {
        $requested = $request->get('q');
        if(!$requested)
            return [];
        $users = User::where('first_name', 'LIKE', $requested . '%')
            ->where('others', 'exists', false)
            ->take(10)
            ->get(['id', 'first_name','last_name']);
        if (count($users) == 0)
            $users = User::where('last_name', 'LIKE', '%' . $requested . '%')
                ->where('others', 'exists', false)
                ->take(10)
                ->get(['id', 'first_name','last_name']);
        return $this->userData($users);
    }

    public function allInstructors(Request $request)
    {
        $requested = $request->get('q');
        if(!$requested)
            return [];
        $inst = Instructor::where('name', 'LIKE', $requested . '%')
            ->take(10)
            ->get(['id', 'name']);

        return $this->instData($inst);
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

    protected function instData($users)
    {
        if (count($users) == 0)
            return '{}';
        foreach ($users as $u) {
            $tmp['id'] = $u['id'];
            $tmp['text'] = $u['name'];
            $data[] = $tmp;
        }
        return $data;
    }
}
