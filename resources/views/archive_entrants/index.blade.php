@extends('layout')
@section('title','أرشيف البريد الوارد')
@section('main-content')
    <table class="table table-striped table-hover">
        <tr>
            <td colspan='7' style="background-color: #353b49;height:70px;">
                <div class="d-flex" style="position:relative;">
                    <form action="{{route('searchArchiveEntrant')}}" method="post">
                        @csrf
                        <input type="search" id="searchInput" name='query' dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
                    </form>
                    <h4 class='courrier'>أرشيف البريد الوارد</h4>
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
        @forelse($archive_entrants as $archive_entrant)
        <tr>
            <td>{{$archive_entrant->Reference}}</td>
            <td>{{$archive_entrant->NumeroInscriptionAcademie}}</td>
            <td>{{$archive_entrant->DateInscriptionAcademie}}</td>
            <td>{{$archive_entrant->Expediteur}}</td>
            <td style="max-width: 200px; word-wrap: break-word;">{{$archive_entrant->SujetCorrespondance}}</td>
            <td>{{$archive_entrant->Statut}}</td>
            <td>
                <a href="{{route('restoreIncoming',$archive_entrant->id)}}" title='إرجاع إلى قائمة البريد الوارد'><i class="fa-solid fa-rotate-left"></i></a>
               |<a href="{{route('archive_entrants.edit',$archive_entrant->id)}}" title='تعديل'><i class="fa-solid fa-pen-to-square"></i></a><br>
                <a href="{{route('archive_entrants.show',$archive_entrant->id)}}" title='إظهار'><i class="fa-solid fa-eye"></i></a>
               | <button id="openModalBtn{{$archive_entrant->id}}" title='مسح'><i class="fa-solid fa-trash"></i></button>
            </td>       
        </tr>
        <!-- The Modal -->
        <div id="myModal{{$archive_entrant->id}}" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close" style='cursor:pointer;'><i class="fa-solid fa-xmark"></i></span>
                <p class='text text-center fw-bold'>هل تريد حذف هذا البريد ؟</p>
                <div class="btn-container">
                    <form method="POST" action="{{route('archive_entrants.destroy',$archive_entrant->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class='btn bg-danger text-white fw-bold' type="submit">حـــــذف</button>
                    </form>
                    <!-- Button to close the modal -->
                    <a class='btn' style='border:1px solid silver;font-weight:700;' href="/archive_entrants">رجــــــوع</a>
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
            setupModalEvents("myModal{{$archive_entrant->id}}", "openModalBtn{{$archive_entrant->id}}");
        </script>
        @empty
        <tr>
            <td colspan=7 class='text-center'><b>لا يوجد بريد</b></td>
        </tr>
        @endforelse
    </table>
    <div dir='ltr' class="pagination-centered">
        {{ $archive_entrants->links() }}
    </div>
@endsection