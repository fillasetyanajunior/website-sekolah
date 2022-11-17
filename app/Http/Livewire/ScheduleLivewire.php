<?php

namespace App\Http\Livewire;

use App\Models\Schedule;
use Livewire\Component;
use Livewire\WithPagination;

class ScheduleLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = null, $title;
    protected $queryString = ['search'];

    public function mount($title)
    {
        $this->title =$title;
    }

    public function render()
    {
        if ($this->search == null) {
            $schedule = Schedule::paginate(20);
        } else {
            $schedule = Schedule::where('kelas', $this->search)->paginate(20);
        }

        return view('livewire.schedule-livewire', compact('schedule'));
    }
}
