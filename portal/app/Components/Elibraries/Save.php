<?php

namespace App\Components\Elibraries;

use Bastinald\Ux\Traits\WithModel;
use Livewire\WithFileUploads;
use App\Models\Elibrary;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class Save extends Component
{
    use WithFileUploads;
    use WithModel;

    public $elibrary;
    public $house,$image,$pdf,$imager;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($getImage){
        $this->image = $getImage;
    }
    public function handleFileUploadpdf($getPDF){
        $this->pdf = $getPDF;
    }
 
    // public function storeImage($imgId='')
    // {
    //     // dd($this->image);
    //     if(!$this->image || !$this->pdf){
    //          return null;
    //         }else{
    //             // encode png image as jpg
    //             $jpg = Image::make($this->image)->encode('jpg');

    //             // resize the image to a height of 413 and constrain aspect ratio (auto width)
    //             $jpg->resize(null, 413, function ($constraint) {
    //                 $constraint->aspectRatio();    
    //                 $constraint->upsize();
    //             });

    //             $jpg->save('library/ebook/images/'.$imgId.'.jpg');
    //             $this->pdf->save('library/ebook/books/'.$imgId.'.pdf');
    //     }
    // }

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


    public function mount(Elibrary $elibrary = null)
    {
        $this->elibrary = $elibrary;

        $this->setModel($elibrary->toArray());
    }

    public function render()
    {
        return view('elibraries.save', [
            'getClass'=> '\App\Components\Sections\Save'::getClass(),
            'getSubject'=> '\App\Components\Subjects\Save'::getSubject(),
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
        $this->validateModel();
        $this->setModel('school_id',Auth::user()->school_id);
        $this->elibrary->fill($this->getModel())->save();

        $image = $this->storeImage($this->elibrary->fill($this->getModel())->id);

        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
