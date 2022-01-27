<?php

namespace App\Components\Auth;

use App\Providers\RouteServiceProvider;
use Bastinald\Ux\Traits\WithModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Livewire\Component;

use Illuminate\Support\Facades\DB;

class Login extends Component
{
    use WithModel;

    public function route()
    {
        return Route::get('login', static::class)
            ->name('login')
            ->middleware('guest');
    }

    public function render()
    {
        return view('auth.login');
    }

    public function rules()
    {
        return [
            // 'email' => ['required', 'email'],
            'code' => ['required', 'Numeric'],
            'password' => ['required'],
        ];
    }
 
    public function login()
    {
        $this->validateModel();

        $throttleKey = Str::lower($this->getModel('code')) . '|' . Request::ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $this->addError('code', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey)
            ]));

            return;
        }

        // if (!Auth::attempt($this->getModel(['email', 'password']), $this->getModel('remember'))) {
        if (!Auth::attempt($this->getModel(['code', 'password']), $this->getModel('remember'))) {
            RateLimiter::hit($throttleKey);

            $this->addError('code', __('auth.failed'));

            return;
        }

        //set theme colour
        $dtl = DB::table('schools')        
        ->where('school_id',Auth::user()->school_id)
        ->pluck('colour');
        session(['theme'=>$dtl[0]]);
        //End set theme colour

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
 