<x-guest-layout>
<div style='height:35px;'>
            @if(session('success'))
                <div class="alert alert-success text-center m-auto" style='width:350px;'>
                    {{ session('success') }}
                </div>
            @endif
        </div>
    <form method="POST" action="{{ route('register') }}" class="w-full max-w-lg mx-auto">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-right text-sm font-medium text-gray-700"><span class="text-red-600">*</span>{{ __('الإسم الكامل') }}</label>
            <input id="name" type="text" dir="rtl" name="name" :value="old('name')" required autofocus autocomplete="name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-right text-sm font-medium text-gray-700"><span class="text-red-600">*</span>{{ __('البريد الإلكتروني') }}</label>
            <input id="email" dir="rtl" type="email" name="email" :value="old('email')" required autocomplete="username" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Division -->
        <div class="mb-4">
            <label for="division" class="block text-right text-sm font-medium text-gray-700"><span class="text-red-600">*</span>{{ __('القسم') }}</label>
            <select id="division" dir="rtl" name="division" required class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                <option value=""></option>
                <option value="المدير">المدير</option>
                <option value="الكتابة الخاصة للسيد المدير">الكتابة الخاصة للسيد المدير</option>
                <option value="مكتب الضبط">مكتب الضبط</option>
                <option value="قسم الشؤون الإدارية والمالية">قسم الشؤون الإدارية والمالية</option>
                <option value="قسم تدبير الموارد البشرية">قسم تدبير الموارد البشرية</option>
                <option value="قسم التخطيط والخريطة المدرسية">قسم التخطيط والخريطة المدرسية</option>
                <option value="قسم الشؤون التربوية">قسم الشؤون التربوية</option>
                <option value="المركز الجهوي لمنظومة الإعلام في حكم قسم">المركز الجهوي لمنظومة الإعلام في حكم قسم</option>
            </select>
            <x-input-error :messages="$errors->get('division')" class="mt-2" />
        </div>

        <!-- Poste -->
        <div class="mb-4">
            <label for="poste" class="block text-right text-sm font-medium text-gray-700"><span class="text-red-600">*</span>{{ __('الصفة') }}</label>
            <input id="poste" name="poste" dir="rtl" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" list="poste-options">
                <datalist id="poste-options">
                    <option value="مدير">مدير</option>
                    <option value="رئيس قسم">رئيس قسم</option>
                </datalist>
            <x-input-error :messages="$errors->get('poste')" class="mt-2" />
        </div>


         <!-- Services -->
         <div class="mb-4">
            <label for="services" class="block text-right text-sm font-medium text-gray-700">{{ __('المصلحة') }}</label>
            <select id="services" name="services" class="block w-full border border-gray-300 rounded-md p-2" dir="rtl">
                <option value=""></option>
                <option value="مصلحة التواصل وتتبع أشغال المجلس الإداري">مصلحة التواصل وتتبع أشغال المجلس الإداري</option>
                <option value="مصلحة الشؤون القانونية والشراكة">مصلحة الشؤون القانونية والشراكة</option>
                <option value="مصلحة التعلم والتكوين عن بعد">مصلحة التعلم والتكوين عن بعد</option>
                <option value="المركز الجهوي للإمتحانات">المركز الجهوي للإمتحانات</option>
                <option value="الوحدة الجهوية للإفتحاص">الوحدة الجهوية للإفتحاص</option>
                <option value="المركز الجهوي للتوجيه المدرسي والمهني">المركز الجهوي للتوجيه المدرسي والمهني</option>
                <option value="المختبر الجهوي للإبتكار وإنتاج الموارد الرقمية">المختبر الجهوي للإبتكار وإنتاج الموارد الرقمية</option>
                <option value="مصلحة الميزانية والمحاسبة">مصلحة الميزانية والمحاسبة</option>
                <option value="مصلحة البناءات والتجهيزات والتهيئة والممتلكات">مصلحة البناءات والتجهيزات والتهيئة والممتلكات</option>
                <option value="مصلحة المشتريات والصفقات">مصلحة المشتريات والصفقات</option>
                <option value="مصلحة الدعم الإجتماعي">مصلحة الدعم الإجتماعي</option>
                <option value="مصلحة التدبير التوقعي للموارد البشرية وإعادة الإنتشار">مصلحة التدبير التوقعي للموارد البشرية وإعادة الإنتشار</option>
                <option value="مصلحة تدبير الوضعيات الإدارية للموظفين">مصلحة تدبير الوضعيات الإدارية للموظفين</option>
                <option value="مصلحة تدبير المسار المهني للموظفين والإرتقاء بالموارد البشرية">مصلحة تدبير المسار المهني للموظفين والإرتقاء بالمواردالبشرية</option>
                <option value="مصلحة التخطيط والخريطة المدرسية">مصلحة التخطيط والخريطة المدرسية</option>
                <option value="مصلحة الإحصاء والدراسات"> مصلحة الإحصاء والدراسات</option>
                <option value="مصلحة الإرتقاء بتدبير المؤسسات التعليمية">مصلحة الإرتقاء بتدبير المؤسسات التعليمية</option>
                <option value="مصلحة الإشراف على مؤسسات التعليم المدرسي الخصوصي">مصلحة الإشراف على مؤسسات التعليم المدرسي الخصوصي</option>
                <option value="مصلحة التربية الدامجة">مصلحة التربية الدامجة</option>
                <option value="المركز الجهوي للتوثيق والتنشيط والإنتاج التربوي">المركز الجهوي للتوثيق والتنشيط والإنتاج التربوي</option>
                <option value="مصلحة الرياضة المدرسية">مصلحة الرياضة المدرسية</option>
                <option value="مصلحة التعليم الأولي">مصلحة التعليم الأولي</option>
            </select>
            <x-input-error :messages="$errors->get('services')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-right text-sm font-medium text-gray-700"><span class="text-red-600">*</span>{{ __('كلمة المرور') }}</label>
            <input id="password" dir="rtl" type="password" name="password" required autocomplete="new-password" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-right text-sm font-medium text-gray-700"><span class="text-red-600">*</span>{{ __('إعادة كلمة المرور') }}</label>
            <input id="password_confirmation" dir="rtl" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 p-2 block w-full border border-gray-300 rounded-md">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="ml-4 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">{{ __('تسجيل') }}</button>
        </div>
    </form>
    <div class="users text-center mt-3">
        <a href="/dashboard" style='color:blue;'>الرئيسية</a> | <a href="/users" style='color:blue;'>تدبير الأعضاء</a>
    </div>
    @vite('resources/js/alerts.js')
</x-guest-layout>