<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="text-right"><span class="text-red-600">*</span>{{__('البريد الإلكتروني')}}</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full text-right" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
        <x-input-label for="password" class="text-right"><span class="text-red-600">*</span>{{__('كلمة المرور')}}</x-input-label>
            <x-text-input id="password" class="block mt-1 w-full text-right"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline mr-40 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('نسيت كلمة المرور؟') }}
                </a>
            @endif

            <x-primary-button class="mr-1 bg-black">
                {{ __('تسجيل الدخول') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

