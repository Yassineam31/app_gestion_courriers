@once
    <div class="container" id="mainContent">
        <div style='height:35px;'>
            @if(session('danger'))
                <div class="alert alert-danger text-center m-auto" style='width:300px;'>
                    {{ session('danger') }}
                </div>  
            @elseif(session('succes'))
                <div class="alert alert-success text-center m-auto" style='width:300px;'>
                    {{ session('succes') }}
                </div> 
            @elseif(session('success'))
                <div class="alert alert-success text-center m-auto" style='width:350px;'>
                    {{ session('success') }}
                </div>
            @endif
        </div>
        {{-- Contenu principal --}}
            @yield('main-content')
    </div>
        @vite(['resources/js/sideBar.js','resources/js/alerts.js','resources/js/notificationMark.js'])
</body>
</html> 
@endonce