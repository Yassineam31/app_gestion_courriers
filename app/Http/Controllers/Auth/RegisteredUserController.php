<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','unique:'.User::class,
                function ($attribute, $value, $fail) {
                    if (!preg_match('/@(taalim\.ma|men\.gov\.ma)$/', $value)) {
                        $fail(" @taalim.ma أو @men.gov.maيجب أن يتضمن البريد الإلكتروني فقط  ");
                    }
                },],
            'password' => [
                'required',
                'confirmed',
                function ($attribute, $value, $fail) {
                    if (strlen($value) < 8) {
                        $fail('يجب أن تحتوي كلمة المرور على الأقل على 8 أحرف.');
                    } else if ($value !== request()->input('password_confirmation')) {
                        $fail('لا يتطابق حقل تأكيد كلمة المرور.');
                    }
                },],  
            'division' => ['required', 'string', 'max:255'],
            'services' => [ 'nullable','string', 'max:255'],
            'poste' => ['required', 'string', 'max:255'],
        ]);
        $request['services'] = $request['services'] ?? '';
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'division' => $request->division,
            'services' => $request['services'],
            'poste' => $request->poste,
        ]);
        event(new Registered($user));
        return redirect('/login');
    }
}
