<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            {{-- <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div> --}}
            
            <div>
                <x-label for="login" :value="__('Username or Email')" />
                {{-- <div class="col-md-12"> --}}
                <x-input  id="login" class="block mt-1 w-full" type="text"
                    class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                    name="login" value="{{ old('username') ?: old('email') }}" required autofocus />
        
                @if ($errors->has('username') || $errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                    </span>
                @endif
        {{-- </div> --}}

                {{-- <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus /> --}}
            </div>

            <!-- Password -->
            <div class="mt-6">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="cta">
                <x-button class="block mt-1 w-full ">
                    <div class="text-center" >
                        {{ __('Log in') }}
                    </div>
                  
                </x-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif                

                
                 <span class="ml-3 "> <a href="/register" class="underline text-sm text-gray-600 hover:text-gray-900" > {{ __('Sign up') }}</a> </span>
                
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
