<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\fornsic_notes;
use Illuminate\Support\Facades\Auth;

class twoFactorAuth extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $code = Auth::user()->two_factor_code;
        $email = Auth::user()->email;

        $details = [
            'title' => 'Two Factor Authentication',
            'body' => $code
        ];
       
        \Mail::to($email)->send(new \App\Mail\email_constructor($details));

        return View::make('auth.auth-check');
    }

    public function check(request $request) {
        
        if ($request['twoFactorCode'] == Auth::user()->two_factor_code) {
            // Success
            $successVerifyColumn = DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->where('email', '=', Auth::user()->email)
            ->update(array('verified' => '1'));

            return redirect()->route('dashboard');
        }
        else {
            return redirect()->route('logout');
            
        }

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($caseName)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        //
    }
}
