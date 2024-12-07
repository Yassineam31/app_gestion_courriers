<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>إضافة بريد</title>
    @vite('resources/css/formSortant.css')
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">إستمارة البريد الصادر</h1>
        <form action="ajoutSortant" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="reference" class="form-label">المرجع :</label>
                    <input type="text" class="form-control" id="reference" name="Reference">
                </div>
                <div class="col">
                    <label for="Destinataire" class="form-label">المرسل إليه<span style='color:red;'>*</span>:</label>
                    <input type="text" class="form-control" id="Destinataire" name="Destinataire">
                    @error('Destinataire')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="Numero_envoi_academie" class="form-label">رقم إرسال الأكاديمية :</label>
                    <input type="text" class="form-control" id="Numero_envoi_academie" name="NumeroEnvoiAcademie">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="date_envoi_par_academie" class="form-label">تاريخ إرسال بالأكاديمية :</label>
                    <input type="date" class="form-control" id="date_envoi_par_academie" name="DateEnvoiAcademie">
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label class="form-label" for="Dernier_delai_reception_reponse">آخر أجل لاستقبال الجواب :</label>
                        <input type="date" class="form-control" id="Dernier_delai_reception_reponse" name="DernierDelaiReceptionReponse">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3 form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="correspondance_reponse_oui">مراسلة تستلزم الجواب <span style='color:red;'>*</span>:</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_oui" name="CorrespondanceRequiertReponse" value="نعم">
                        <label class="form-check-label mb-0 mr-2" for="correspondance_reponse_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_non" name="CorrespondanceRequiertReponse" value="لا">
                        <label class="form-check-label mb-0" for="correspondance_reponse_non">لا</label>
                    </div>
                    @error('CorrespondanceRequiertReponse')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class=" form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="repondu_oui">تم استقبال الجواب  :</label>
                        <input type="radio" class="form-check-input" id="repondu_oui" name="ReponseRecue" value="نعم">
                        <label class="form-check-label mb-0 mr-2" for="repondu_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="repondu_non" name="ReponseRecue" value="لا">
                        <label class="form-check-label mb-0" for="repondu_non">لا</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="Objet_correspondance" class="form-label">موضوع المراسلة <span style='color:red;'>*</span>:</label>
                <textarea class="form-control" id="Objet_correspondance" name="ObjetCorrespondance" rows="3" style="max-width: 700px;"></textarea>
                @error('ObjetCorrespondance')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telechargement" class="form-label">تحميل المراسلة <span style='color:red;'>*</span>:</label>
                <input type="file" class="form-control custom-file-input" id="telechargement" name="TelechargementCorrespondance">
                @error('TelechargementCorrespondance')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">الحالة :</label>
                <select class="form-select statut" id="statut" name="Statut">
                    <option value="في الإنتظار">في الإنتظار</option>
                    <option value="قيد المعالجة">قيد المعالجة</option>
                    <option value="مكتمل">مكتمل</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حــفظ<i class="fa-solid fa-floppy-disk"></i></button>
        </form>
    </div>
</body>
</html>
