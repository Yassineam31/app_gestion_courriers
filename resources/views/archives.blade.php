@extends('layout')
@section('title','الأرشيف')
@section('main-content')
    <div class="container">
        <div class="row" style='position:absolute;top:20%;margin-right:150px;'>
            <div class="col-lg-6 col-sm-12">
                <a href="{{route('archive_entrants.index')}}" class="button courrierEntrant" style='text-decoration:none;color:black;'>
                    <i class="fa-solid fa-inbox me-2" style="font-size:30px;color:black;"></i> أرشيف البريد الوارد
                </a>
            </div>
            <div class="col-lg-6 col-sm-12">
                <a href="{{route('archive_sortants.index')}}" class="button courrierSortant" style='text-decoration:none;color:black;'>
                    <i class="fa-regular fa-envelope me-2" style="font-size:30px;"></i> أرشيف البريد الصادر
                </a>
            </div>
        </div>
    </div>
@endsection
</body>
</html>