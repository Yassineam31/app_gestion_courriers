<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>البريد الوارد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/show.css')
</head>
<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header" style='background-color:#353b49; color:white; font-weight:700;'>
             معلومات البريد الوارد
            </div>
            <div class="print" title='طباعة' onclick="printSpecificContent()">
                <i class="fa-solid fa-print"></i>
            </div>
            <div class="row" id="contentToPrint">
                <h1 style='font-weight:700;text-align:center;'>معلومات البريد الوارد</h1>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-title"><span>المرجع: </span> {{ $courrierEntrant->Reference }}</p>
                        <p class="card-text"><span>المرسل :</span> {{ $courrierEntrant->Expediteur }}</p>
                        <p class="card-text"><span>رقم التسجيل بالأكاديمية :</span> {{ $courrierEntrant->NumeroInscriptionAcademie }}</p>
                        <p class="card-text"><span>تاريخ التسجيل بالأكاديمية :</span> {{ $courrierEntrant->DateInscriptionAcademie }}</p>
                        <p class="card-text"><span>تاريخ إرسال الجهة المرسلة :</span> {{ $courrierEntrant->DateEnvoiEntiteExpeditrice }}</p>
                        <p class="card-text"><span>رقم إرسال الجهة المرسلة :</span> {{ $courrierEntrant->NumeroEnvoiEntiteExpeditrice }}</p>
                        <p class="card-text"><span>موضوع المراسلة :</span> {{ $courrierEntrant->SujetCorrespondance }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text"><span>مراسلة تستلزم الرد :</span> {{ $courrierEntrant->CorrespondanceRequiertReponse }}</p>
                        <p class="card-text"><span>تم الرد عليها :</span> {{ $courrierEntrant->Repondu }}</p>
                        <p class="card-text"><span>آخر أجل للرد :</span> {{ $courrierEntrant->DernierDelaiReponse }}</p>
                        <p class="card-text"><span>الحالة :</span> {{ $courrierEntrant->Statut }}</p>
                        <p class="card-text" id='pieces_jointes'><span>المرفقات :</span>
                            <a href="{{ asset('storage/'.$courrierEntrant->TelechargementCorrespondance) }}" download="{{basename($courrierEntrant->TelechargementCorrespondance)}}" style="text-decoration:none;"> 
                                <i class="fa-solid fa-download"></i>
                                <i style="margin-left:10px; font-size:13px;color:black">{{ basename($courrierEntrant->TelechargementCorrespondance) }}</i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('courrier_entrants.index')}}" class="btn btn-success mt-2" style="width:100px;display:block; margin:0 auto;font-weight:700;">رجـــــــوع</a>
    </div>
    <script>
        function printSpecificContent() {
            window.print(); 
        }
    </script>
</body>
</html>
