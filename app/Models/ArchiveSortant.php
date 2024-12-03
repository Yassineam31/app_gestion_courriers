<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CourrierSortant;

class ArchiveSortant extends Model
{
    use HasFactory;

    protected $fillable=[
        'Reference',
        'Destinataire',
        'NumeroEnvoiAcademie',
        'DateEnvoiAcademie',
        'ObjetCorrespondance',
        'CorrespondanceRequiertReponse',
        'DernierDelaiReceptionReponse',
        'ReponseRecue',
        'TelechargementCorrespondance',
        'Statut',
        'user_id',
        'courrier_sortants_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function courrierSortant(){
        return $this->belongsTo(CourrierSortant::class);
    }
}
