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
    @lang("إذا لم تطلب إعادة تعيين كلمة المرور، فلا داعي لاتخاذ أي إجراء .")

{{-- Salutation --}}
@lang('مع تحياتنا،'),<br>
</x-mail::message>
