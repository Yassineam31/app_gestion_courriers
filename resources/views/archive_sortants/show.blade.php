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
                معلومات البريد الصادر
            </div>
            <div class="print" title='طباعة' onclick="printSpecificContent()">
                <i class="fa-solid fa-print"></i>
            </div>
            <div class="row" id="contentToPrint">
            <h1 style='font-weight:700;text-align:center;'>معلومات البريد الصادر</h1>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-title"><span>المرجع: </span> {{ $archiveSortant->Reference }}</p>
                        <p class="card-text"><span>المرسل اليه :</span> {{ $archiveSortant->Destinataire }}</p>
                        <p class="card-text"><span>الموضوع :</span> {{ $archiveSortant->ObjetCorrespondance }}</p>
                        <p class="card-text"><span>تاريخ الإرسال :</span> {{ $archiveSortant->DateEnvoiAcademie }}</p>
                        <p class="card-text"><span>مراسلة تستلزم الجواب :</span> {{ $archiveSortant->CorrespondanceRequiertReponse }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text"><span>تم الرد عليها :</span> {{ $archiveSortant->ReponseRecue }}</p>
                        <p class="card-text"><span>آخر أجل للرد :</span> {{ $archiveSortant->DernierDelaiReceptionReponse }}</p>
                        <p class="card-text"><span>الحالة :</span> {{ $archiveSortant->Statut }}</p>
                        <p class="card-text" id='pieces_jointes'><span>المرفقات :</span>
                            <a href="{{ asset('storage/'.$archiveSortant->TelechargementCorrespondance) }}" download="{{basename($archiveSortant->TelechargementCorrespondance)}}" style="text-decoration:none;"> 
                                <i class="fa-solid fa-download"></i>
                                <i style="margin-left:10px; font-size:13px;color:black">{{ basename($archiveSortant->TelechargementCorrespondance) }}</i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('archive_sortants.index')}}" class="btn btn-success mt-2" style="width:100px;display:block; margin:0 auto; font-weight:700;">رجــــــــوع</a>
    </div>
    <script>
        function printSpecificContent() {
            window.print(); 
        }
    </script>
</body>
</html>
