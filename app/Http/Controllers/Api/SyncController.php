<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Enreg;

class SyncController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public $paginatedPerPages = 10;

    public function getData()
    {
        $users = User::where('online',1)
                ->where('offline',0)
                ->get();

        $enregs = Enreg::where('online',1)
                ->where('offline',0)
                ->get();
        
        return json_encode(array('status' => 'success', 'data' => array('users' => $users, 'enregs' => $enregs)));//$clients;
    }

    public function saveGetData(Request $request)
    {
        // $users = User::where('online',1)
        //         ->where('offline',0)
        //         ->get();

        // $enregs = Enreg::where('online',1)
        //         ->where('offline',0)
        //         ->get();
        
        return json_encode(array('status' => 'success', 'data' => $request));//$clients;
    }


    public function postData()
    {
        $clients = User::where('id', '<>', Auth::user()->id)->whereHas('roles', function($q){
            // $q->where('name', '<>', 'Admin');
            $q->where('name', 'Client');
        })->get();

        // return response()->json(array('data'=> $clients), 200);

        return json_encode(array('status' => 'success', 'data' => $clients));
        
        // return $clients;

        // return view("clients.index", ['clients' => $clients]);
    }
}
