<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" dir='rtl'>
        {{ __('هذه منطقة آمنة في التطبيق. يرجى تأكيد كلمة المرور الخاصة بك قبل المتابعة.') }}
    </div>
    <form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div>
        <x-input-label for="password" :value="__('كلمة المرور')" dir='rtl'/>

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
        dir='rtl'  required autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" dir='rtl'/>
    </div>

    <div class="flex justify-end mt-4">
        <x-primary-button>
            {{ __('تأكيد') }}
        </x-primary-button>
    </div>
</form>
</x-guest-layout>
