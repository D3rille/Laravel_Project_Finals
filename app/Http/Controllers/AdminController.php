<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('/admin/userManagement', ['data' => $data]);
    }

    public function changeRole($id)
    {
        // dd($id);
        $account = User::findOrFail($id);
        // dd($account['role']);
        // if user is a not admin, promote to admin
        if (!$account) {
            return redirect()->route('admin.userManagement')->with('error', 'User not found.');
        }

        $newRole = $account->role == "1" ? 0 : 1;
        // if($account['role'] == 0){
        //     $account->update(['role'=>1]);
        // }
        // else if($account['role'] == 1){
        //     $account->update(['role'=>0]);
        // }
        // $account->update([
        //     'role' => $newRole,
        //     // Add other fields you want to update here
        // ]);

        $affected = DB::table('users')
              ->where('id', $id)
              ->update(['role' => $newRole]);


        return redirect()->route('admin.userManagement');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
