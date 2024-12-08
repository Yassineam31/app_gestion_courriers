<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>تعديل بيانات البريد الصادر</title>
    @vite('resources/css/formSortant.css')
</head>
<body >
    <div class="container">
        <h1 class="text-center mb-4">تعديل بيانات البريد الصادر</h1>
        <form action="{{route('courrier_sortants.update',$courrierSortant->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row mb-3">
                <div class="col">
                    <label for="reference" class="form-label">المرجع :</label>
                    <input type="text" class="form-control" id="reference" name="Reference" value="{{$courrierSortant->Reference}}">
                </div>
                <div class="col">
                    <label for="destinataire" class="form-label">المرسل اليه<span style='color:red;'>*</span>:</label>
                    <input type="text" class="form-control" id="destinataire" name="Destinataire" value="{{$courrierSortant->Destinataire}}">
                    @error('Destinataire')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="Numero_envoi_academie" class="form-label">رقم إرسال الأكاديمية :</label>
                    <input type="text" class="form-control" id="Numero_envoi_academie" name="NumeroEnvoiAcademie" value="{{$courrierSortant->NumeroEnvoiAcademie}}">
                </div>
            <div class="row mb-3">
                <div class="col-md-4">
                        <label for="date_envoi_par_academie" class="form-label">تاريخ إرسال بالأكاديمية :</label>
                        <input type="date" class="form-control" id="date_envoi_par_academie" name="DateEnvoiAcademie" value="{{$courrierSortant->DateEnvoiAcademie}}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="Dernier_delai_reception_reponse">آخر أجل لاستقبال الجواب :</label>
                        <input type="date" class="form-control" id="Dernier_delai_reception_reponse" name="DernierDelaiReceptionReponse" value="{{$courrierSortant->DernierDelaiReceptionReponse}}">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="mb-3 form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="correspondance_reponse_oui">مراسلة تستلزم الجواب <span style='color:red;'>*</span>:</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_oui" name="CorrespondanceRequiertReponse" value="نعم" {{$courrierSortant->CorrespondanceRequiertReponse == 'نعم' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0 mr-2" for="correspondance_reponse_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_non" name="CorrespondanceRequiertReponse" value="لا" {{$courrierSortant->CorrespondanceRequiertReponse == 'لا' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0" for="correspondance_reponse_non">لا</label>
                    </div>
                    @error('CorrespondanceRequiertReponse')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="repondu_oui">تم استقبال الجواب :</label>
                        <input type="radio" class="form-check-input" id="repondu_oui" name="ReponseRecue" value="نعم" {{$courrierSortant->ReponseRecue == 'نعم' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0 mr-2" for="repondu_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="repondu_non" name="ReponseRecue" value="لا"{{$courrierSortant->ReponseRecue == 'لا' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0" for="repondu_non">لا</label>
                    </div>
                </div>
            </div>
                <div class="mb-3">
                    <label for="Objet_correspondance" class="form-label">موضوع المراسلة <span style='color:red;'>*</span>:</label>
                    <textarea class="form-control w-50" id="Objet_correspondance" name="ObjetCorrespondance" rows="3">{{$courrierSortant->ObjetCorrespondance}}</textarea>
                    @error('ObjetCorrespondance')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telechargement" class="form-label">تحميل المراسلة <span style='color:red;'>*</span>:</label>
                    <input type="file" class="form-control custom-file-input" id="telechargement" name="TelechargementCorrespondance">
                    @if($courrierSortant->TelechargementCorrespondance)
                        <!-- Afficher le nom du fichier actuellement téléchargé -->
                        <p>{{ basename($courrierSortant->TelechargementCorrespondance) }}</p>
                        <!-- Champ caché pour stocker le chemin du fichier déjà téléchargé -->
                        <input type="hidden" name="TelechargementCorrespondance" value="{{$courrierSortant->TelechargementCorrespondance}}">
                    @endif
                    @error('TelechargementCorrespondance')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>

            <div class="mb-3">
                <label for="statut" class="form-label">الحالة :</label>
                <select class="form-select statut" id="statut" name="Statut">
                    <option value="في الإنتظار" {{ $courrierSortant->Statut == "في الإنتظار" ? 'selected' : '' }}>في الإنتظار</option>
                    <option value="قيد المعالجة" {{ $courrierSortant->Statut == "قيد المعالجة" ? 'selected' : '' }}>قيد المعالجة</option>
                    <option value="مكتمل" {{ $courrierSortant->Statut == "مكتمل" ? 'selected' : '' }}>مكتمل</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">حــفظ التغيير<i class="fa-solid fa-floppy-disk"></i></button>
        </form>
    </div>
</body>
</html>
