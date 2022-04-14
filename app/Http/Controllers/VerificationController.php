<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationNotificationMail;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, RedirectsUsers;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $emailRegisterNotification = "";
    private $ApplicationName = "";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->emailRegisterNotification = env('NOTIF_MAIL_EMAIL');
         $this->ApplicationName = env('APP_NAME');

        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        // Mail::to($this->emailRegisterNotification)->send(new RegistrationNotificationMail($request->user()->email,$this->ApplicationName,
        // ($request->user()->name)));

        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        :
                        view('verification.notice', [
                            'pageTitle' => __('Account Verification'),
                        ]);
    }


    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        // Mail::to($this->emailRegisterNotification)->send(new RegistrationNotificationMail($request->user()->email,$this->ApplicationName,
        // ($request->user()->name)));

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
}
