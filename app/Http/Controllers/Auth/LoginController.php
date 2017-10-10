<?php
namespace Illuminate\Foundation\Auth;
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Form;
use Lang;
use View;
use Redirect;
use SerializesModels;
use Log;

// Modelo
use App\Models\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {
        $data= $request->All();
        if (!$data['usrUserName'] && !$data['usrPassword']){
            return "No ingreso los valores correctos";
        }else{
            $model= new User();
            $result = $model->verificarUsuario($data);
            if ($result>0){
                $user = Auth::loginUsingId($result);
                if ($user){
                    return '{"code":"200","des_code":"home"}';
                }else{
                    return '{"code":"-2","des_code":"Ocurrio un error al iniciar la session"}';
                }
            }else{
                return '{"code":"-2","des_code":"Usuario o contraseña incorrectos"}';
            }
        }
    }

    public function logout(Request $request)
    {
        $idUser = Auth::id();
        $model= new User();
        $result = $model->registrarVisita($idUser);
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
