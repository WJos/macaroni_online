<?php

namespace App\Livewire;

use Livewire\Component;

class CreateEnregLivewire extends Component
{

    public $enreg_id, $user_id, $num_wagon, $num_dossier, $type, $num_tc, $posit_plomb, $poids, $destination, $client;
    public $date_entree, $date_sortie, $consignataire, $destinataire, $type_marchandise;
    public $num_facture, $montant_facture, $percepteur, $num_declaration, $num_bon;
    public $chauffeur, $num_chauffeur, $num_camion;

    
    public function render()
    {
        $searchData = $this->searchTerm;
        return view('livewire.create-enreg-livewire')->extends('layouts.app');
    }
}
