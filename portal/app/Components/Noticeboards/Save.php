<?php

namespace App\Components\Noticeboards;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Noticeboard;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use WithModel;

    public $noticeboard;

    public function mount(Noticeboard $noticeboard = null)
    {
        $this->noticeboard = $noticeboard;
        $noticeboard['created_timestamp']=date('Y-m-d',$noticeboard['created_timestamp']);
        // dd($noticeboard['created_timestamp']=date('m-d-Y',$noticeboard['created_timestamp']));
        // dd($noticeboard->toArray());
        $this->setModel($noticeboard->toArray());
    }

    public function render()
    {
        return view('noticeboards.save');
    }

    public function rules()
    {
        return [
            'notice' => ['required'],
            'notice_title' => ['required'],
            'created_timestamp' => ['required'],
        ];
    }
  
    public function save()
    {
        $this->validateModel();
        
        $tt=strtotime($this->validateModel()['created_timestamp']);
        $this->setModel('created_timestamp',$tt);

        $this->setModel('school_id',Auth::user()->school_id);
        $this->noticeboard->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
