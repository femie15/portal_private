<?php

namespace App\Components\Topics;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Topic;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request; 
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Classa extends Component
{
    use WithModel;

    public $topic;

    public function route()
    {
        return Route::get('classa/{clid}', static::class)
            ->where('clid', '[0-9]+')
            ->name('classa')
            ->middleware('auth');
    }

    public function mount($clid)
    {
        $this->topic=$clid;
    }

    public function geta($clid=''){
        $sect = DB::table('topics')
        ->where('school_id',Auth::user()->school_id)
        ->where('id',$clid)
        ->get();        

        if ($sect && count($sect)> 0) {
            return $sect;
        }else {
             return NULL;
        }

    }

    public function getSub()
    {
        $titles = DB::table('subjects')
        ->where('school_id',Auth::user()->school_id)
        ->orderBy('name')
        ->pluck('id', 'name');  
        return $titles;
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

    public function render()
    {
        return view('topics.classa',[
            'geta'=>$this->geta($this->topic),
            'cls'=>$this->classes(),
            'getSub'=>$this->getSub(),
        ]);
    }

    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    public function save()
    {
        // dd($this->validateModel());

        $this->validateModel();

        $this->topic->fill($this->getModel())->save();

        $this->emit('hideModal');
        $this->emit('$refresh');
    }


    public function store(Request $request)
    {
        if ($request->summernoteInput!='') {
            $detail=$request->summernoteInput;
        }else{
            $detail=$this->inf;
        }
// dd($detail);

		$dom = new \domdocument();

		@$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

		$images = $dom->getelementsbytagname('img');

		foreach($images as $k => $img){
			$data = $img->getattribute('src');

			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);

			$data = base64_decode($data);
			$image_name= time().$k.'.png';
			$path = public_path() .'/assets/images/topic'. $image_name;

			file_put_contents($path, $data);

			$img->removeattribute('src');
			$img->setattribute('src', $image_name);
		}

		$detail = $dom->savehtml();

		// $summernote = new Topic;
		// $summernote->note = $detail;
		// $summernote->subject_id = $request->subject_id;
		// $summernote->name = $request->name;
		// $summernote->class_id = $request->class_id;
		// $summernote->school_id = Auth::user()->school_id;

        // dd($summernote->content );
		// $summernote->save();
        $que = Topic::updateOrCreate(
            ['name'=>$request->name,'class_id'=>$request->class_id,'subject_id'=>$request->subject_id,'school_id'=>Auth::user()->school_id,'term'=>$request->term],
            ['note'=>$detail]
        );

        $this->emit('hideModal');
        $this->emit('$refresh');
        	  return redirect('/topics');

    }
}
