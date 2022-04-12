<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\fornsic_notes;
use App\Models\fornsic_cases;
use Illuminate\Support\Facades\Auth;

class caseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($caseName)
    {


        $current_user_company_id = auth()->user()->company_id;

        $case = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($case, true);

        $companie_name =  $result[0]['company_name'];

        view()->share('caseName', $caseName);

        return View::make('case-and-notes-views.note-selector', ['case_name' => $caseName, 'companie_name' => $companie_name]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user_company_id = auth()->user()->company_id;

        $companie = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($companie, true);

        $companie_name =  $result[0]['company_name'];

        return View::make('case-and-notes-views.create-case', ['companie_name' => $companie_name]);
        
    }

    public function change_status($caseName)
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

        return View::make('case-and-notes-views.case-status', ['case_name' => $caseName, 'companie_name' => $companie_name, 'caseID' => $caseID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyID = $request->companyID;

        // $validated = $request->validate([

        //     'caseName_input' => 'required|max:40',
        //     'caseDescription_input' => 'required|max:255',
        //     'CaseID' => 'required|max:10',
        //     'signature_input' => 'required|max:30',
        //     'companieName' => 'required|max:40',

        // ]);

        $newCase = new fornsic_cases;

        $newCase->case_name=$request->caseName_input;
        $newCase->case_description=$request->caseDescription_input;
        $newCase->completed='0';
        $newCase->user_Access_List=Auth::user()->id . ',';
        $newCase->company_id=$companyID;
        $newCase->created_by=Auth::user()->id;
        $newCase->priority='0';
        
        // $newNote->latitude=$request->latitude;
        // $newNote->longitude=$request->longitude;

        $newCase->case_hash='No Hash Set';

        $salt = 'LeedsBeckettUniversityHeadingly'; 

        $collatedData_string = $request->caseName_input . 
                                $request->caseDescription_input .
                                '0' .

                                $request->signature_input .
                                // $request->latitude .
                                // $request->longitude .

                                $salt;

        $newCase->case_hash= md5($collatedData_string);    

        $newCase->save();  

        return redirect('case/' . $request->caseName_input)->with('status', '*** Case Created Successfully - Date-TimeStamps: ' . date("Y/m/d") . ' ' . date("h:i:sa") . ' ***');;
  
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

    //  Once a case has been complated all the notes and the case itself is made inaccessible
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'changeStatus_input' => 'required|max:20',
            'reasonForChange_input' => 'required|max:255',
            'signature_input' => 'required|max:30',
            'CaseName' => 'required|max:50',
            'CaseID' => 'required|max:5',

            'image1_input' => 'image|mimes:jpg,png,jpeg',
            'image2_input' => 'image|mimes:jpg,png,jpeg',
            'image3_input' => 'image|mimes:jpg,png,jpeg',
            'audio1_input' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'audio2_input' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'audio3_input' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',

        ]);
        
       

        echo $request->CaseID;

        $affected = DB::table('fornsic_cases')
              ->where('id', '=', $request->CaseID)
              ->update(['completed' => 1]);

        $affected = DB::table('fornsic_notes')
              ->where('case_assigned', '=', $request->CaseID)
              ->update(['locked' => 1]);


        $newNote = new fornsic_notes; 


        $newNote->title = 'Case Closed' ;
        $newNote->description=$request->reasonForChange_input;

        $newNote->action_type='Case Closed';
    
        $newNote->signature=$request->signature_input;
        
        $newNote->latitude=$request->latitude;
        $newNote->longitude=$request->longitude;
        

        $newNote->note_type='Case Status Change'; 
        $newNote->created_by_id=Auth::user()->id;
        $newNote->case_assigned=$request->CaseID;

        $newNote->evidence_damage = 'N/S'; 
        $newNote->further_details= 'N/S';  

        if($request->file('image1_input')!=null){    
            $imagename = $request->file('image1_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('image2_input')!=null){    
            $imagename = $request->file('image2_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('image3_input')!=null){    
            $imagename = $request->file('image3_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }   
 
        if($request->file('audio1_input')!=null){    
            $imagename = $request->file('image1_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('audio2_input')!=null){    
            $imagename = $request->file('image2_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('audio3_input')!=null){    
            $imagename = $request->file('image3_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }   

        $salt = 'LeedsBeckettUniversityHeadingly'; 
        $collatedData_string = 'Case Closed' . 
                                $request->reasonForChange_input .
                                'Case Closed' .
                                'Case Status Change' .
                                $request->CaseID .

                                $request->signature_input .
                                $request->latitude .
                                $request->longitude .

                                $request->file('image1_input') .
                                $request->file('image2_input') .
                                $request->file('image3_input') .
                                $request->file('audio1_input') .
                                $request->file('audio2_input') .
                                $request->file('audio3_input') .
                                $salt;

        $newNote->md5_hash= md5($collatedData_string); 
        $newNote->sha1_hash= sha1($collatedData_string);  

        $newNote->save();  

        return redirect('case/' . $request->CaseName)->with('status', '*** The Note Was Successfully Created - Date-TimeStamps: ' . date("Y/m/d") . ' ' . date("h:i:sa") . ' ***');;
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
