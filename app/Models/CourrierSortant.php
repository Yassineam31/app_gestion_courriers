<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ArchiveSortant;

class CourrierSortant extends Model
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
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function archiveSortant(){
        return $this->hasOne(ArchiveSortant::class);
    }
}
