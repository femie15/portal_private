<?php

namespace App\Components\Users;

use Bastinald\Ux\Traits\WithModel;
use App\Models\User; 
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
 
class Student extends Component
{
    use WithModel, WithPagination;
    
    protected $listeners = ['$refresh'];
    // public $hid='hidden';

    public function route()
    {        
        return Route::get('student', static::class)
            ->name('student')
            ->middleware('auth');
        
    }

    public function mount()
    {    
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            // 'filter' => '0',
            'filters' => $this->classes()[1],
        ]);
    } 
 
    public function classes()
    {   
       $dt = DB::table('classeds')        
       ->where('name','!=','graduate')
       ->where('school_id',Auth::user()->school_id)       
       ->get();
       $arn=$arid=$ar=[];

            foreach ($dt as $key => $value) {
                array_push($arn, $value->name);
                array_push($arid, $value->id);
            }
       array_push($ar, $arid);
       array_push($ar, $arn);
       return $ar;       
    }
    
    public function getClass()
    {
            $titles = DB::table('classeds')
            ->where('name','!=','graduate')
            ->where('school_id',Auth::user()->school_id)
            ->pluck('id', 'name'); 
        
        return $titles;
    }

    public function hd(){
        if ($this->getModel('filter')){            
            $hid='';
        }else{            
            $hid='hidden';
        }

        return $hid;
    }

    public function getSection($cc='')
    {        
        $lopd=count($this->classes()[1]);

        for ($i=0; $i < $lopd ; $i++) {
            if ($this->getModel('filter') == $this->classes()[1][$i]) {  
                $sect = DB::table('sections')
                ->where('school_id',Auth::user()->school_id)
                ->where('class_id',$this->classes()[0][$i])
                ->get(); 
        return $sect;
            }
        }

        $sect = DB::table('sections')
        ->where('school_id',Auth::user()->school_id)
        ->get();    
       return $sect;
    }

    public function render()
    {
        return view('users.student', [
            'users' => $this->query()->paginate(),
            'getSection' => $this->getSection(),
            'getClass' => $this->getClass(),
            'hd' => $this->hd(),
        ]);
    }

    public function query()
    {              
        $query = User::query()->Where('role', 'student')
        ->Where('school_id', Auth::user()->school_id)->Where('delet','!=', '1');
       
        if(isset($_GET['luppy']) && is_numeric($_GET['luppy'])){
                    $query->where('section_id',$_GET['luppy']);
                }

        if ($search = $this->getModel('search')) {
            $query->where(function (Builder $query) use ($search) {
                // $query->orWhere('id', 'like', '%' . $search . '%');
                $query->orWhere('name', 'like', '%' . $search . '%');
                $query->orWhere('email', 'like', '%' . $search . '%');
                $query->orWhere('sex', 'like', '%' . $search . '%');
            });
        }

        switch ($this->getModel('sort')) {
            case 'Name': $query->orderBy('name'); break;
            case 'Newest': $query->orderByDesc('created_at'); break;
            case 'Oldest': $query->orderBy('created_at'); break;
        }

        
        $lopd=count($this->classes()[1]);
            for ($i=0; $i < $lopd ; $i++) {
                if ($this->getModel('filter') == $this->classes()[1][$i]) {

                    $this->getSection($this->classes()[0][$i]);

                    $query->where('class_id', $this->classes()[0][$i]);
                    
                }
            }
            
        return $query;
        
    }

    public function delete(User $user)
    {
        // $user->delete();
        $this->user = $user;
        $this->user->fill(['delet'=>1])->save();
    }
}
