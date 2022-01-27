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
 
class card extends Component
{
    use WithModel, WithPagination;
    public $clid;
    public $user;

    protected $listeners = ['$refresh'];

    public function route()
    {        
        return Route::get('card/{clid}', static::class)
            ->where('clid', '[A-Za-z 0-9]+')
            ->name('card')
            ->middleware('auth');
        
    }

    public function mount($clid)
    {      
        if(Auth::user()->role !="school" && Auth::user()->role !="teacher")
        {
            return redirect()->to('/dashboard');
        }
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            'filter' => $this->classes($clid),
            // 'filters' => $this->classes($clid),
            // 'filters' => ['Select Class', 'JSS 1', 'jss3'],
        ]);
    }

    public function classes($clid='')
    {   
       $dt = DB::table('classeds')        
       ->where('name','=',$clid)
       ->where('school_id',Auth::user()->school_id)
       ->pluck('id');
           
       if ($dt && count($dt)>0) {        
            return $dt;  
        }else {
            return NULL;   
        }  

    }
     
    public function getStudent()
    {   
       $dt = DB::table('users')        
       ->where('class_id',$this->getModel('filter'))
       ->where('school_id',Auth::user()->school_id)
       ->Where('id','!=','1')
       ->Where('role','student')
       ->Where('delet','!=', '1')
       ->get();

       if ($dt && count($dt)>0) {        
            return $dt;  
        }else {
            return NULL;   
        } 
    }

    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');  
// dd($titles);
        return $titles;
    }

    public function getSection()
    {
            $sect = DB::table('sections')
            ->where('school_id',Auth::user()->school_id)
            ->where('class_id',$this->getModel('filter'))        
            ->get(); 
        return $sect;
    }

    public function render()
    {
        return view('users.card', [
            // 'users' => $this->query()->paginate(),
            'getSection' => $this->getSection(),
            'getClass' => $this->getClass(),
            'getStudent' => $this->getStudent(),
        ]);
    }

    // public function query()
    // {              
    //     $query = User::query()->Where('role', 'student')
    //     ->Where('school_id', Auth::user()->school_id)->Where('delet','!=', '1');
    //     if(isset($_GET['luppy']) && is_numeric($_GET['luppy'])){
    //         $query->where('section_id',$_GET['luppy']);
    //     }

    //     if ($search = $this->getModel('search')) {
    //         $query->where(function (Builder $query) use ($search) {
    //             // $query->orWhere('id', 'like', '%' . $search . '%');
    //             $query->orWhere('name', 'like', '%' . $search . '%');
    //             $query->orWhere('email', 'like', '%' . $search . '%');
    //             $query->orWhere('sex', 'like', '%' . $search . '%');
    //         });
    //     }

    //     switch ($this->getModel('sort')) {
    //         case 'Name': $query->orderBy('name'); break;
    //         case 'Newest': $query->orderByDesc('created_at'); break;
    //         case 'Oldest': $query->orderBy('created_at'); break;
    //     }
        
    //     if($this->getModel('filter')!='') {
    //          $query->where('class_id','=', $this->getModel('filter'));
    //         }
            
    //     return $query;
    // }

    public function delete(User $user)
    {
        // $user->delete();
        $this->user = $user;
        $this->user->fill(['delet'=>1])->save();
    }
}
