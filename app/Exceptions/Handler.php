<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
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
    public function render($request, Throwable $e)
    {
        $exception = FlattenException::createFromThrowable($e);
        $statusCode = $exception->getStatusCode();

        if ($statusCode == 404) {
            if($request->ajax()) {
                return new JsonResponse(['This URL doesn\'t exists.'], 404);
            }

            return response()->view('default.errors.404', [], 404);
        }

        if ($statusCode == 500 && config('app.debug') === false) {
            return response()->view('default.errors.500', ['exceptionMessage' => $e->getMessage()], 404);
        }

        return parent::render($request, $e);
    }
}
