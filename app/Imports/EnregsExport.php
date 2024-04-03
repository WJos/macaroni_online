<?php


namespace App\Imports;

use App\Models\Enreg;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EnregsExport implements FromQuery, WithChunkReading
{

    use Exportable;

    public function __construct(string $searchTerm, string $client_fliter, string $dDebut, string $dFin)
    
    {
        $this->searchData =  '%'.$searchTerm.'%';
        $this->searchClient = '%'.$client_fliter.'%';
        
        $this->dDebut = null;
        if($this->dDebut)
        $this->dDebut = Carbon::createFromFormat('Y-m-d', $dDebut);
        
        $this->dtFin = null;
        if($dFin)
            $this->dtFin = Carbon::createFromFormat('Y-m-d', $dFin);

        $this->searchData = $searchTerm;
        $this->searchClient = $client_fliter;
        $this->dDebut = $dDebut;
        $this->dFin = $dFin;
        
    }

    public function query()
    {
        // select('enregs.num_wagon, enregs.num_dossier, enregs.type, enregs.num_tc, enregs.posit_plomb, enregs.poids, enregs.destination, enregs.train, users.name')->
        $searchData = $this->searchData;
        $searchClient = $this->searchClient;
        $dtDebut = $this->dDebut;
        $dtFin = $this->dFin;
        $enreg = Enreg::whereHas('user', function ($searchQuery) use ($searchData){
            $searchQuery->where([
                ['num_wagon', 'like', $searchData ]
            ])->orWhere([
                ['num_dossier', 'like', $searchData ],
            ])->orWhere([
                ['type', 'like', $searchData ],
            ])->orWhere([
                ['num_tc', 'like', $searchData ],
            ])->orWhere([
                ['posit_plomb', 'like', $searchData ],
            ])->orWhere([
                ['poids', 'like', $searchData ],
            ])->orWhere([
                ['name', 'like', $searchData],
            ])->orWhere([
                ['destination', 'like', $searchData ],
            ])->orWhere([
                ['train', 'like', $searchData ],
            ])->orWhere([
                ['position_actu', 'like', $searchData ],
            ])->orWhere([
                ['date_entree', 'like', $searchData ],
            ])->orWhere([
                ['date_sortie', 'like', $searchData ],
            ])->orWhere([
                ['consignataire', 'like', $searchData ],
            ])->orWhere([
                ['destinataire', 'like', $searchData ],
            ])->orWhere([
                ['type_marchandise', 'like', $searchData ],
            ])->orWhere([
                ['num_facture', 'like', $searchData ],
            ])->orWhere([
                ['montant_facture', 'like', $searchData ],
            ])->orWhere([
                ['percepteur', 'like', $searchData ],
            ])->orWhere([
                ['num_declaration', 'like', $searchData ],
            ])->orWhere([
                ['num_bon', 'like', $searchData ],
            ])->orWhere([
                ['chauffeur', 'like', $searchData ],
            ])->orWhere([
                ['num_chauffeur', 'like', $searchData ],
            ])->orWhere([
                ['num_camion', 'like', $searchData ],
            ]);
        });
        
        $enreg->where([
            ['statut', 'N'],
        ])->whereHas('user', function ($searchQuery) use ($searchClient){
            $searchQuery->where([
                ['name', 'like', $searchClient ],
            ]);});
        if (Auth::user()->roles()->first()->name != 'Client') {
            $enreg->where([
                ['user_id', Auth::user()->id],
            ]);
        }
        $enreg->where(function ($searchQuery) use ($dtDebut, $dtFin){
            if ($dtDebut && $dtFin) {
                $searchQuery->whereBetween('created_at',[$dtDebut, $dtFin]);
            } elseif($dtDebut) {
                $searchQuery->whereDate('created_at','>=', $dtDebut);
            } elseif($dtFin) {
                $searchQuery->whereDate('created_at','<=', $dtFin);
            }
            ;})->get();
        
    }


    public function chunkSize(): int
    {
        return 1000;
    }


}