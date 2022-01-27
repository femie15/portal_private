<?php

namespace App\Components;

use Illuminate\Support\Facades\Route;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Account;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Dashboard extends Component
{
    public $dta,$engl,$dtl;
    
    public function route()
    {
        return Route::get('dashboard', static::class)
            ->name('dashboard')
            ->middleware('auth');
    }

    public function student()
    {              
        $query =  DB::table('users')
        ->select(DB::raw('name'))
        ->Where('role', 'student')
        ->Where('school_id', Auth::user()->school_id)
        ->Where('delet','!=', '1')
        ->get();
        // dd(count($query));

        return count($query);
    }

    public function parent()
    {              
        $query =  DB::table('users')
        ->select(DB::raw('name'))
        ->Where('role', 'parent')
        ->Where('school_id', Auth::user()->school_id)
        ->Where('delet','!=', '1')
        ->get();

        return count($query);
    }

    public function teacher()
    {              
        $query =  DB::table('users')
        ->select(DB::raw('name'))
        ->Where('role', 'teacher')
        ->Where('school_id', Auth::user()->school_id)
        ->Where('delet','!=', '1')
        ->get();
        // dd(count($query));

        return count($query);
    }
    
    public function get_phrase($phrase='')
    {   
       $dt = DB::table('languages')
       ->select(DB::raw('english'))
       ->where('phrase','=',$phrase)
       ->get();

       foreach ($dt as $gp){
        $engl=$gp->english;
        if ($engl != ''){                
                        $engl=ucwords($engl);
                        }else{
                            $engl= ucwords(str_replace('_',' ',$phrase));
                        }
            return $engl;
       }
    }

    public function classes()
    {   
       $dt = DB::table('classeds')        
       ->where('name','!=','graduate')
       ->where('school_id',Auth::user()->school_id)
       ->where('deleted_at','=',NULL)
       ->get();

       if ($dt !='' || $dt !=[] || !empty($dt)) {
        return $dt;
       }else {
        return null;
       }       
    }
    
    public function notices()
    {   
       $dt = DB::table('noticeboards')
       ->get();

       return $dt;       
    }

    public function settings()
    {   
        $dtl = DB::table('settings')        
       ->where('settings_id','16')
       ->get('description');
        session(['theme'=>$dtl[0]->description]);
        
        return  session('theme');      
    }

    public static function checkaccount()
    {
        $accnum = DB::table('accounts')
            ->where('user_id', Auth::user()->id)
            ->get('account_num'); 
        if (count($accnum)>0) {
            return $accnum;
        }else {
            // dd(['0'=>json_encode(['account_num'=>''])]);
            return null;
        }
    }

    public function render()
    {
        if (Auth::user()->role=='school') {
            $accnum = $this->checkaccount();  

    //     if(count($accnum) < 1)
    //     {
    //         $url = 'https://dashboard.coinplanner.com.ng/api/webservice/schoolacc';
    //         $data = array('desc' => Auth::user()->name.' Account',
    //                         'name' => Auth::user()->name,
    //                         'email' => Auth::user()->email,
    //                         'amount' => '0');
    //         //open connection
    //         $hd=[
    //                 'Content-Type' => 'application/json',
    //                 'Authorization' => 'Bearer 2|wU2nWh2qAvY8QEFPYOZpsul16zN6lCH4kIjopNQe'
    //             ];
    //         $ch = curl_init();
    //         $query = http_build_query($data);
    //                 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //                 curl_setopt($ch, CURLOPT_HEADER, false);
    //                 curl_setopt($ch, CURLOPT_URL, $url);
    //                 curl_setopt($ch, CURLOPT_POST, true);
    //                 curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    //                 $response = curl_exec($ch);
                
    //                 curl_close($ch);
    //                 $quizzes = json_decode($response);

    //                 if($quizzes){
    //                         $que = Account::updateOrCreate([
    //                             'user_id'=>Auth::user()->id,
    //                             'account_num'=>$quizzes->acc_num
    //                             ]);
    //                 }

    // }

}
        // else {   dd('account exists');  }


        return view('dashboard', [
            'get_phrase'=> $this->get_phrase(),
            'notices'=> $this->notices(),
            'classes'=> $this->classes(),
            'student'=> $this->student(),
            'parent'=> $this->parent(),
            'teacher'=> $this->teacher(),
        ]);
    }
}
