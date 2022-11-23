<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\MaterialInput;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teaching;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SplashLivewire extends Component
{
    public $kelas, $jurusan_no_kelas, $matapelajaran, $description, $judul, $alljurusan_no_kelas = [], $allmatapelajaran = [], $materi = [], $display = 1;

    public function render()
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum`at',
            'Sabtu',
            'Minggu'
        );

        $allkelas = Schedule::groupBy('kelas')->where('hari', $hari[date('N')])->where('guru', Auth::user()->id_guru)->get('kelas');
        return view('livewire.splash-livewire', compact('allkelas'));
    }

    public function next()
    {
        $this->display = 2;
        $mapel = Subject::where('matapelajaran', $this->matapelajaran)->first()->id;
        if ($this->kelas == 'X') {
            $this->materi = MaterialInput::where('guru', Auth::user()->id_guru)->where('matapelajaran', $mapel)->where('no_kelas', $this->jurusan_no_kelas)->get();
        } else {
            $jurusan        = Department::where('jurusan', $this->jurusan_no_kelas)->first();
            $this->materi   = MaterialInput::where('guru', Auth::user()->id_guru)->where('matapelajaran', $mapel)->where('jurusan', $jurusan->id)->get();
        }
    }

    public function back()
    {
        $this->materi = [];
        $this->display = 1;
    }

    public function submit()
    {
        $mapel = Subject::where('matapelajaran', $this->matapelajaran)->first()->id;
        if ($this->kelas == 'X') {
            $material = MaterialInput::create([
                'judul'         => $this->judul,
                'pembahasan'    => $this->description,
                'kelas'         => $this->kelas,
                'matapelajaran' => $mapel,
                'no_kelas'      => $this->jurusan_no_kelas,
                'guru'          => Auth::user()->id_guru,
            ]);
        } else {
            $jurusan    = Department::where('jurusan', $this->jurusan_no_kelas)->first()->id;
            $material   = MaterialInput::create([
                'judul'         => $this->judul,
                'pembahasan'    => $this->description,
                'kelas'         => $this->kelas,
                'matapelajaran' => $mapel,
                'jurusan'       => $jurusan,
                'guru'          => Auth::user()->id_guru,
            ]);
        }

        return redirect(route('attendance.dashboard', $material->id));
    }

    public function jurusan_no_kelas()
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum`at',
            'Sabtu',
            'Minggu'
        );
        $this->jurusan_no_kelas = '';
        $this->matapelajaran    = '';
        if ($this->kelas == 'X') {
            $this->alljurusan_no_kelas = Schedule::orderBy('no_kelas')->where('hari', $hari[date('N')])->where('guru', Auth::user()->id_guru)->where('kelas', $this->kelas)->get();
        } else {
            $this->alljurusan_no_kelas = Schedule::orderBy('jurusan')->where('hari', $hari[date('N')])->where('guru', Auth::user()->id_guru)->where('kelas', $this->kelas)->get();
        }
    }

    public function matapelajaran()
    {
        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jum`at',
            'Sabtu',
            'Minggu'
        );
        $this->matapelajaran = '';
        if ($this->kelas == 'X') {
            $this->allmatapelajaran = Schedule::orderBy('matapelajaran')->where('hari', $hari[date('N')])->where('guru', Auth::user()->id_guru)->where('no_kelas', $this->jurusan_no_kelas)->where('kelas', $this->kelas)->get();
        } else {
            $jurusan                = Department::where('jurusan', $this->jurusan_no_kelas)->first();
            $this->allmatapelajaran = Schedule::orderBy('matapelajaran')->where('hari', $hari[date('N')])->where('guru', Auth::user()->id_guru)->where('jurusan', $jurusan->id)->where('kelas', $this->kelas)->get();
        }
    }

}
