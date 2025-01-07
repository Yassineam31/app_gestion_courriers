<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>البريد الصادر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/show.css')
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header" style='background-color:#353b49; color:white; font-weight:700;'>
            معلومات البريد الصادر بعد التعديل
            </div>
            <div class="print" title='طباعة' onclick="printSpecificContent()">
                <i class="fa-solid fa-print"></i>
            </div>
            <div class="row" id="contentToPrint">
            <h1 style='font-weight:700;text-align:center;'>معلومات البريد الصادر بعد التعديل</h1>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-title"><span>المرجع: </span> {{ $notification->data['Reference'] ?? 'لا شيء' }}</p>
                        <p class="card-text"><span>المرسل اليه :</span> {{ $notification->data['Destinataire'] ?? 'لا شيء' }}</p>
                        <p class="card-text"><span>الموضوع :</span> {{ $notification->data['ObjetCorrespondance'] ?? 'لا شيء' }}</p>
                        <p class="card-text"><span>تاريخ الإرسال :</span> {{ $notification->data['DateEnvoiAcademie'] ?? 'لا شيء' }}</p>
                        <p class="card-text"><span>مراسلة تستلزم الجواب :</span> {{ $notification->data['CorrespondanceRequiertReponse'] ?? 'لا شيء' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text"><span>تم الرد عليها :</span> {{ $notification->data['ReponseRecue'] ?? 'لا شيء' }}</p>
                        <p class="card-text"><span>آخر أجل للرد :</span> {{ $notification->data['DernierDelaiReceptionReponse'] ?? 'لا شيء' }}</p>
                        <p class="card-text"><span>الحالة :</span> {{ $notification->data['Statut'] ?? 'لا شيء' }}</p>
                        <p class="card-text" id='pieces_jointes'><span>المرفقات :</span>
                            <a href="{{ asset('storage/'.$notification->data['TelechargementCorrespondance']) }}" download="{{basename($notification->data['TelechargementCorrespondance'])}}" style="text-decoration:none;"> 
                                <i class="fa-solid fa-download"></i>
                                <i style="margin-left:10px; font-size:13px;color:black">{{ basename($notification->data['TelechargementCorrespondance']) }}</i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="/notifications" class="btn btn-success mt-2" style="width:100px;display:block; margin:0 auto; font-weight:700;">رجــــــــوع</a>
    </div>
    <script>
        function printSpecificContent() {
            window.print(); 
        }
    </script>
</body>
</html>