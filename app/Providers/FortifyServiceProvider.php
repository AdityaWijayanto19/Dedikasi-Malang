<?php

namespace App\Providers;

use App\Models\User;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Auth\Events\Login;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\FailedLoginResponse;
use Laravel\Fortify\Http\Responses\SimpleViewResponse;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                session()->flash('error', 'Email atau password salah.');
                logger()->error('LOGIN ERROR: email/password salah');
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => 'Email atau password salah.',
                ]);
            }

            if (($user->status instanceof \App\Enums\UserStatus && $user->status === \App\Enums\UserStatus::Block)
                || $user->status === 0
            ) {
                session()->flash('error', 'Akun Anda diblokir. Silakan hubungi pihak Dedikasi Malang.');
                throw new HttpResponseException(
                    redirect()->back()
                        ->withInput()
                        ->withErrors(['email' => 'Akun Anda diblokir. Silakan hubungi pihak Dedikasi Malang.'])
                );
            }

            logger()->info('LOGIN SUCCESS for ' . $user->email);
            \Illuminate\Support\Facades\Event::listen(Login::class, function ($event) {
                session()->flash('success', 'Berhasil login, selamat datang kembali, ' . $event->user->name . '!');
            });

            return $user;
        });


        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $this->app->singleton(
            LoginViewResponse::class,
            fn() => new SimpleViewResponse('auth.login')
        );
    }
}
