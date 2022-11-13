<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\MaterialInput;
use App\Models\Subject;
use App\Models\Teaching;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SplashLivewire extends Component
{
    public $kelas, $jurusan_no_kelas, $matapelajaran, $description, $judul, $alljurusan_no_kelas = [], $allmatapelajaran = [], $materi = [], $display = 1;

    public function render()
    {
        $allkelas   = Teaching::groupBy('kelas')->where('id_guru', Auth::user()->id_guru)->get('kelas');
        return view('livewire.splash-livewire', compact('allkelas'));
    }

    public function next()
    {
        $this->display = 2;
        if ($this->kelas == 'X') {
            $this->materi = MaterialInput::where('guru', Auth::user()->id_guru)->where('matapelajaran', $this->matapelajaran)->where('no_kelas', $this->jurusan_no_kelas)->get();
        } else {
            $jurusan        = Department::where('jurusan', $this->jurusan_no_kelas)->first();
            $this->materi   = MaterialInput::where('guru', Auth::user()->id_guru)->where('matapelajaran', $this->matapelajaran)->where('jurusan', $jurusan->id)->get();
        }
    }

    public function back()
    {
        $this->materi = [];
        $this->display = 1;
    }

    public function submit()
    {
        $mapel      = Subject::where('matapelajaran', $this->matapelajaran)->first();
        $jurusan    = Department::where('jurusan', $this->jurusan_no_kelas)->first();
        if ($this->kelas == 'X') {
            $material = MaterialInput::create([
                'judul'         => $this->judul,
                'pembahasan'    => $this->description,
                'kelas'         => $this->kelas,
                'matapelajaran' => $mapel->id,
                'no_kelas'      => $this->jurusan_no_kelas,
                'guru'          => Auth::user()->id_guru,
            ]);
        } else {
            $material = MaterialInput::create([
                'judul'         => $this->judul,
                'pembahasan'    => $this->description,
                'kelas'         => $this->kelas,
                'matapelajaran' => $mapel->id,
                'jurusan'       => $jurusan->id,
                'guru'          => Auth::user()->id_guru,
            ]);
        }

        return redirect(route('attendance.dashboard', $material->id));
    }

    public function jurusan_no_kelas()
    {
        $this->jurusan_no_kelas = '';
        $this->matapelajaran = '';
        if ($this->kelas == 'X') {
            $this->alljurusan_no_kelas = Teaching::orderBy('no_kelas')->where('id_guru', Auth::user()->id_guru)->where('kelas', $this->kelas)->get();
        } else {
            $this->alljurusan_no_kelas = Teaching::orderBy('jurusan')->where('id_guru', Auth::user()->id_guru)->where('kelas', $this->kelas)->get();
        }
    }

    public function matapelajaran()
    {
        $this->matapelajaran = '';
        if ($this->kelas == 'X') {
            $this->allmatapelajaran = Teaching::orderBy('matapelajaran')->where('id_guru', Auth::user()->id_guru)->where('no_kelas', $this->jurusan_no_kelas)->where('kelas', $this->kelas)->get();
        } else {
            $jurusan                = Department::where('jurusan', $this->jurusan_no_kelas)->first();
            $this->allmatapelajaran = Teaching::orderBy('matapelajaran')->where('id_guru', Auth::user()->id_guru)->where('jurusan', $jurusan->id)->where('kelas', $this->kelas)->get();
        }
    }

}
