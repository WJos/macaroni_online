<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enreg;

class HomeController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public $paginatedPerPages = 10;

    public function index()
    {
        if (Auth::user()->roles()->first()->name != 'Client') {

        $news = Enreg::where('statut', 'N')->count();
        $valides = Enreg::where('statut', 'V')->count();
        $archives = Enreg::where('statut', 'A')->count();
        $clients = User::whereHas('roles', function($q){
            $q->where('name', 'Client');})->count();
        
        return view("dashboard", ['news' => $news,'valides' => $valides,'archives' => $archives,'clients' => $clients]);
        }else{

        $news = Enreg::where('user_id', Auth::user()->id)->where('statut', 'N')->count();
        $valides = Enreg::where('user_id', Auth::user()->id)->where('statut', 'V')->count();
        $archives = Enreg::where('user_id', Auth::user()->id)->where('statut', 'A')->count();
        
        return view("dashboard", ['news' => $news,'valides' => $valides,'archives' => $archives]);


        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('name', '<>', 'Super-Admin')
                        ->where('name', '<>', 'Client')->get();
        return view("users.create", ['roles'=>$roles]);
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
            'roles' => 'required',

        ]);

        //dd($validatedData);

        $validatedData['password'] = Hash::make('87654321');

        $user = User::create($validatedData);
        $user->assignRole($validatedData['roles']);
        //$roles = Role::where('name', 'Admin')->get()->first();
        //dd($roles);
        //$user->roles()->sync($roles);

        return redirect()->route('users.index')->with("success", "Utilisateur enregistré avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$user = User::find($id);
        $user = User::whereHas('roles', function($q){
            $q->where('name', '<>', 'Client');
            $q->where('name', '<>', 'Super-Admin');
        })->where('id', $id)->first();

        $roles = Role::where('name', '<>', 'Super-Admin')
                        ->where('name', '<>', 'Client')->get();

        return view("users.show", ['user'=>$user, 'roles'=>$roles]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::whereHas('roles', function($q){
            $q->where('name', '<>', 'Client');
            $q->where('name', '<>', 'Super-Admin');
        })->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('users.index');
        }
        
        $roles = Role::where('name', '<>', 'Super-Admin')
                        ->where('name', '<>', 'Client')->get();

        return view('users.edit', ['user'=>$user, 'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.$user->id,
            'contact' => 'required|string|max:255',
            'roles' => 'required',

        ]);

        $user->update($validatedData);
        $user->syncRoles($validatedData['roles']);
        // $user->roles()->sync($request->input('roles'));

        return redirect()->route('users.index');
    }

    /**
     * Active|Desactivate the specified resource from storage.
     */
    public function statut($id)
    {
        $statut = "";
        $user = User::whereHas('roles', function($q){
            $q->where('name', '<>', 'Client');
            $q->where('name', '<>', 'Super-Admin');
        })->where('id', $id)->first();

        if (!$user) {
            return redirect()->route('users.index');
        }

        $statut = $user->statut == 1 ? "desactivée" : "activée";
        $user->statut = !$user->statut;
        $user->update();


        return redirect()->route('users.index')->with("success", "Client " . $statut . " avec success");
    }
}
