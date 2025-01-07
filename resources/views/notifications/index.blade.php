@extends('layout')
@section('title','التنبيهات')
@section('main-content')
<style>
    .notification-unread {
        background-color: #e6f7ff; /* Bleu clair pour les notifications non lues */
        font-weight: bold; /* Texte en gras pour les distinguer */
    }

    .notification-read {
        background-color: #f0f0f0; /* Gris clair pour les notifications lues */
        font-weight: normal;
    }

</style>
<table class="table table-hover" style="width:800px;">
    <thead>
        <tr>
            <th style='width:250px;'>نوع البريد</th>
            <th>تاريخ</th>
            <th>إجراءات</th>
        </tr>
    </thead>
    <tbody>
    @forelse($notifications as $notification)
        <tr class="{{ is_null($notification->read_at) ? 'notification-unread' : 'notification-read' }}">
        @if($notification->type == 'App\Notifications\NewCourrierAdded')
            <td>بريد وارد</td>
        @elseif($notification->type == 'App\Notifications\NewCourrierSortant')
            <td>بريد صادر</td>
        @elseif($notification->type == 'App\Notifications\UpdateCourrierAdded')
            <td>تعديل على البريد الوارد</td>
        @elseif($notification->type == 'App\Notifications\UpdateCourrierSortant')
            <td>تعديل على البريد الصادر</td>
        @endif
            <td>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i') }}</td>
            <td >
               <div class="box d-flex justify-content-center align-items-center">
                    <a href="#" target="_blank"
                        onclick="markAsRead('{{ $notification->id }}')" style="text-decoration:none;" title='إظهار'><i class="fa-solid fa-eye mx-1"></i>
                    </a>
                    @if($notification->type == 'App\Notifications\NewCourrierAdded')
                    <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.NewCourrierAdded', $notification->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form> |
                    @elseif($notification->type == 'App\Notifications\NewCourrierSortant')
                    <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.NewCourrierSortant', $notification->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form> |
                    @elseif($notification->type == 'App\Notifications\UpdateCourrierAdded')
                    <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.UpdateCourrierAdded', $notification->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form> |
                    @elseif($notification->type == 'App\Notifications\UpdateCourrierSortant')
                    <form id="mark-as-read-{{ $notification->id }}" action="{{ route('notifications.UpdateCourrierSortant', $notification->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form> |
                    @endif
                    <form action="{{route('notification.destroy',$notification->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" title='حذف'><i class="fa-solid fa-trash mx-1"></i></button>
                    </form>
               </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">لا توجد تنبيهات</td>
        </tr>
    @endforelse
</tbody>

</table>
<div dir='ltr' class="pagination-centered">
    {{ $notifications->links() }}
</div>
<script>
    function markAsRead(notificationId) {
        event.preventDefault();

        // Soumettre le formulaire pour marquer comme lu
        const form = document.getElementById('mark-as-read-' + notificationId);
        form.submit();

        // Modifier immédiatement le style de la ligne dans l'interface
        const row = form.closest('tr');
        row.classList.remove('notification-unread');
        row.classList.add('notification-read');
    }
</script>

@endsection