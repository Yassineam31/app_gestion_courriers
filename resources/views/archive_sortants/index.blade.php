@extends('layout')
@section('title','أرشيف البريد الصادر')
@section('main-content')
    <table class="table table-striped table-hover">
        <tr>
            <td colspan='7' style="background-color: #353b49;">
                <div class="d-flex" style="position:relative;height:54px;">
                    <input type="search" id="searchInput" name='query' dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
                    <h4 class='courrier'>أرشيف البريد الصادر</h4>
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
        <tbody id="tableBody">
            @forelse($archive_sortants as $archive_sortant)
                <tr>
                    <td>{{$archive_sortant->Reference}}</td>
                    <td>{{$archive_sortant->Destinataire}}</td>
                    <td>{{$archive_sortant->NumeroEnvoiAcademie}}</td>
                    <td>{{$archive_sortant->DateEnvoiAcademie}}</td>
                    <td style="max-width: 200px; word-wrap: break-word;">{{$archive_sortant->ObjetCorrespondance}}</td>
                    <td>{{$archive_sortant->Statut}}</td>
                    <td>
                        <a href="{{route('restoreOutgoing',$archive_sortant->id)}}" title='إرجاع إلى قائمة البريد الصادر'><i class="fa-solid fa-rotate-left"></i></a>
                        |{{--<a href="{{route('archive_sortants.edit',$archive_sortant->id)}}" title='تعديل'><i class="fa-solid fa-pen-to-square" style="margin-right:2px;"></i></a><br>--}}
                        <a href="{{route('archive_sortants.show',$archive_sortant->id)}}" title='إظهار'> <i class="fa-solid fa-eye"></i></a>
                        | <button id="openModalBtn{{$archive_sortant->id}}" title='حذف'><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                    <!-- The Modal -->
                    <div id="myModal{{$archive_sortant->id}}" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close" style='cursor:pointer;'><i class="fa-solid fa-xmark"></i></span>
                            <p class='text text-center fw-bold'>هل تريد حذف هذا البريد ؟</p>
                            <div class="btn-container">
                                <form method="POST" action="{{ route('archive_sortants.destroy',$archive_sortant->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class='btn bg-danger text-white fw-bold' type="submit" >حـــــذف</button>
                                </form>
                                <!-- Button to close the modal -->
                                <a class='btn' style='border:1px solid silver;font-weight:700;' href="/archive_sortants">رجــــــوع</a>
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
                        setupModalEvents("myModal{{$archive_sortant->id}}", "openModalBtn{{$archive_sortant->id}}");
                    </script>
            @empty
                <tr>
                    <td colspan=7 class='text-center'><b>لا يوجد بريد</b></td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div dir='ltr' class="pagination-centered">
        {{ $archive_sortants->links() }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        // Gestion de la recherche
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();
            searchCourriers(query);
        });
        
        // Gestion des clics dans la table (pour suppression)
        tableBody.addEventListener('click', function (event) {
            const deleteBtn = event.target.closest('.delete-btn');
            if (deleteBtn) {
                const id = deleteBtn.getAttribute('data-id');
                if (confirm('هل تريد حذف هذا البريد؟')) {
                    deleteCourrier(id, deleteBtn);
                }
            }
        });

        // Fonction pour effectuer une recherche
        function searchCourriers(query) {
            fetch("{{ route('searchArchiveSortant') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ query }),
            })
                .then(response => response.json())
                .then(data => updateTable(data))
                .catch(error => console.error('Erreur lors de la recherche :', error));
        }

        // Fonction pour mettre à jour le tableau des résultats
        function updateTable(data) {
            tableBody.innerHTML = '';
            if (data.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = "<td colspan='7' class='text-center'><b>لا يوجد بريد</b></td>";
                tableBody.appendChild(row);
            } else {
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.Reference}</td>
                        <td>${item.Destinataire}</td>
                        <td>${item.NumeroEnvoiAcademie}</td>
                        <td>${item.DateEnvoiAcademie}</td>
                        <td style="max-width: 200px; word-wrap: break-word;">${item.ObjetCorrespondance}</td>
                        <td>${item.Statut}</td>
                        <td>
                            <a href="/restaureArchiveSortant/${item.id}" title='إرجاع إلى قائمة البريد الصادر' style="text-decoration:none;">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a> |
                            {{-- <a href="/archive_sortants/${item.id}/edit" title='تعديل' style="text-decoration:none;">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a><br> --}}
                            <a href="/archive_sortants/${item.id}" title='إظهار' style="text-decoration:none;">
                                <i class="fa-solid fa-eye"></i>
                            </a> |
                            <a href="#" class="delete-btn" data-id="${item.id}" title="حذف" style="text-decoration:none;">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }
        }

        // Fonction pour supprimer un courrier
        function deleteCourrier(id, deleteBtn) {
        fetch(`/archive_sortants/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
        .then(response => {
            if (response.ok) {
                return response.json(); // Récupérer la réponse JSON si la suppression est réussie
            } else {
                // Gestion des erreurs si le statut HTTP n'est pas 200 ou 204
                return response.json().then(errorData => {
                    throw new Error(errorData.message || 'خطأ أثناء الحذف.');
                });
            }
        })
        .then(data => {
            alert(data.message); // Afficher l'alerte de succès
            deleteBtn.closest('tr').remove(); // Supprimer la ligne du tableau
        })
        .catch(error => {
            console.error('Erreur lors de la suppression :', error);
            alert('لم يتم الحذف. حاول مرة أخرى.'); // Afficher l'alerte d'erreur si quelque chose échoue
        });
    }
    });
    </script>
@endsection