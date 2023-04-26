<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    protected $guard = 'web';

    public function __construct(Request $request)
    {
        if ($request->is('admin/*')){
            $this->guard = 'admin';
        }
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        if ($this->guard == 'admin'){
            return view('admin.auth.login');
        }
        return view('web.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate($this->guard);

        $request->session()->regenerate();

        return redirect()->intended($this->guard == 'admin' ? 'admin/' : session('current_url'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard($this->guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        if ($this->guard == 'admin'){
            return redirect()->route('admin.login');
        }
        return redirect()->route('index');
    }

    /**
     * Destroy an authenticated session.
     */
    public function delete(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');

    }
}
