@extends('layout')
@section('title','البريد الصادر')
@section('main-content')
<div class="container" id="mainContent">
    <table class="table table-striped table-hover">
        <tr>
            <td colspan='7' style="background-color: #353b49;">
                <div class="d-flex" style="position:relative;">
                    <button class="btn ajouter"><a href="{{route('courrier_sortants.create')}}" style="text-decoration:none;color:#000;font-weight:500;"><i class="fa-solid fa-circle-plus"></i>إضافة بريد</a></button>
                    <form action="" method="post">
                        @csrf
                        <input type="search" dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
                    </form>
                    <h4 class='courrier'>البريد الصادر</h4>
                </div>
            </td>
         </tr>
        <tr dir='rtl'>
            <th>المرجع</th>
            <th>المرسل إليه</th>
            <th>رقم إرسال الأكاديمية</th>
            <th>تاريخ إرسال بالأكاديمية</th>
            <th>موضوع المراسلة</th>
            <th>الحالة</th>
            <th>الإجراء</th>
        </tr>
        @forelse($courrier_sortants as $courrier_sortant)
        <tr>
            <td>{{$courrier_sortant->Reference}}</td>
            <td>{{$courrier_sortant->Destinataire}}</td>
            <td>{{$courrier_sortant->NumeroEnvoiAcademie}}</td>
            <td>{{$courrier_sortant->DateEnvoiAcademie}}</td>
            <td style="max-width: 200px; word-wrap: break-word;">{{$courrier_sortant->ObjetCorrespondance}}</td>
            <td>{{$courrier_sortant->Statut}}</td>
            <td>
                <a href="" title='أرشفة'><i class="fa-solid fa-inbox"></i></a>
                |<a href="{{route('courrier_sortants.edit',$courrier_sortant->id)}}" title='تغيير'><i class="fa-solid fa-pen-to-square" style="margin-right:2px;"></i></a><br>
                <a href="{{route('courrier_sortants.show',$courrier_sortant->id)}}" title='إظهار'> <i class="fa-solid fa-eye"></i></a>
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
        {{ $courrier_sortants->links() }}
    </div>
</div>
@endsection