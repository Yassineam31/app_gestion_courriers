<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ArchiveEntrant;

class CourrierEntrant extends Model
{
    use HasFactory;

    protected $fillable=[
        'Reference',
        'Expediteur',
        'NumeroInscriptionAcademie',
        'DateInscriptionAcademie',
        'NumeroEnvoiEntiteExpeditrice',
        'DateEnvoiEntiteExpeditrice',
        'CorrespondanceRequiertReponse',
        'Repondu',
        'DernierDelaiReponse',
        'SujetCorrespondance',
        'TelechargementCorrespondance',
        'Statut',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function archiveEntrant(){
        return $this->hasOne(ArchiveEntrant::class);
    }
}
