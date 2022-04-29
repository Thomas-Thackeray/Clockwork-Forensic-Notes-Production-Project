<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\fornsic_notes;
use Illuminate\Support\Facades\Auth;
class labInvestigationController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($caseName)
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

        return View::make('case-and-notes-views.lab-investigation', ['case_name' => $caseName, 'companie_name' => $companie_name, 'caseID' => $caseID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get the current cases information
        $case = DB::table('fornsic_cases')->where('case_name','=', $request->CaseName)->get(); 
        $result = json_decode($case, true);
        $caseID =  $result[0]['id'];

        //  validate the data that has been submitted inside the form
        $validated = $request->validate([
            'noteTitle_input' => 'required|max:30',
            'interactedEvidence_input' => 'required|max:30',
            'actionType_input' => 'required|max:30',
            'outcome_input' => 'required|max:30',
            // Increased from 255
            'actionDescription_input' => 'required|max:555',
            'actionResult_input' => 'required|max:555',
            'toolUsedName_input' => 'required|max:30',
            'toolUsedVersion_input' => 'required|max:20',

            'signature_input' => 'required|max:30',
            'CaseName' => 'required|max:50',

            'image1_input' => 'image|mimes:jpg,png,jpeg',
            'image2_input' => 'image|mimes:jpg,png,jpeg',
            'image3_input' => 'image|mimes:jpg,png,jpeg',
            'audio1_input' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'audio2_input' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            'audio3_input' => 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',

            'start_time' => 'required',
            'start_date' => 'required',
        ]);

        // Created a new instance of a note
        $newNote = new fornsic_notes; 
        // The following lines stores the data submitted by the user with there
        // corrosponding columns wihin the "forensic_notes" table
        $newNote->title=$request->noteTitle_input;
        $newNote->evidence_ref=$request->interactedEvidence_input;
        $newNote->action_type=$request->actionType_input;
        $newNote->outcome_type=$request->outcome_input;
        $newNote->description=$request->actionDescription_input;
        $newNote->further_details=$request->actionResult_input;
        $newNote->tool_name=$request->toolUsedName_input;
        $newNote->tool_version=$request->toolUsedVersion_input;
        $newNote->signature=$request->signature_input;      
        $newNote->latitude=$request->latitude;
        $newNote->longitude=$request->longitude;
        // Each note is given a note type which is used 
        // to identify the category of note later on
        $newNote->note_type='Lab Investigation'; 
        $newNote->created_by_id=Auth::user()->id;
        $newNote->case_assigned=$caseID;
        $newNote->evidence_damage = 'N/S'; 
        $newNote->further_details= 'N/S';   
        $newNote->note_start_Time=$request->start_time;
        $newNote->note_start_Date=$request->start_date;
        // Storing the media files
        if($request->file('image1_input')!=null){    
            $imagename = $request->file('image1_input')->store('images');
            $newNote->image_1 = str_replace("images/", "", $imagename);
        }    
        if($request->file('image2_input')!=null){    
            $imagename = $request->file('image2_input')->store('images');
            $newNote->image_2 = str_replace("images/", "", $imagename);
        }    
        if($request->file('image3_input')!=null){    
            $imagename = $request->file('image3_input')->store('images');
            $newNote->image_3 = str_replace("images/", "", $imagename);
        }   
 
        if($request->file('audio1_input')!=null){    
            $imagename = $request->file('image1_input')->store('images');
            $newNote->audio_1 = str_replace("images/", "", $imagename);
        }    
        if($request->file('audio2_input')!=null){    
            $imagename = $request->file('image2_input')->store('images');
            $newNote->audio_2 = str_replace("images/", "", $imagename);
        }    
        if($request->file('audio3_input')!=null){    
            $imagename = $request->file('image3_input')->store('images');
            $newNote->audio_3 = str_replace("images/", "", $imagename);
        }  

        // CHANGE THIS ON EVERY PAGE CLEANS UP CODE
        $hash_md5 = md5($newNote);
        $hash_sha1 = sha1($newNote);

        $newNote->md5_hash = $hash_md5;
        $newNote->sha1_hash= $hash_sha1;

        $newNote->save();  

        return redirect('case/' . $request->CaseName)
        ->with('status', '*** The Note Was Successfully Created - Date-TimeStamps: ' . 
        date("Y/m/d") . ' ' . date("h:i:sa") . ' ***');;
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
