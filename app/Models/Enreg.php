<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enreg extends Model
{
    use HasFactory;
    use \Wildside\Userstamps\Userstamps;


    protected $primaryKey = 'enreg_id';


   protected $fillable = [
    'enreg_id',
    'user_id',
    'num_wagon',
    'num_dossier',
    'type', 'num_tc',
    'posit_plomb',
    'poids',
    'destination',
    'train',
    'position_actu',
    'client',
    'date_entree',
    'date_sortie',
    'consignataire',
    'destinataire',
    'type_marchandise',
    'num_facture',
    'montant_facture',
    'precepteur',
    'num_declaration',
    'num_bon',
    'chauffeur',
    'num_chauffeur',
    'num_camion',
    'online',
    'offline',
   ];


   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
