<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
  
class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function checkDuplicateEmail(Request $request)
    {
        $email = $request->input('email');

        // Realiza la consulta en tu base de datos para verificar si el correo ya está registrado
        $isDuplicate = User::where('email', $email)->exists();

        return response()->json(['duplicate' => $isDuplicate]);
    }
  
    public function registerSave(Request $request)
    {
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'es_empresa' => $request->es_empresa,
        'password' => Hash::make($request->password),
        'level' => 'User'
    ]);

    if($request->es_empresa == 1){
        Empresa::create([
            'user_email' => $request->email,
            'razon_social' => $request->razon_social,
            'giro' => $request->giro,
            'nit' => $request->nit,
            'exenta_iva' => $request->exenta_iva,
            'registro_iva' => $request->registro_iva
        ]);
    }
}
  
    public function login()
    {
        return view('auth/login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();
  
        // Obtiene al usuario actualmente autenticado
        $user = Auth::user();

        if ($user->level === 'Admin') {
            // El usuario es un administrador, redirige al dashboard de administración.
            return redirect()->route('dashboard');
        } else {
            // El usuario no es un administrador, redirige al "/" (home).
            return redirect('/');
        }
    }
  
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/');
    }
 
    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        //$user->save();
        
        return redirect()->route('welcome')->with('success', 'Perfil actualizado con éxito');
    }
    
}