<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $search = '';
        $data = [
            'users' => User::where('role', 'agent')
                ->where(function ($query) use ($search) {
                    $query->orwhere('first_name', 'like', '%' . $this->search . '%')
                        ->orwhere('last_name', 'like', '%' . $this->search . '%')
                        ->orwhere('agent_code', 'like', '%' . $this->search . '%')
                        ->orwhere('name', 'like', '%' . $this->search . '%')
                        ->orwhere('email', 'like', '%' . $this->search . '%');
                })->paginate(5)
        ];

        return view('livewire.data-table', $data);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
