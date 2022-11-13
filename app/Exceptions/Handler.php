<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard =  Arr::get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                return redirect()->guest(route('admin.login.form'));
                break;
            case 'teacher':
                return redirect()->guest(route('teacher.login.form'));
                break;
            case 'student':
                return redirect()->guest(route('student.login.form'));
                break;
            case 'library':
                return redirect()->guest(route('library.login.form'));
                break;
            case 'student_learning':
                return redirect()->guest(route('learning.student.login.form'));
                break;
            case 'teacher_learning':
                return redirect()->guest(route('learning.teacher.login.form'));
                break;
            case 'app':
                return redirect()->guest(route('attendance.login.form'));
                break;
            case 'counseling':
                return redirect()->guest(route('counseling.login.form'));
                break;
                // default:
                //     return redirect()->guest(route('index'));
                //     break;
        }
    }
}
