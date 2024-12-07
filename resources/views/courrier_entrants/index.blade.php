@extends('layout')
@section('title','البريد الوارد')
@section('main-content')
<div class="container" id="mainContent">
    <table class="table table-striped table-hover">
        <tr>
            <td colspan='7' style="background-color: #353b49;">
                <div class="d-flex" style="position:relative;">
                    <button class="btn ajouter"><a href="{{route('courrier_entrants.create')}}" style="text-decoration:none;color:#000;font-weight:500;"><i class="fa-solid fa-circle-plus"></i>إضافة بريد</a></button>
                    <form action="" method="post">
                        @csrf
                        <input type="search" dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
                    </form>
                    <h4 class='courrier'>البريد الوارد</h4>
                </div>
            </td>
         </tr>
        <tr dir='rtl'>
            <th>المرجع</th>
            <th>رقم التسجيل بالأكاديمية</th>
            <th>تاريخ التسجيل بالأكاديمية</th>
            <th>المرسل</th>
            <th>موضوع المراسلة</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
        @forelse($courrier_entrants as $courrier_entrant)
        <tr>
            <td>{{$courrier_entrant->Reference}}</td>
            <td>{{$courrier_entrant->NumeroInscriptionAcademie}}</td>
            <td>{{$courrier_entrant->DateInscriptionAcademie}}</td>
            <td>{{$courrier_entrant->Expediteur}}</td>
            <td style="max-width: 200px; word-wrap: break-word;">{{$courrier_entrant->SujetCorrespondance}}</td>
            <td>{{$courrier_entrant->Statut}}</td>
            <td>
                <a href="" title='أرشفة'><i class="fa-solid fa-inbox"></i></a>
                |<a href="{{route('courrier_entrants.edit',$courrier_entrant->id)}}" title='تغيير'><i class="fa-solid fa-pen-to-square" style="margin-right:2px;"></i></a><br>
                <a href="{{route('courrier_entrants.show',$courrier_entrant->id)}}" title='إظهار'> <i class="fa-solid fa-eye"></i></a>
                |<button id="" title='مسح'><i class="fa-solid fa-trash" style="margin-right:6px;"></i></button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan=7 class='text-center'><b>لا يوجد بريد</b></td>
        </tr>
        @endforelse
    </table>
    <div dir='ltr' class="pagination-centered">
        {{ $courrier_entrants->links() }}
    </div>
</div>

@endsection