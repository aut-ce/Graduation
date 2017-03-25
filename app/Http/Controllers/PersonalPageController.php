<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PersonalPageController extends Controller
{
    public static function routes()
    {

        Route::group(['prefix' => 'personal', 'as' => 'personal.'], function () {
            Route::get('/mini', 'PersonalPageController@mini')->name('mini');
            Route::post('/mini', 'PersonalPageController@miniAction')->name('miniAction');
            Route::get('/', function () {
                return redirect()->route('personal.mini');
            })->name('main');
        });
    }

    public function mini()
    {
        return view('pages.personal.mini_question', [
            'questions' => $this->questions()
        ]);
    }

    public function miniAction(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('q');
        $user->mini_q = json_encode($q);
        $user->save();
        return redirect()->route('home')->with('success', 'با موفقیت ثبت شد');
    }


    protected function questions()
    {
        return [
            "پاتوق",
            "یعقوب برقی",
            "آقا یعقوب",
            "روز اول دانشگاه",
            "فارغ التحصیلی",
            "طبقه اساتید",
            "دانشکده کامپیوتر",
            "خیابان ولیعصر",
            "پیچونده شده ترین کلاس",
            "تکه کلام",
            "درس اختیاری",
            "7:45",
            "آز 4.5 تا 7",
            "انتخاب واحد",
            "سایت",
            "کابل LAN",
            "سالن مطالعه",
            "خوابگاه",
            "سه شونزدهم",
            "تمدید",
            "دروس عمومی",
            "سلف",
            "پروژه",
            "حراست",
            "فرجه",
            "تحصن",
            "آز کامپیوتر",
            "بهترین پروژه",
            "بدترین پروژه",
            "در سعید",
            "پلی تکنیک",
            "روز ثبت نام",
            "بزرگترین اشتباه دوران کارشناسیت؟",
            "ردیف آخر",
            "اولین دوست"
        ];
    }
}
