@extends('layout')
@section('title','تدبيرالأعضاء')
@section('main-content')
    <table class="table table-striped table-hover">
        <tr>
            <td colspan='7' style="background-color: #353b49;">
                <div class="d-flex" style="position:relative;">
                    <button class="btn ajouter"><a href="/register" style="text-decoration:none;color:#000;font-weight:500;"><i class="fa-solid fa-circle-plus"></i>إضافة عضو</a></button>
                    <input type="search" id="searchInput" name='query' dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
                    <h4 class='courrier'>لائحة الأعضاء</h4>
                </div>
            </td>
         </tr>
        <tr dir='rtl'>
            <th>الإسم الكامل</th>
            <th>البريد الإلكتروني</th>
            <th>القسم</th>
            <th>المصلحة</th>
            <th>الصفة</th>
            <th>اجراءات</th>
        </tr>
        <tbody id="tableBody">
            @forelse($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td style="max-width: 150px; word-wrap: break-word;">{{$user->division}}</td>
                <td style="max-width: 150px; word-wrap: break-word;">{{$user->services}}</td>
                <td>{{$user->poste}}</td>
                <td class='p-3'>
                <a href="{{route('users.edit',$user->id)}}" title='تعديل'><i class="fa-solid fa-pen-to-square"></i></a>
                | <button id="openModalBtn{{$user->id}}" title='حذف'><i class="fa-solid fa-trash"></i></button>
                </td>       
            </tr>
            <!-- The Modal -->
            <div id="myModal{{$user->id}}" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close" style='cursor:pointer;'><i class="fa-solid fa-xmark"></i></span>
                    <p class='text text-center fw-bold'>هل تريد حذف هذا العضو ؟</p>
                    <div class="btn-container">
                        <form method="POST" action="{{route('users.destroy',$user->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class='btn bg-danger text-white fw-bold' type="submit">حـــــذف</button>
                        </form>
                        <!-- Button to close the modal -->
                        <a class='btn' style='border:1px solid silver;font-weight:700;' href="/users">رجــــــوع</a>
                    </div>
                </div>
            </div>
            <!-- JavaScript to control the Modal -->
            <script>
                function setupModalEvents(modalId, openBtnId) {
                    var modal = document.getElementById(modalId);
                    var btn = document.getElementById(openBtnId);
                    var span = modal.querySelector(".close");
                    btn.addEventListener("click", function() {
                        modal.style.display = "block";
                    });
                    span.addEventListener("click", function() {
                        modal.style.display = "none";
                    });
                    window.addEventListener("click", function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    });
                }
                setupModalEvents("myModal{{$user->id}}","openModalBtn{{$user->id}}");
            </script>
            @empty
            <tr>
                <td colspan=7 class='text-center'><b>لا توجد معطيات</b></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div dir='ltr' class="pagination-centered">
        {{ $users->links() }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        // Gestion de la recherche
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();
            searchUsers(query);
        });
        
        // Gestion des clics dans la table (pour suppression)
        tableBody.addEventListener('click', function (event) {
            const deleteBtn = event.target.closest('.delete-btn');
            if (deleteBtn) {
                const id = deleteBtn.getAttribute('data-id');
                if (confirm('هل تريد حذف هذا العضو ؟')) {
                    deleteCourrier(id, deleteBtn);
                }
            }
        });

        // Fonction pour effectuer une recherche
        function searchUsers(query) {
            fetch("{{ route('searchUser') }}", {
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
                row.innerHTML = "<td colspan='7' class='text-center'><b>لا توجد معطيات</b></td>";
                tableBody.appendChild(row);
            } else {
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td style="max-width: 150px; word-wrap: break-word;">${item.division}</td>
                        <td style="max-width: 150px; word-wrap: break-word;">${item.services}</td>
                        <td>${item.poste}</td>
                        <td>
                            <a href="/users/${item.id}/edit" title='تعديل' style="text-decoration:none;">
                                <i class="fa-solid fa-pen-to-square"></i>
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
        fetch(`/users/${id}`, {
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