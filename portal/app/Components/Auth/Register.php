<?php

namespace App\Components\Auth;

use App\Models\User;
use App\Models\School;
use App\Providers\RouteServiceProvider;
use Bastinald\Ux\Traits\WithModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Livewire\Component;
// use Lukeraymonddowning\Honey\Traits\WithHoney;
// use Lukeraymonddowning\Honey\Traits\WithRecaptcha;

class Register extends Component
{
    // use WithRecaptcha, WithHoney;
    use WithModel;

    public function route()
    {
        return Route::get('register', static::class)
            ->name('register')
            ->middleware('guest');
    }

    public function render()
    {
        return view('auth.register');
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed'],
        ];
    }
 
    public function register()
    {
        $this->validateModel();

        // if (!$this->honeyPasses()) {
        //     return;
        // }

        $this->setModel('role','school');
        $this->setModel('timezone','Africa/Lagos');
        $user = User::create($this->getModelExcept('password_confirmation'));

        Auth::login($user, true);

        //set school id  	
        $this->setModel('school_id',Auth::user()->id);
        Auth::user()->update($this->getModel(['school_id']));
        
         
        School::updateOrCreate([
            'name'=>$this->getModel(['name'][0]),
            'school_id'=>$this->getModel(['school_id'][0]),
            'colour'=>'black'
            ]);

        return redirect()->to(RouteServiceProvider::HOME);
    }
}
