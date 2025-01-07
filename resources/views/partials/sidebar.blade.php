@once
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>@yield('title')</title>
        @vite(['resources/css/sideBar.css','resources/css/courrierIndex.css','resources/css/dashboard.css','resources/css/notificationMark.css'])
    </head>
    <style>
      
    </style>
    <body dir='rtl'>
        {{-- Sidebar --}}
        <div class="sidebar closed" id="sidebar">
            {{-- Bouton de bascule --}}
            <div id="toggleSidebar" style='color:#fff;background-color:#000;margin:15px 10px;'>
                <i class="fa fa-bars" style='font-size:25px;margin-right:5px;'></i>
            </div>
            {{-- Liens du menu --}}
            <div class="menu">
                <a href="/dashboard" class="link" title="الرئيسية"><i class="fa fa-th" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">الرئيسية</span></a>
                <a href="/courrier_entrants" class="link" title="البريد الوارد"><i class="fa-solid fa-envelope-open" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">البريد الوارد</span></a>
                <a href="/courrier_sortants" class="link" title="البريد الصادر"><i class="fa-solid fa-paper-plane" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">البريد الصادر</span></a>
                <a href="/archives" class="link" title="الأرشيف"><i class="fa-solid fa-box-archive" style='font-size:23px; margin-right:5px;'></i><span class="link_text">الأرشيف</span></a>
                <a href="/notifications" class="link notification-bell" title="تنبيهات">
                    <i class="fa-solid fa-bell" style="font-size:23px; margin-right:5px;"></i>
                    <span class="notification-badge" id="notification-badge"></span>
                    <span class="link_text">تنبيهات</span>
                </a>
                <a href="/contact_section" class="link" title="قسم التواصل"><i class="fa-solid fa-user-group" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">قسم التواصل</span></a>
                @can('gestion_utilisateurs',App\Models\User::class)
                    <a href="/users" class="link" title="تدبير الأعضاء"><i class="fa-solid fa-people-group" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">تدبير الأعضاء </span></a>
                @endcan
            </div>
        </div>   
@endonce