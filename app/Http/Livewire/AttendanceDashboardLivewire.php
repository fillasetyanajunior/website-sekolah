<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AttendanceDashboardLivewire extends Component
{
    public $kelas, $matapelajaran, $no_kelas, $jurusan, $guru;

    public function mount($kelas, $matapelajaran, $no_kelas, $jurusan, $guru)
    {
        $this->kelas            = $kelas;
        $this->matapelajaran    = $matapelajaran;
        $this->no_kelas         = $no_kelas;
        $this->jurusan          = $jurusan;
        $this->guru             = $guru;
    }
    public function render()
    {
        if ($this->kelas == 'X') {
            $students = Attendance::where('kelas', $this->kelas)->where('matapelajaran', $this->matapelajaran)->where('guru', $this->guru)->where('no_kelas', $this->no_kelas)->where('tanggal', date('Y-m-d'))->get();
        } else {
            $students = Attendance::where('kelas', $this->kelas)->where('matapelajaran', $this->matapelajaran)->where('guru', $this->guru)->where('jurusan', $this->jurusan)->where('tanggal', date('Y-m-d'))->get();
        }
        return view('livewire.attendance-dashboard-livewire', compact('students'));
    }

    public function destroy($attendance)
    {
        Attendance::destroy(Crypt::decrypt($attendance));
    }
}
