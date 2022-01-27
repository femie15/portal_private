<?php

namespace App\Components\Messages;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Message;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
 
class Save extends Component
{
    use WithModel; 

    public $message, $me, $mename;

    // protected $listeners = ['msg' => 'gatMessages'];

    // public function gatMessages($mid){
    //     dd($mid);
    // } 

    public function mount(User $me= null)
    {  
        $this->me = $me->id;
        $this->mename = $me->name;

        $this->setModel($me->toArray());
        // dd($this->mename);
        
        $this->disp();
        // $this->setModel($this->disp());

        
    }


    public function disp()
    {
    $querym = DB::table('messages')      
        ->Where(function($querym) {
            $querym->where('sender', $this->me)
                  ->where('receiver', Auth::user()->id);
                    })
        ->orWhere(function($querym) {
            $querym->where('receiver', $this->me)
                    ->where('sender', Auth::user()->id);
                    })
        ->get(); 
// dd($querym);
        return $querym;
    }

    public function render()
    {
        return view('messages.save',[
            'talks'=>$this->disp(),
            'mename'=>$this->mename,
        ]);
    }


    public function rules()
    {
        return [
            // 'name' => ['required'],
            'message' => ['required'], 
            // 'message' => ['required','regex:/[a-zA-Z]{1}|\d\D+\d|[%_\-=\$@]\w+[%_\-=$@]/'], 
            // 'receiver' => ['required'], 
        ];
    }


    public function save()
    {
        // dd(auth()->user()->school_id);

        $this->validateModel();
        $this->message=$this->validateModel()['message'];
        
        \App\Models\Message::create([

            'sender' => auth()->user()->id,
            'name' => auth()->user()->school_id,
            'receiver' => $this->me,
            'message' => $this->message
        ]);
        // $this->message->fill($this->getModel())->save();

        // $this->emit('hideModal'); 
        $this->message='';
        $this->reset('message');
        $this->emit('$refresh');
    }
}
