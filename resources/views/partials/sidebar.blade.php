@once
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>@yield('title')</title>
        @vite(['resources/css/sideBar.css','resources/css/footer.css',
        'resources/css/courrierIndex.css','resources/css/dashboard.css'])
    </head>
    <body dir='rtl'>
        {{-- Sidebar --}}
        <div class="sidebar closed" id="sidebar">
            {{-- Bouton de bascule --}}
            <div id="toggleSidebar" style='color:#fff;background-color:#000;margin:15px 10px;'>
                <i class="fa fa-bars" style='font-size:25px;margin-right:5px;'></i>
            </div>
            {{-- Liens du menu --}}
            <div class="menu">
                <a href="/dasboard" class="link"><i class="fa fa-th" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">الرئيسية</span></a>
                <a href="/courrier_entrants" class="link"><i class="fa-solid fa-envelope-open" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">البريد الوارد</span></a>
                <a href="/courrier_sortants" class="link"><i class="fa-solid fa-paper-plane" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">البريد الصادر</span></a>
                <a href="/archives" class="link"><i class="fa-solid fa-box-archive" style='font-size:23px; margin-right:5px;'></i><span class="link_text">الأرشيف</span></a>
                <a href="/notifications" class="link"><i class="fa-solid fa-bell" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">تنبيهات</span></a>
                <a href="/recherche" class="link"><i class="fa-solid fa-magnifying-glass" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">بحث</span></a>
                <a href="/membres" class="link"><i class="fa-solid fa-user-group" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">أعضاء القسم</span></a>
                <a href="/gestionMembres" class="link"><i class="fa-solid fa-people-group" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">تدبير الأعضاء </span></a>
            </div>
        </div>
@endonce