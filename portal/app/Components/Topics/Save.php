<?php

namespace App\Components\Topics;

use Bastinald\Ux\Traits\WithModel;
use App\Models\Topic;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    use WithModel;

    public $topic,$inf;

    public function mount(Topic $topic = null)
    {
        $this->topic = $topic;
        $this->inf= $topic->note;
        $this->setModel($topic->toArray());
    }

    public function render()
    {
        return view('topics.save');
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
        // dd($this->inf);
        if ($request->summernoteInput!='') {
            $detail=$request->summernoteInput;
        }else{
            $detail=$this->inf;
            // $detail=$request->summernoteInput;
        }
// dd($detail);

		$dom = new \domdocument();

		@$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

		$images = $dom->getelementsbytagname('img');

		foreach($images as $k => $img){
			$data = $img->getattribute('src');
            // dd($k);
            $word='.jpg'; $word1='.jpeg'; $word2='.png'; $word3='.gif'; $word4='.svg';
        if (stripos($data, $word) !== false || stripos($data, $word1) !== false || stripos($data, $word2) !== false || stripos($data, $word3) !== false || stripos($data, $word4) !== false) {
              
            }else {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name= time().$k.'.png';
			$path = public_path() .'/assets/images/topic/'. $image_name;

			file_put_contents($path, $data);

			$img->removeattribute('src');
			$img->setattribute('src', '/assets/images/topic/'.$image_name);
            }
	
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
            ['id'=>$request->id,'class_id'=>$request->class_id,'subject_id'=>$request->subject_id,'school_id'=>Auth::user()->school_id,'term'=>$request->term],
            ['name'=>$request->name,'note'=>$detail]
        );

        $this->emit('hideModal');
        $this->emit('$refresh');
        	  return redirect('/topics');

    }
}
