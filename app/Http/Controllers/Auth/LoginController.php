<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


     public function __construct()
     {
         $this->middleware('guest', ['except' => 'logout']); //impide que usuarios logeados se vuelvan a logear
     }

     /**
      * Get the login username to be used by the controller.
      *
      * @return string
      */
     public function username()
     {
         return 'usuario';
     }

        /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
      $credentials = $this->credentials($request);
      $credentials['habilitado'] = 1; //se añade la entrada como que tiene que matchear un usuario, un pass y tambien un campo como que este autorizado. Si no matchea un usuario que no esta autorizado entonces no debería entrar
      return $this->guard()->attempt(
          $credentials, $request->has('remember')
      );
    }
}
