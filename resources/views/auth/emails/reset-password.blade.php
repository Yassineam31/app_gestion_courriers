<x-mail::message>
{{-- Greeting --}}
# @lang('مرحباً!')

{{-- Intro Lines --}}
@lang('لقد تلقينا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك.')

{{-- Action Button --}}
<x-mail::button :url="$resetUrl">
@lang('إعادة تعيين كلمة المرور')
</x-mail::button>

{{-- Outro Lines --}}
@lang("إدارة منصة تدبير المراسلات")

{{-- Salutation --}}
@lang('&copy; 2025')<br>
</x-mail::message>
