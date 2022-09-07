<?php

namespace App\View\Components;

use App\Models\Classroom;
use App\Models\StudentDetail;
use App\Models\TeacherDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SliderbarLearning extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (Auth::guard('student_learning')->check()) {
            $student = StudentDetail::find(Auth::user()->id_siswa);
            $class = Classroom::where('jurusan',$student->jurusan)->where('kelas',$student->kelas)->get();
        }else {
            $class = Classroom::where('id_guru',Auth::user()->id_guru)->get();
        }
        return view('components.sliderbar-learning',compact('class'));
    }
}
