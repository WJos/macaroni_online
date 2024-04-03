<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Enreg;
use App\Imports\EnregsImport;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Excel;

// Let's load an alert
use Jantinnerezo\LivewireAlert\LivewireAlert;

// // Now we need a Laravel Facades
// use Illuminate\Support\Facades\Storage;


class EnregLivewire extends Component
{

    use WithPagination, WithFileUploads, LivewireAlert;
    //LivewireAlert;

    // Bootsrap pagination
    protected $paginationTheme = 'bootstrap';

    // Public variable
    public $isOpen = 0;
    // public $select2 = true;
    public $paginatedPerPages = 20;
    public $searchTerm,$dDebut,$dFin;
    public $show_flag = 0;
    public $client_id = '', $client_fliter;
    public $modal_title = 'Nouvel Enregistrement';
    public $enreg_id, $user_id, $num_wagon, $num_dossier, $type, $num_tc, $posit_plomb, $poids, $destination, $position_actu;
    public $date_entree, $date_sortie, $consignataire, $destinataire, $type_marchandise;
    public $num_facture, $montant_facture = '0', $percepteur, $num_declaration, $num_bon;
    public $chauffeur, $num_chauffeur, $num_camion, $train;
    public $file;


    public function render()
    {
        $searchData =  '%'.$this->searchTerm.'%';
        $searchClient = '%'.$this->client_fliter.'%';
        
        $dtDebut = null;
        if($this->dDebut)
            $dtDebut = Carbon::createFromFormat('Y-m-d', $this->dDebut);
        
        $dtFin = null;
        if($this->dFin)
            $dtFin = Carbon::createFromFormat('Y-m-d', $this->dFin);

        // dd($dtDebut);

        if (Auth::user()->roles()->first()->name != 'Client') {
        
            return view('livewire.enreg-livewire', [
                
                // Lists
                'lists' => Enreg::whereHas('user', function ($searchQuery) use ($searchData){
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
                    ])->orWhere([
                        ['name', 'like', $searchData ],
                    ]);
                })->where([['statut', 'N'],])
                ->whereHas('user', function ($searchQuery) use ($searchClient){
                    $searchQuery->where([
                        ['name', 'like', $searchClient ],
                    ]);})
                ->whereHas('user', function ($searchQuery) use ($dtDebut, $dtFin){
                    if ($dtDebut && $dtFin) {
                        $searchQuery->whereBetween('created_at',[$dtDebut, $dtFin]);
                    } elseif($dtDebut) {
                        $searchQuery->whereDate('created_at','>=', $dtDebut);
                    } elseif($dtFin) {
                        $searchQuery->whereDate('created_at','<=', $dtFin);
                    }
                    ;})
                ->paginate($this->paginatedPerPages),
    
                'clients' => User::whereHas('roles', function($q){
                    // $q->where('name', '<>', 'Admin');
                    $q->where('name', 'Client');
                })->get(),
    
            ])->extends('layouts.app');
    
            }else{
    
                return view('livewire.enreg-livewire', [
                
                    // Lists
                    'lists' => Enreg::whereHas('user', function ($searchQuery) use ($searchData){
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
                    })->where([
                        ['statut', 'N'],
                    ])->whereHas('user', function ($searchQuery) use ($searchClient){
                        $searchQuery->where([
                            ['name', 'like', $searchClient ],
                        ]);})
                    ->where([
                        ['user_id', Auth::user()->id],
                    ])
                    ->whereHas('user', function ($searchQuery) use ($dtDebut, $dtFin){
                        if ($dtDebut && $dtFin) {
                            $searchQuery->whereBetween('created_at',[$dtDebut, $dtFin]);
                        } elseif($dtDebut) {
                            $searchQuery->whereDate('created_at','>=', $dtDebut);
                        } elseif($$dFin) {
                            $searchQuery->whereDate('created_at','<=', $dtFin);
                        }
                        ;})
                    ->paginate($this->paginatedPerPages),
        
                    'clients' => User::whereHas('roles', function($q){
                        // $q->where('name', '<>', 'Admin');
                        $q->where('name', 'Client');
                    })->get(),
        
                ])->extends('layouts.app');
    
            }
    }

    // Reset input fields
    private function resetInputFields(){
        $this->reset([
            'enreg_id', 'num_wagon', 'num_dossier', 'type', 'num_tc', 'posit_plomb', 'poids', 'destination', 'position_actu',
            'date_entree', 'date_sortie', 'consignataire', 'destinataire', 'type_marchandise',
            'num_facture', 'montant_facture', 'percepteur', 'num_declaration', 'num_bon',
            'chauffeur', 'num_chauffeur', 'num_camion', 'client_id', 'train', 'user_id',
        ]);
    }

    //'user_id',

    

    // Save data

    public function new(){
        $this->modal_title = 'Nouvel Enregistrement';
        $this->show_flag = 0;
        $this->resetInputFields();
    }


    public function store(){
            // Send a custom message if something is error
            //dd($this->user_id);
            $messages = [
                '*.required'                => 'Champ obligatoire',
                '*.numeric'                 => 'This column is required to be filled in with number',
                '*.string'                  => 'This column is required to be filled in with letters',
                '*.date'                  => 'This column is required to be filled in with letters',
            ];
    
            // Validate input with custom message
            // $this->validate([
            //     'crud_example_base_id'      => ['required'],
            //     'crud_example_try_photo'    => ['required'],
            //     'crud_example_try_string'   => ['required', 'string'],
            //     'crud_example_try_textarea' => ['required'],
            //     'crud_example_try_number'   => ['required', 'numeric'],
            // ], $messages);

            $this->validate([
                'num_wagon' => ['required'],
                'num_dossier' => ['required'],
                'type'   => ['required'],
                'num_tc' => ['required'],
                'posit_plomb'   => ['required'],
                'poids'   => ['required'],
                'destination'   => ['required'],
                'user_id'   => ['required'],
                // 'date_entree'   => ['required'],
                // 'date_sortie'   => ['required'],
                // 'consignataire'   => ['required'],
                // 'destinataire'   => ['required'],
                // 'type_marchandise'   => ['required'],
                // 'num_facture'   => ['required'],
                // 'montant_facture'   => ['required'],
                // 'percepteur'   => ['required'],
                // 'num_declaration'   => ['required'],
                // 'num_bon'   => ['required'],
                // 'chauffeur'   => ['required'],
                // 'num_chauffeur'   => ['required'],
                // 'num_camion'   => ['required'],
            ], $messages);
            
            // Delete this '$messages' variable if you don't want to use the custom message validator
    
            // Photo Name with Regex - Replace anything weird with underscore
            //$photo_name = time().'_'.strtolower(preg_replace('/\s+/', '_', $this->crud_example_try_photo->getClientOriginalName()));
    
            // Upload Photo if this is a 'Create'
            // if($this->enreg_id == false){
            //     $this->crud_example_try_photo->storeAs('public/asset/image', $photo_name);
            // }
    
            // Delete Existing Photo and then Upload the New One if this is an 'Update'
            // elseif($this->enreg_id == true){
            //     // Find existing photo
            //     $sql = Enreg::select('crud_example_try_id', 'crud_example_try_photo')->where('crud_example_try_id', $this->enreg_id)->firstOrFail();
                
            //     // Then delete it
            //     File::delete('storage/asset/image/' . $sql->crud_example_try_photo);
                
            //     // And upload the new one
            //     $this->crud_example_try_photo->storeAs('public/asset/image', $photo_name);
            // }
    
            // Insert or Update if Ok
            Enreg::updateOrCreate(['enreg_id' => $this->enreg_id], [
                'num_wagon' => $this->num_wagon,
                'num_dossier'   => $this->num_dossier,
                'type' => $this->type,
                'num_tc'   => $this->num_tc,
                'posit_plomb'   => $this->posit_plomb,
                'poids'   => $this->poids,
                'train'   => $this->train,
                'destination'   => $this->destination,
                'user_id'   => $this->user_id,
                'position_actu'=> $this->position_actu,
                'date_entree'   => $this->date_entree,
                'date_sortie'   => $this->date_sortie,
                'consignataire'   => $this->consignataire,
                'destinataire'   => $this->destinataire,
                'type_marchandise'   => $this->type_marchandise,
                'num_facture'   => $this->num_facture,
                'montant_facture'   => $this->montant_facture,
                'percepteur'   => $this->percepteur,
                'num_declaration'   => $this->num_declaration,
                'num_bon'   => $this->num_bon,
                'chauffeur'   => $this->chauffeur,
                'num_chauffeur'   => $this->num_chauffeur,
                'num_camion'   => $this->num_camion,
            ]);
    
            // Show an alert
            //$this->alert('success', $this->enreg_id ? 'Edited, mate!' : 'Cool, submited!');
            $this->alert('success', 'Train enregistré avec success!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
               ]);
    
            // Close input form, we're going back to the list
            //$this->closeModal();
    
            // Reset input fields for next input
            //$this->dispatch('showEnregModal');
            $this->resetInputFields();
        }

        // Parse data to input form
        public function show($id){
            $this->modal_title = 'Details Enregistrement';
            // Find data from the $id
            $this->show_flag = 1;
            $post = Enreg::findOrFail($id);
    
            // Parse data from the $post variable
            $this->enreg_id = $id;
            $this->num_wagon = $post->num_wagon;
            $this->num_dossier = $post->num_dossier;
            $this->type = $post->type;
            $this->num_tc = $post->num_tc;
            $this->posit_plomb = $post->posit_plomb;
            $this->poids = $post->poids;
            $this->train = $post->train;
            $this->destination = $post->destination;
            $this->position_actu = $post->position_actu;
            $this->user_id = $post->user_id;
            $this->client_id = $post->user_id;
            $this->date_entree = $post->date_entree;
            $this->date_sortie = $post->date_sortie;
            $this->consignataire = $post->consignataire;
            $this->destinataire = $post->destinataire;
            $this->type_marchandise = $post->type_marchandise;
            $this->num_facture = $post->num_facture;
            $this->montant_facture = $post->montant_facture;
            $this->percepteur = $post->percepteur;
            $this->num_declaration = $post->num_declaration;
            $this->num_bon = $post->num_bon;
            $this->chauffeur = $post->chauffeur;
            $this->num_chauffeur = $post->num_chauffeur;
            $this->num_camion = $post->num_camion;
    
            // Then input fields and show data
            // $this->openModal();
        }
    
        // Parse data to input form
        public function edit($id){
            $this->modal_title = 'Edition Enregistrement';
            $this->show_flag = 0;
            // Find data from the $id
            $post = Enreg::findOrFail($id);

            //$this->client_id = $post->user_id;
            //dd($post->user_id, $this->client_id);
    
            // Parse data from the $post variable
            $this->enreg_id = $id;
            $this->num_wagon = $post->num_wagon;
            $this->num_dossier = $post->num_dossier;
            $this->type = $post->type;
            $this->num_tc = $post->num_tc;
            $this->posit_plomb = $post->posit_plomb;
            $this->poids = $post->poids;
            $this->train = $post->train;
            $this->destination = $post->destination;
            $this->position_actu = $post->position_actu;
            $this->user_id = $post->user_id;
            $this->client_id = $post->user_id;
            $this->date_entree = $post->date_entree;
            $this->date_sortie = $post->date_sortie;
            $this->consignataire = $post->consignataire;
            $this->destinataire = $post->destinataire;
            $this->type_marchandise = $post->type_marchandise;
            $this->num_facture = $post->num_facture;
            $this->montant_facture = $post->montant_facture;
            $this->percepteur = $post->percepteur;
            $this->num_declaration = $post->num_declaration;
            $this->num_bon = $post->num_bon;
            $this->chauffeur = $post->chauffeur;
            $this->num_chauffeur = $post->num_chauffeur;
            $this->num_camion = $post->num_camion;

            //dd($post->user_id, $this->client_id);
            // Then input fields and show data
            // $this->openModal();
        }

        public function valide($id){

            $enreg = Enreg::find($id);
            $enreg->statut = 'V';
            $enreg->save();

            //$this->alert('warning', 'Alright, deleted!');
        }
    
        // Delete data
        public function delete($id){
            // Find existing photo
            $sql = Enreg::select('enreg_id')->where('enreg_id', $id)->firstOrFail();
    
            // Delete Data from DB
            $sql->find($id)->delete();
    
            // Then delete it
            //Storage::delete('public/asset/image/' . $sql->crud_example_try_photo);
    
            // Show an alert
            // $this->alert('warning', 'Supprimé avec success!');
        }


        public function import()
        {
            $messages = [
                '*.required' => 'Champ obligatoire',
            ];

            $this->validate([
                'file' => 'required|mimes:xlsx,xls',            
            ], $messages);
    
            // Get the uploaded file
            //$file = $request->file('file');
    
            // Process the Excel file
            //Excel::import(new EnregsImport, $this->file);

            Excel::import(new EnregsImport, $this->file);
    
            // return redirect()->back()->with('success', 'Excel file imported successfully!');
        }
}
