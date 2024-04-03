<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public $paginatedPerPages = 10;

    public function index()
    {
        $clients = User::where('id', '<>', Auth::user()->id)->whereHas('roles', function($q){
            // $q->where('name', '<>', 'Admin');
            $q->where('name', 'Client');
        })->get();
        
        return view("clients.index", ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '<>', 'Super-Admin')
                        ->where('name', '<>', 'Client')->get();
        return view("clients.create", ['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'contact' => 'required|string|max:255',
            //'password' => ['required', 'confirmed', Rules\Password::defaults()],
            //'roles' => 'required',

        ]);

        //dd($validatedData);

        $validatedData['password'] = Hash::make('87654321');

        $client = User::create($validatedData);
        //$client->assignRole($validatedData['roles']);
        $roles = Role::where('name', 'Client')->get()->first();
        //dd($roles);
        $client->roles()->sync($roles);

        return redirect()->route('clients.index')->with("success", "Utilisateur enregistré avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$client = User::find($id);
        $client = User::whereHas('roles', function($q){
            $q->where('name', '<>', 'Client');
            $q->where('name', '<>', 'Super-Admin');
        })->where('id', $id)->first();

        $roles = Role::where('name', '<>', 'Super-Admin')
                        ->where('name', '<>', 'Client')->get();

        return view("clients.show", ['client'=>$client, 'roles'=>$roles]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = User::whereHas('roles', function($q){
            $q->where('name', 'Client');
        })->where('id', $id)->first();

        if (!$client) {
            return redirect()->route('clients.index');
        }
        
        // $roles = Role::where('name', '<>', 'Super-Admin')
        //                 ->where('name', '<>', 'Client')->get();

        return view('clients.edit', ['client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $client)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.$client->id,
            'contact' => 'required|string|max:255',

        ]);

        $client->update($validatedData);
        //$client->syncRoles($validatedData['roles']);
        // $client->roles()->sync($request->input('roles'));

        return redirect()->route('clients.index');
    }

    public function supp($id)
    {
        // delete
        $user = User::whereHas('roles', function($q){
            $q->where('name', 'Client');
        })->where('id', $id)->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted the shark!');
        return redirect()->route('clients.index');
    }

    /**
     * Active|Desactivate the specified resource from storage.
     */
    public function statut($id)
    {
        $statut = "";
        $client = User::whereHas('roles', function($q){
            $q->where('name', '<>', 'Client');
            $q->where('name', '<>', 'Super-Admin');
        })->where('id', $id)->first();

        if (!$client) {
            return redirect()->route('clients.index');
        }

        $statut = $client->statut == 1 ? "desactivée" : "activée";
        $client->statut = !$client->statut;
        $client->update();


        return redirect()->route('clients.index')->with("success", "Client " . $statut . " avec success");
    }
}
