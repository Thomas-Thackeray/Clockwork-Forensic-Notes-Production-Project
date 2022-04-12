<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class evidenceHandler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($caseName)
    {

        $current_user_company_id = auth()->user()->company_id;

        $companie = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($companie, true);

        $companie_name =  $result[0]['company_name'];
        
        $currentCase = DB::table('fornsic_cases')
        ->where('case_name','=', $caseName)
        ->get();


        $result2 = json_decode($currentCase, true);
        $caseID =  $result2[0]['id'];

        return View::make('components.evidenceTable', ['caseName' => $caseName, 'caseID' => $caseID, 'companie_name' => $companie_name]);
        
    }

    public function table_view_index($caseName)
    {
        $current_user_company_id = auth()->user()->company_id;

        $companie = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($companie, true);

        $companie_name =  $result[0]['company_name'];
        
        $currentCase = DB::table('fornsic_cases')
        ->where('case_name','=', $caseName)
        ->get();
        


        $result2 = json_decode($currentCase, true);
        $caseID =  $result2[0]['id'];

        view()->share('caseName', $caseName);

        return View::make('case-and-notes-views.notes-table-view', ['caseName' => $caseName, 'caseID' => $caseID, 'companie_name' => $companie_name]);        
        
    }

    public function timeline_view_index($caseName)
    {
        $current_user_company_id = auth()->user()->company_id;

        $companie = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($companie, true);

        $companie_name =  $result[0]['company_name'];
        
        $currentCase = DB::table('fornsic_cases')
        ->where('case_name','=', $caseName)
        ->get();


        $result2 = json_decode($currentCase, true);
        $caseID =  $result2[0]['id'];

        view()->share('caseName', $caseName);

        return View::make('case-and-notes-views.notes-timeline-view', ['caseName' => $caseName, 'caseID' => $caseID, 'companie_name' => $companie_name]);          
    }

    public function hex_interpreter($caseName)
    {

        $current_user_company_id = auth()->user()->company_id;

        $companie = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($companie, true);

        $companie_name =  $result[0]['company_name'];
        
        $currentCase = DB::table('fornsic_cases')
        ->where('case_name','=', $caseName)
        ->get();


        $result2 = json_decode($currentCase, true);
        $caseID =  $result2[0]['id'];
        view()->share('caseName', $caseName);
        return View::make('components.file_hex_viewer', ['caseName' => $caseName, 'caseID' => $caseID, 'companie_name' => $companie_name]);
        
    }

    public function final_Notes_View($caseName) {

        $current_user_company_id = auth()->user()->company_id;

        $companie = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($companie, true);

        $companie_name =  $result[0]['company_name'];
        
        $currentCase = DB::table('fornsic_cases')
        ->where('case_name','=', $caseName)
        ->get();

        $result2 = json_decode($currentCase, true);

        $caseID =  $result2[0]['id'];
        $case_created_date =  $result2[0]['created_at'];

        $total_notes = DB::table('fornsic_notes')
        ->where('case_assigned','=', $caseID)
        ->count();

        view()->share('caseName', $caseName);
        return View::make('case-and-notes-views.case-closed-view-notes', ['caseName' => $caseName, 'caseID' => $caseID, 'case_created_date' => $case_created_date, 'companie_name' => $companie_name, 'total_notes' => $total_notes]);





    }

    public function get_hex_content($caseName, Request $request)
    {
        // $imagelink = file_get_contents('file:///F:/Wat2020/crud/images/mug.jpg');

        $url = Storage::url('aVBO5Y9kTsBCftVhxX6ufR5AkgDORJoDjcCHPNIi.png');
        echo $url;
        echo bin2hex($url);


        // $imagelink = file_get_contents('https://cdn.codespeedy.com/wp-content/themes/CodeSpeedy-March-2019/img/CodeSpeedy-Logo.png');
        // echo bin2hex($imagelink);
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
        //
    }
}
