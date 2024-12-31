@extends('layout')
@section('title','قسم التواصل')
@section('main-content')
<div class="box d-flex">
    <h5><i>- التواصل مع رؤساء الأقسام</i></h5>
    <button type="button" class="btn btn-success text-dark" title="ارسال رسالة" style="position:absolute;left:120px;" data-bs-toggle="modal" data-bs-target="#newMessageModal">
        <i class="fas fa-pen" style="margin-left:5px;"></i><b>رسالة جديدة</b>
    </button>   
</div>
 <table class='table table-bordered'>
    <tr>
        <th style="background:silver;">الإسم الكامل</th>
        <th style="background:silver;">القسم</th>
        <th style="background:silver;">الصفة</th>
        <th style="background:silver;">البريد الإلكتروني</th>
    </tr>
    @forelse($users as $user)
    <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->division}}</td>
        <td>{{$user->poste}}</td>
        <td>{{$user->email}}</td>
    </tr>
    @empty
    <tr>
        <td colspan=4>لا توجد معطيات</td>
    </tr>
    @endforelse
    
 </table>
    <h5><i>- التواصل مع اعضاء القسم</i></h5>
    <table class='table table-bordered'>
        <tr>
            <th style="background:silver;">الإسم الكامل</th>
            <th style="background:silver;">المصلحة</th>
            <th style="background:silver;">الصفة</th>
            <th style="background:silver;">البريد الإلكتروني</th>
        </tr>
    @forelse($members as $member)
    <tr>
        <td>{{$member->name}}</td>
        <td>{{$member->services}}</td>
        <td>{{$member->poste}}</td>
        <td>{{$member->email}}</td>
    </tr>
    @empty
    <tr>
        <td colspan=4>لا توجد معطيات</td>
    </tr>
    @endforelse
    </table>
        <!-- Modal -->
    <div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="newMessageModalLabel">رسالة جديدة</h5>
                    <button type="button" class="btn-close mx-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="{{ route('submit.form') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="recipientEmail" class="form-label">البريد الإلكتروني للمستلم</label>
                            <div id="emails-container">
                                 <input type="email" name="expediteur[]" class="form-control" placeholder="أدخل عنوان بريد إلكتروني" required>
                            </div>
                            <a href="#" id="add-email" style='text-decoration:none;'>إضافة بريد إلكتروني</a>
                        </div>
                        <div class="mb-3">
                            <label for="object" class="form-label">الموضوع</label>
                            <input type="text" name="object" class="form-control" placeholder="موضوع الرسالة">
                        </div>
                        <div class="mb-3">
                        <label for="messageContent" class="form-label">مرفقات</label>
                        <input type="file" name="fichiers[]" class="form-control" multiple>
                        </div>
                        <div class="mb-3">
                            <label for="messageContent" class="form-label">محتوى الرسالة</label>
                            <textarea class="form-control" name='messageContent' rows="4" placeholder="اكتب رسالتك هنا..."></textarea>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <input type="submit" class="btn btn-success" value='ارسـال'/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('add-email').addEventListener('click', function () {
            const container = document.getElementById('emails-container');
            const input = document.createElement('input');
            input.type = 'email';
            input.name = 'expediteur[]';
            input.className = 'form-control mt-2';
            input.placeholder = "أدخل عنوان بريد إلكتروني";
            container.appendChild(input);
        });
    </script>
@endsection