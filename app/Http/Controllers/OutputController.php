<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class OutputController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'output', 'as' => 'output.'], function () {
            Route::get('/json', 'OutputController@json')->name('json');
            Route::get('/texts', 'OutputController@texts')->name('texts');
        });
    }


    public function json()
    {
        $users = User::where('username', 'like', '92%')->get();
        $mini = PersonalPageController::mini_questions();
        $questions = PersonalPageController::long_questions();
        $output = [];
        foreach ($users as $user) {
            $mini_answers = $user['mini_q'] ? json_decode($user['mini_q'], true) : [];
            $questions_answers = $user['questions'] ? json_decode($user['questions'], true) : [];
            $mini_out = [];
            $q_out = [];
            foreach ($questions as $key => $q)
                if (isset($questions_answers[$q]) && $questions_answers[$q]) {
                    $q_out[] = ['q' => $q, 'a' => $questions_answers[$q]];
                }
            foreach ($mini as $key => $q)
                if (isset($mini_answers[$q]) && $mini_answers[$q]) {
                    $mini_out[] = ['q' => $q, 'a' => $mini_answers[$q]];
                }
            $output[] = [
                'username' => $user['username'],
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'mini_questions' => $mini_out,
                'long_questions' => $q_out
            ];
        }
        file_put_contents(storage_path('temp/output.json'), json_encode($output));
        return Response::download(storage_path('temp/output.json'), 'output.json', ['Content-Type: application/json']);
    }

    public function texts()
    {
        $users = User::where('username', 'like', '92%')->with(['texts' => function ($query) {
            $query->with('user');
        }])->get();
        $fp = fopen(storage_path('temp/file.csv'), 'w');
        foreach ($users as $user) {
            $output = [$user['first_name'] . ' ' . $user['last_name']];
            foreach ($user['texts'] as $text) {
                $output[] = $text['user']['first_name'] . ' ' . $text['user']['last_name'];
                $output[] = $text['title'] . "\n" . $text['content'];
            };
            fputcsv($fp, $output);
        }
        return Response::download(storage_path('temp/file.csv'), 'output.csv', ['Content-Type: text/csv']);
    }

}