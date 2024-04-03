<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Enreg;
use DB;

class SyncController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public $paginatedPerPages = 10;

    public function getData()
    {
        $users =  DB::table('users')
                    ->select('users.*','roles.name As role')
                    ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                    ->join('roles','model_has_roles.role_id','=','roles.id')
                    ->where('online',1)
                    ->where('offline',0)
                    ->get();

                    $enregs = DB::table('enregs')->where('online',1)
                    ->where('offline',0)
                    ->get();
        
        return array('status' => 'success', 'data' => array('users' => $users, 'enregs' => $enregs));//$users;//json_encode(array('status' => 'success', 'data' => array('users' => $users, 'enregs' => $enregs)));//$clients;
    }


    public function postData(Request $request)
    {


        $jsonData = $request->all();

        // return $jsonData;

        try {
            if ($jsonData && $jsonData['status'] === 'success') {
                $users = $jsonData['data']['users'];
                $enregs = $jsonData['data']['enregs'];

                // return array('status' => 'success');

                // return array('status' => $users);
    
                if (count($users) > 0) {
                    foreach ($users as $user) {
                        // return array('status' => $user);
                        $id = $user['id'];
                        $role = $user['role'];
                        unset($user['id']);
                        unset($user['role']);
                        $user['online'] = 1;
                        $user['offline'] = 1;
                        DB::table('users')->updateOrInsert(['id' => $id], $user);
                        $user = User::where('email', $user['email'])->where('name', $user['name'])->first();
                        $user->assignRole($role);
                    }
                } 
    
                if (count($enregs) > 0) {
                    foreach ($enregs as $enreg) {
                        $enreg_id = $enreg['enreg_id'];
                        unset($enreg['enreg_id']);
                        $enreg['online'] = 1;
                        $enreg['offline'] = 1;
                        DB::table('enregs')->updateOrInsert(['enreg_id' => $enreg_id], $enreg);
                    }
                }    

                return array('status' => 'success');
                
            }else{
                return array('status' => 'error');
            }
        } catch (\Throwable $th) {
            return array('status' => 'try error');
        }
        
        
    }
}
