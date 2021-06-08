<?php

namespace App\Exceptions;

use App\Http\Requests\Mode\ModeSession;
use Exception;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *  
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    public function render($request, $ex)
    {
        if ($ex instanceof MethodNotAllowedHttpException)
        {
            return redirect() -> to(ModeSession::getHomeUrl());
        }

        return parent::render($request, $ex);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Exception $e) { Log::channel('errorlog') -> error("Error - " . $e -> getMessage()); });
        $this->reportable(function (Throwable $e) { Log::channel('errorlog') -> error("Throwable - " . $e -> getMessage()); });
    }
}
