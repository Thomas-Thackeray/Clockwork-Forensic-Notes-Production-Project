<?php

namespace App\Http\Controllers;

use App\Models\fornsic_notes;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class pdfBuilderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function createPDF($caseName) {

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

        // return View::make('case-and-notes-views.notes-table-view', ['caseName' => $caseName, 'caseID' => $caseID, 'companie_name' => $companie_name]);

        
        $data = [
            'CaseName' => $caseName,
            'CaseID' => $caseID,
            'CompanyName' => $companie_name,
        ];
          
        $pdf = PDF::loadView('components.case-notes-pdf', $data);

        return $pdf->download('ContemporaneousNotes.pdf');
        
      }

      public function showCaseImages($caseName)
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

        return View::make('components.case-images', ['case_name' => $caseName, 'companie_name' => $companie_name, 'caseID' => $caseID]);

        
        
          
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
