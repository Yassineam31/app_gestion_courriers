@extends('layout')
@section('title','البريد الصادر')
@section('main-content')
    <table class="table table-striped table-hover">
        <tr>
            <td colspan='7' style="background-color: #353b49;">
                <div class="d-flex" style="position:relative;">
                    <button class="btn ajouter"><a href="{{route('courrier_sortants.create')}}" style="text-decoration:none;color:#000;font-weight:500;"><i class="fa-solid fa-circle-plus"></i>إضافة بريد</a></button>
                    <form action="{{route('searchSortant')}}" method="post">
                        @csrf
                        <input type="search" id="searchInput" name='query' dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
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
                    <a href="{{route('archiveOutgoing',$courrier_sortant->id)}}" title='أرشفة'><i class="fa-solid fa-inbox"></i></a>
                    |<a href="{{route('courrier_sortants.edit',$courrier_sortant->id)}}" title='تعديل'><i class="fa-solid fa-pen-to-square" style="margin-right:2px;"></i></a><br>
                    <a href="{{route('courrier_sortants.show',$courrier_sortant->id)}}" title='إظهار'> <i class="fa-solid fa-eye"></i></a>
                    | <button id="openModalBtn{{$courrier_sortant->id}}" title='مسح'><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
                <!-- The Modal -->
                <div id="myModal{{$courrier_sortant->id}}" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close" style='cursor:pointer;'><i class="fa-solid fa-xmark"></i></span>
                        <p class='text text-center fw-bold'>هل تريد حذف هذا البريد ؟</p>
                        <div class="btn-container">
                            <form method="POST" action="{{ route('courrier_sortants.destroy',$courrier_sortant->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class='btn bg-danger text-white fw-bold' type="submit" >حـــــذف</button>
                            </form>
                            <!-- Button to close the modal -->
                            <a class='btn' style='border:1px solid silver;font-weight:700;' href="/courrier_sortants">رجــــــوع</a>
                        </div>
                    </div>
                </div>
                    <!-- JavaScript to control the Modal -->
                <script>
                    // Function to handle modal events
                    function setupModalEvents(modalId, openBtnId) {
                        // Get the modal
                        var modal = document.getElementById(modalId);

                        // Get the button that opens the modal
                        var btn = document.getElementById(openBtnId);

                        // Get the <span> element that closes the modal
                        var span = modal.querySelector(".close");

                        // When the user clicks on the button, open the modal
                        btn.addEventListener("click", function() {
                            modal.style.display = "block";
                        });

                        // When the user clicks on <span> (x), close the modal
                        span.addEventListener("click", function() {
                            modal.style.display = "none";
                        });

                        // When the user clicks anywhere outside of the modal, close it
                        window.addEventListener("click", function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        });
                    }

                    // Call the function to set up modal events for this iteration
                    setupModalEvents("myModal{{$courrier_sortant->id}}", "openModalBtn{{$courrier_sortant->id}}");
                </script>
        @empty
            <tr>
                <td colspan=7 class='text-center'><b>لا يوجد بريد</b></td>
            </tr>
        @endforelse
    </table>
    <div dir='ltr' class="pagination-centered">
        {{ $courrier_sortants->links() }}
    </div>
@endsection