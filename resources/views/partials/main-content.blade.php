@once
    <div class="container" id="mainContent">
        <div style='height:35px;'>
            @if(session('danger'))
                <div class="alert alert-danger text-center w-25 m-auto">
                    {{ session('danger') }}
                </div>  
            @elseif(session('succes'))
                <div class="alert alert-success text-center w-25 m-auto">
                    {{ session('succes') }}
                </div> 
            @elseif(session('success'))
                <div class="alert alert-success text-center w-25 m-auto">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        {{-- Contenu principal --}}
            @yield('main-content')
    </div>
@endonce