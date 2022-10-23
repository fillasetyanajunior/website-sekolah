<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Livewire\Component;

class AttandanceDashboardLivewire extends Component
{
    public $kelas, $matapelajaran, $no_kelas, $jurusan;

    public function mount($kelas, $matapelajaran, $no_kelas, $jurusan)
    {
        $this->kelas            = $kelas;
        $this->matapelajaran    = $matapelajaran;
        $this->no_kelas         = $no_kelas;
        $this->jurusan          = $jurusan;
    }
    public function render()
    {
        if ($this->kelas == 'X') {
            $students = Attendance::where('kelas', $this->kelas)->where('matapelajaran', $this->matapelajaran)->where('no_kelas', $this->no_kelas)->where('tanggal', date('Y-m-d'))->get();
        } else {
            $students = Attendance::where('kelas', $this->kelas)->where('matapelajaran', $this->matapelajaran)->where('jurusan', $this->jurusan)->where('tanggal', date('Y-m-d'))->get();
        }
        return view('livewire.attandance-dashboard-livewire', compact('students'));
    }
}
