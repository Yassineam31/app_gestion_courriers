<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>إضافة بريد</title>
    @vite('resources/css/formEntrant.css')
</head>
<body >
    <div class="container">
    <h1 class="text-center mb-4">تعديل بيانات البريد الوارد</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="reference" class="form-label">المرجع :</label>
                    <input type="text" class="form-control" id="reference" name="Reference" value="{{$courrierEntrant->Reference}}">
                </div>
                <div class="col">
                    <label for="expediteur" class="form-label">المرسل<span style='color:red;'>*</span>:</label>
                    <input type="text" class="form-control" id="expediteur" name="Expediteur" value="{{$courrierEntrant->Expediteur}}">
                    @error('Expediteur')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="numero_inscription" class="form-label">رقم التسجيل بالأكاديمية :</label>
                    <input type="text" class="form-control" id="numero_inscription" name="NumeroInscriptionAcademie" value="{{$courrierEntrant->NumeroInscriptionAcademie}}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="date_inscription" class="form-label">تاريخ التسجيل بالأكاديمية :</label>
                    <input type="date" class="form-control" id="date_inscription" name="DateInscriptionAcademie" value="{{$courrierEntrant->DateInscriptionAcademie}}">
                </div>
                <div class="col">
                    <label for="date_envoi_entite" class="form-label">تاريخ إرسال الجهة المرسلة :</label>
                    <input type="date" class="form-control" id="date_envoi_entite" name="DateEnvoiEntiteExpeditrice" value="{{$courrierEntrant->DateEnvoiEntiteExpeditrice}}">
                </div>
                <div class="col">
                    <label for="numero_envoi" class="form-label">رقم إرسال الجهة المرسلة :</label>
                    <input type="text" class="form-control" id="numero_envoi" name="NumeroEnvoiEntiteExpeditrice" value="{{$courrierEntrant->NumeroEnvoiEntiteExpeditrice}}">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4">
                    <div class="mb-3 form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="correspondance_reponse_oui">مراسلة تستلزم الرد <span style='color:red;'>*</span>:</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_oui" name="CorrespondanceRequiertReponse" value="نعم" {{$courrierEntrant->CorrespondanceRequiertReponse == "نعم" ? 'checked' : ''}}>
                        <label class="form-check-label mb-0 mr-2" for="correspondance_reponse_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_non" name="CorrespondanceRequiertReponse" value="لا" {{$courrierEntrant->CorrespondanceRequiertReponse == "لا" ? 'checked' : ''}}>
                        <label class="form-check-label mb-0" for="correspondance_reponse_non">لا</label>
                    </div>
                    @error('CorrespondanceRequiertReponse')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class=" form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="repondu_oui">تم الرد عليها :</label>
                        <input type="radio" class="form-check-input" id="repondu_oui" name="Repondu" value="نعم" {{$courrierEntrant->Repondu == 'نعم' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0 mr-2" for="repondu_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="repondu_non" name="Repondu" value="لا" {{$courrierEntrant->Repondu == 'لا' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0" for="repondu_non">لا</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label class="form-label" for="dernier_delai">آخر أجل للرد :</label>
                        <input type="date" class="form-control" id="dernier_delai" name="DernierDelaiReponse" value="{{$courrierEntrant->DernierDelaiReponse}}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="sujet" class="form-label">موضوع المراسلة <span style='color:red;'>*</span>:</label>
                <textarea class="form-control" id="SujetCorrespondance" name="sujet" rows="3" style="max-width: 700px;">{{$courrierEntrant->SujetCorrespondance}}</textarea>
                @error('SujetCorrespondance')
                <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="telechargement" class="form-label">تحميل المراسلة <span style='color:red;'>*</span>:</label>
                <input type="file" class="form-control custom-file-input" id="telechargement" name="TelechargementCorrespondance">
                @if($courrierEntrant->TelechargementCorrespondance)
                    <!-- Afficher le nom du fichier actuellement téléchargé -->
                    <p>{{ basename($courrierEntrant->TelechargementCorrespondance) }}</p>
                    <!-- Champ caché pour stocker le chemin du fichier déjà téléchargé -->
                    <input type="hidden" name="ancien_telechargement" value="{{$courrierEntrant->TelechargementCorrespondance}}">
                @endif
                @error('TelechargementCorrespondance')
                    <span class='text-danger'>{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="statut" class="form-label">الحالة :</label>
                <select class="form-select statut" id="statut" name="Statut">
                    <option value="في الإنتظار" {{ $courrierEntrant->Statut == "في الإنتظار" ? 'selected' : '' }}>في الإنتظار</option>
                    <option value="قيد المعالجة" {{ $courrierEntrant->Statut == "قيد المعالجة" ? 'selected' : '' }}>قيد المعالجة</option>
                    <option value="مكتمل" {{ $courrierEntrant->Statut == "مكتمل" ? 'selected' : '' }}>مكتمل</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">حــفظ التغيير<i class="fa-solid fa-floppy-disk"></i></button>
        </form>
    </div>
</body>
</html>