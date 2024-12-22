<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>تعديل بيانات العضو</title>
    <style>
        .custom-file-input, .statut {
            width: auto;
        }
        .form-check-label, .form-check-input {
            display: inline-block;
            margin-right: 30px;
        }
        .fa-solid {
            margin-right: 10px; 
        }
        .btn-submit {
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">تعديل بيانات العضو</h1>
        <div class="d-flex justify-content-center">
            <form class="w-50" action="{{route('users.update',$user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">الإسم الكامل<span style='color:red;'>*</span>:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    @error('name')
                    <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني<span style='color:red;'>*</span>:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    @error('email')
                    <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="division" class="form-label">القسم<span style='color:red;'>*</span>:</label>
                    <select id="division" name="division" class="form-select">
                        <option value=""></option>
                        <option value="المدير" {{ $user->division == 'المدير' ? 'selected' : '' }}>المدير</option>
                        <option value="الكتابة الخاصة للسيد المدير" {{ $user->division == 'الكتابة الخاصة للسيد المدير' ? 'selected' : '' }}>الكتابة الخاصة للسيد المدير</option>
                        <option value="مكتب الضبط" {{ $user->division == 'مكتب الضبط' ? 'selected' : '' }}>مكتب الضبط</option>
                        <option value="قسم الشؤون الإدارية والمالية" {{ $user->division == 'قسم الشؤون الإدارية والمالية' ? 'selected' : '' }}>قسم الشؤون الإدارية والمالية</option>
                        <option value="قسم تدبير الموارد البشرية" {{ $user->division == 'قسم تدبير الموارد البشرية' ? 'selected' : '' }}>قسم تدبير الموارد البشرية</option>
                        <option value="قسم التخطيط والخريطة المدرسية" {{ $user->division == 'قسم التخطيط والخريطة المدرسية' ? 'selected' : '' }}>قسم التخطيط والخريطة المدرسية</option>
                        <option value="قسم الشؤون التربوية" {{ $user->division == 'قسم الشؤون التربوية' ? 'selected' : '' }}>قسم الشؤون التربوية</option>
                        <option value="المركز الجهوي لمنظومة الإعلام في حكم قسم" {{ $user->division == 'المركز الجهوي لمنظومة الإعلام في حكم قسم' ? 'selected' : '' }}>المركز الجهوي لمنظومة الإعلام في حكم قسم</option>
                    </select>
                    @error('division')
                    <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="services" class="form-label">المصلحة :</label>
                    <select id="services" name="services" class="form-select">
                        <option value=""></option>
                        <option value="مصلحة التواصل وتتبع أشغال المجلس الإداري" {{ $user->services == "مصلحة التواصل وتتبع أشغال المجلس الإداري" ? 'selected' : '' }}>مصلحة التواصل وتتبع أشغال المجلس الإداري</option>
                        <option value="مصلحة الشؤون القانونية والشراكة" {{ $user->services == "مصلحة الشؤون القانونية والشراكة" ? 'selected' : '' }}>مصلحة الشؤون القانونية والشراكة</option>
                        <option value="مصلحة التعلم والتكوين عن بعد" {{ $user->services == "مصلحة التعلم والتكوين عن بعد" ? 'selected' : '' }}>مصلحة التعلم والتكوين عن بعد</option>
                        <option value="المركز الجهوي للإمتحانات" {{ $user->services == "المركز الجهوي للإمتحانات" ? 'selected' : '' }}>المركز الجهوي للإمتحانات</option>
                        <option value="الوحدة الجهوية للإفتحاص" {{ $user->services == "الوحدة الجهوية للإفتحاص" ? 'selected' : '' }}>الوحدة الجهوية للإفتحاص</option>
                        <option value="المركز الجهوي للتوجيه المدرسي والمهني" {{ $user->services == "المركز الجهوي للتوجيه المدرسي والمهني" ? 'selected' : '' }}>المركز الجهوي للتوجيه المدرسي والمهني</option>
                        <option value="المختبر الجهوي للإبتكار وإنتاج الموارد الرقمية" {{ $user->services == "المختبر الجهوي للإبتكار وإنتاج الموارد الرقمية" ? 'selected' : '' }}>المختبر الجهوي للإبتكار وإنتاج الموارد الرقمية</option>
                        <option value="مصلحة الميزانية والمحاسبة" {{ $user->services == "مصلحة الميزانية والمحاسبة" ? 'selected' : '' }}>مصلحة الميزانية والمحاسبة</option>
                        <option value="مصلحة البناءات والتجهيزات والتهيئة والممتلكات" {{ $user->services == "مصلحة البناءات والتجهيزات والتهيئة والممتلكات" ? 'selected' : '' }}>مصلحة البناءات والتجهيزات والتهيئة والممتلكات</option>
                        <option value="مصلحة المشتريات والصفقات" {{ $user->services == "مصلحة المشتريات والصفقات" ? 'selected' : '' }}>مصلحة المشتريات والصفقات</option>
                        <option value="مصلحة الدعم الإجتماعي" {{ $user->services == "مصلحة الدعم الإجتماعي" ? 'selected' : '' }}>مصلحة الدعم الإجتماعي</option>
                        <option value="مصلحة التدبير التوقعي للموارد البشرية وإعادة الإنتشار" {{ $user->services == "مصلحة التدبير التوقعي للموارد البشرية وإعادة الإنتشار" ? 'selected' : '' }}>مصلحة التدبير التوقعي للموارد البشرية وإعادة الإنتشار</option>
                        <option value="مصلحة تدبير الوضعيات الإدارية للموظفين" {{ $user->services == "مصلحة تدبير الوضعيات الإدارية للموظفين" ? 'selected' : '' }}>مصلحة تدبير الوضعيات الإدارية للموظفين</option>
                        <option value="مصلحة تدبير المسار المهني للموظفين والإرتقاء بالموارد البشرية" {{ $user->division == "مصلحة تدبير المسار المهني للموظفين والإرتقاء بالموارد البشرية" ? 'selected' : '' }}>مصلحة تدبير المسار المهني للموظفين والإرتقاء بالمواردالبشرية</option>
                        <option value="مصلحة التخطيط والخريطة المدرسية" {{ $user->services == "مصلحة التخطيط والخريطة المدرسية" ? 'selected' : '' }}>مصلحة التخطيط والخريطة المدرسية</option>
                        <option value="مصلحة الإحصاء والدراسات" {{ $user->services == "مصلحة الإحصاء والدراسات" ? 'selected' : '' }}> مصلحة الإحصاء والدراسات</option>
                        <option value="مصلحة الإرتقاء بتدبير المؤسسات التعليمية" {{ $user->services == "مصلحة الإرتقاء بتدبير المؤسسات التعليمية" ? 'selected' : '' }}>مصلحة الإرتقاء بتدبير المؤسسات التعليمية</option>
                        <option value="مصلحة الإشراف على مؤسسات التعليم المدرسي الخصوصي" {{ $user->services == "مصلحة الإشراف على مؤسسات التعليم المدرسي الخصوصي" ? 'selected' : '' }}>مصلحة الإشراف على مؤسسات التعليم المدرسي الخصوصي</option>
                        <option value="مصلحة التربية الدامجة" {{ $user->services == "مصلحة التربية الدامجة" ? 'selected' : '' }}>مصلحة التربية الدامجة</option>
                        <option value="المركز الجهوي للتوثيق والتنشيط والإنتاج التربوي" {{ $user->services == "المركز الجهوي للتوثيق والتنشيط والإنتاج التربوي" ? 'selected' : '' }}>المركز الجهوي للتوثيق والتنشيط والإنتاج التربوي</option>
                        <option value="مصلحة الرياضة المدرسية" {{ $user->services == "مصلحة الرياضة المدرسية" ? 'selected' : '' }}>مصلحة الرياضة المدرسية</option>
                        <option value="مصلحة التعليم الأولي" {{ $user->services == 'مصلحة التعليم الأولي' ? 'selected' : '' }}>مصلحة التعليم الأولي</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="poste" class="form-label">الصفة<span style='color:red;'>*</span>:</label>
                    <input type="text" class="form-control" id="poste" name="poste" value="{{ $user->poste }}">
                    @error('poste')
                    <span class='text-danger'>{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-submit">حــفظ<i class="fa-solid fa-floppy-disk"></i></button>
            </form>
        </div>
    </div>
</body>
</html>
