<?php

namespace App\Livewire\Auth;


use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Login extends Component
{

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * @throws ValidationException
     */
    public function login(): void
    {

        try{
            $this->validate();

            $this->ensureIsNotRateLimited();
            if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                RateLimiter::hit($this->throttleKey());
            }

            $user = User::query()->where('email', $this->email)->first();
            if(blank($user)){
                throw new \Exception('User not found');
            }
            $isValid = Hash::check($this->password, $user->password);

            if(!$isValid){
                throw new \Exception('Wrong password');
            }
            RateLimiter::clear($this->throttleKey());
            Session::regenerate();


            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        } catch (Exception $exception) {
            toastr()->error($exception->getMessage());
        }



    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}
