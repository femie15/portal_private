<?php

namespace App\Components\Schools;

use Bastinald\Ux\Traits\WithModel;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Payhistory extends Component
{
    use WithModel, WithPagination;

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('payhistory', static::class)
            ->name('payhistory')
            ->middleware('auth');
    }

    public function mount()
    {
        $this->setModel([
            'sort' => 'Name',
            'sorts' => ['Name', 'Newest', 'Oldest'],
            'filter' => 'All',
            'filters' => ['All', '100th'],
        ]);
    }

    public function render()
    {
        // $acc='7071111111';
        $acc='\App\Components\Dashboard'::checkaccount()[0]->account_num;
        return view('schools.payhistory', [
            'schools' => $this->hist($acc),
            // 'schools' => $this->query()->paginate(),
        ]);
    }

    public function hist($acc)
    {
    $url = 'https://dashboard.coinplanner.com.ng/api/webservice/acchistory/'.$acc;
            //open connection
            $hd=[
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer 2|wU2nWh2qAvY8QEFPYOZpsul16zN6lCH4kIjopNQe'
                ];
            $ch = curl_init();
            $query =curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    $response = curl_exec($ch);
                
                    curl_close($ch);
                    $quizzes = json_decode($response);
                    
                    if ($quizzes) {
                        return $quizzes;
                    }else {
                        return [];
                    }
                   
    }

    public function query()
    {
        $query = School::query();
        // $query->where('school_id', Auth::user()->school_id);

        if ($search = $this->getModel('search')) {
            $query->where(function (Builder $query) use ($search) {
                $query->orWhere('id', 'like', '%' . $search . '%');
                $query->orWhere('name', 'like', '%' . $search . '%');
            });
        }

        switch ($this->getModel('sort')) {
            case 'Name': $query->orderBy('name'); break;
            case 'Newest': $query->orderByDesc('created_at'); break;
            case 'Oldest': $query->orderBy('created_at'); break;
        }

        switch ($this->getModel('filter')) {
            case 'All': break; 
            case '100th': $query->where('id', 100); break;
        }

        return $query;
    }

    public function delete(School $school)
    {
        $school->delete();
    }
}
