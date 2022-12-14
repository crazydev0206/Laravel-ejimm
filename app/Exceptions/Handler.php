<?php

namespace FleetCart\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Swift_TransportException;
use Modules\Sms\Exceptions\SmsException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Throwable  $e
     * @return void
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof Swift_TransportException) {
            return $this->handleSwiftException($request, $e);
        }

        if ($e instanceof SmsException) {
            return $this->handleSmsException($request, $e);
        }

        if ($e instanceof ValidationException && $request->ajax()) {
            return response()->json([
                'message' => trans('core::messages.the_given_data_was_invalid'),
                'errors' => $e->validator->getMessageBag(),
            ], 422);
        }

        if ($this->shouldRedirectToAdminDashboard($e)) {
            return redirect()->route('admin.dashboard.index');
        }

        if ($this->shouldShowNotFoundPage($e)) {
            return response()->view('errors.404');
        }

        return parent::render($request, $e);
    }

    /**
     * Handle swift transport exception.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Swift_TransportException $e
     * @return mixed
     *
     * @throws \Swift_TransportException
     */
    private function handleSwiftException(Request $request, Swift_TransportException $e)
    {
        if (config('app.debug')) {
            throw $e;
        }

        if ($request->ajax()) {
            abort(400, trans('core::messages.mail_is_not_configured'));
        }

        return back()->withInput()
            ->with('error', trans('core::messages.mail_is_not_configured'));
    }

    /**
     * Handle sms exception.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Sms\Exceptions\SmsException $e
     * @return mixed
     *
     * @throws \Modules\Sms\Exceptions\SmsException
     */
    private function handleSmsException(Request $request, SmsException $e)
    {
        if (config('app.debug')) {
            throw $e;
        }

        if ($request->ajax()) {
            abort(400, $e->getMessage());
        }

        return back()->withInput()->with('error', $e->getMessage());
    }

    /**
     * Determine whether response should redirect to the admin dashboard.
     *
     * @param \Throwable $e
     * @return bool
     */
    private function shouldRedirectToAdminDashboard(Throwable $e)
    {
        if (config('app.debug') || ! $this->inAdminPanel()) {
            return false;
        }

        return $e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException;
    }

    /**
     * Determine if the response should show not found page.
     *
     * @param \Throwable $e
     * @return bool
     */
    private function shouldShowNotFoundPage(Throwable $e)
    {
        if ($this->inAdminPanel()) {
            return false;
        }

        return $e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException;
    }

    /**
     * Determine if the request is from admin panel.
     *
     * @return bool
     */
    private function inAdminPanel()
    {
        return $this->container->has('inAdminPanel') && $this->container['inAdminPanel'];
    }
}
