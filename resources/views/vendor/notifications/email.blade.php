<x-mail::message>
{{-- Salutation --}}
# @lang('مرحباً!')

{{-- Message d'introduction --}}
@lang('لقد تلقينا طلباً لإعادة تعيين كلمة المرور الخاصة بحسابك.')

{{-- Bouton d'action --}}
<x-mail::button :url="$actionUrl" color="primary">
    @lang('إعادة تعيين كلمة المرور')
</x-mail::button>

{{-- Message de conclusion --}}
@lang("إذا لم تطلب إعادة تعيين كلمة المرور، فلا داعي لاتخاذ أي إجراء")

{{-- Signature --}}
@lang('مع تحياتنا')

</x-mail::message>
