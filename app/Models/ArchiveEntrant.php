<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CourrierEntrant;

class ArchiveEntrant extends Model
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
        'user_id',
        'courrier_entrants_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function courrierEntrant(){
        return $this->belongsTo(CourrierEntrant::class);
    }
}
