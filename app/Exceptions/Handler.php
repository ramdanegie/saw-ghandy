<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        try {
            \DB::connection()->getPdo();
            if(\DB::connection()->getDatabaseName()){

            }else {
                $msg ='Sorry DB Not Found';
                return response()->view('module.handler.db-handler',compact('msg'));
            }
        } catch (\Exception $e) {
            $msg ='Sorry, Cant Open Connection To DB ';
            return response()->view('module.handler.db-handler',compact('msg'));
        }
//        if ($e instanceof \Illuminate\Database\QueryException) {
//            dd($e->getMessage());
//            //return response()->view('custom_view');
//        } elseif ($e instanceof \PDOException) {
//            dd($e->getMessage());
//            //return response()->view('custom_view');
//        }
        return parent::render($request, $exception);
    }
}
