<?php

namespace App\Components\Users;
  
use Bastinald\Ux\Traits\WithModel;
use App\Models\User;
use App\Models\Section;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class Save extends Component
{
    use WithFileUploads;
    use WithModel;

    public $user;
    public $house,$image,$imager;
    public $getSect;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($getImage){
        $this->image = $getImage;
    }
 
    public function storeImage($imgId='')
    {
        // dd($this->image);
        if(!$this->image){
             return null;
            }else{
                // encode png image as jpg
                $jpg = Image::make($this->image)->encode('jpg');

                // resize the image to a width of 200 and constrain aspect ratio (auto height)
                $jpg->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();    
                    $constraint->upsize();
                });

                $jpg->save('assets/images/users/'.$imgId.'.jpg');
        }
    }

    public function mount(User $user = null)
    {
        $this->user = $user;
        $this->setModel($user->toArray());
        if(file_exists('assets/images/users/'.$this->getModel('id').'.jpg')){
             $this->imager='../assets/images/users/'.$this->getModel('id').'.jpg';
             $this->image='assets/images/users/'.$this->getModel('id').'.jpg';
        }else{
            $this->imager='../assets/images/users/user.jpg';
            $this->image='assets/images/users/user.jpg';
        }

        $this->getSection($this->getModel('class_id'));
    }

    public function render()
    {
        return view('users.save',[
            'getClass'=> $this->getClass(),
            'getParent'=>$this->getParent(),
            'getSection'=>$this->getSection(),
        ]);
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            // 'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'password' => [!$this->user->exists ? 'required' : 'nullable', 'confirmed'],
        ];
    }

    public function save()
    {        
        $this->validateModel();

        $this->setModel('school_id',Auth::user()->school_id);
        $this->setModel('role','student');

        if (!$this->user->exists ) {
            //temporary email
            $tm=rand(1000000,9999999999);
            $tms=rand(100,9999);
            $em='temp'.$tms.''.$tm.'@oyoedu.ng';
            $this->setModel('email',$em);
            //end temporary email
        }
        

        $this->user->fill($this->getModelExcept('password_confirmation'))->save();

        //get newly insert ID to name picture
        $image = $this->storeImage($this->user->fill($this->getModelExcept('password_confirmation'))->id);

        if (!$this->user->exists ) {
        //append student ID with school code
        $cod=Auth::user()->school_id.$this->user->fill($this->getModelExcept('password_confirmation'))->id;
            $this->setModel('code',$cod);
            $this->setModel('email',($cod.'@oyoedu.ng'));
            //resave the with the generated code
            $this->user->fill($this->getModelExcept('password_confirmation'))->save();
        }

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
        
    public function getClass()
    {
        $titles = DB::table('classeds')
        ->where('name','!=','graduate')
        ->where('school_id',Auth::user()->school_id)
        ->pluck('id', 'name');
        return $titles;
    }

    public function getParent()
    {
        $sect=User::all()->where('role','parent')
        ->pluck('id', 'name');        
        return $sect;
    }
 
    public function getSection($sec='')
    {
        if($sec!=''){
            $sect = DB::table('sections')
            ->where('school_id',Auth::user()->school_id)
            ->where('class_id',$sec)
            ->get(); 
            $this->getSect=$sect;
            
        }else {            
            if($this->getModel('class_id')!=''){                
                $sect = DB::table('sections')
                ->where('school_id',Auth::user()->school_id)
                ->where('class_id',$this->getModel('class_id'))
                ->get(); 
                $this->getSect=$sect;
            }else{
                $sect = DB::table('sections')
                ->where('school_id',0)
                ->get(); 
                $this->getSect=$sect;
            }
        }      
        
        return $sect;
    }

    
}
