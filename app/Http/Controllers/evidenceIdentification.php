<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\fornsic_notes;
use Illuminate\Support\Facades\Auth;


class evidenceIdentification extends Controller
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

        $case = DB::table('companies')
        ->where('id','=', $current_user_company_id)
        ->get();
        $result = json_decode($case, true);

        $companie_name =  $result[0]['company_name'];

        view()->share('caseName', $caseName);

        return View::make('case-and-notes-views.evidence-identification', ['case_name' => $caseName, 'companie_name' => $companie_name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $case = DB::table('fornsic_cases')->where('case_name','=', $request->CaseName)->get(); 
        $result = json_decode($case, true);
        $caseID =  $result[0]['id'];

        $validated = $request->validate([
            'crimeSceneName_input' => 'required|max:30',
            'crimeSceneDescription_input' => 'required|max:255',
            'evidenceItem1_input' => 'max:30',
            'evidenceItem2_input' => 'max:30',
            'evidenceItem3_input' => 'max:30',
            'evidenceItem4_input' => 'max:30',
            'evidenceItem5_input' => 'max:30',
            'evidenceItem6_input' => 'max:30',
            'evidenceItem7_input' => 'max:30',
            'evidenceItem8_input' => 'max:30',
            'evidenceItem9_input' => 'max:30',
            'evidenceItem10_input' => 'max:30',

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

        $newNote = new fornsic_notes; 

        $newNote->title=$request->crimeSceneName_input;
        $newNote->description=$request->crimeSceneDescription_input;

        if(isset($request->evidenceItem1_input)){$newNote->device_1_Name=$request->evidenceItem1_input;}
        if(isset($request->evidenceItem2_input)){$newNote->device_2_Name=$request->evidenceItem2_input;}
        if(isset($request->evidenceItem3_input)){$newNote->device_3_Name=$request->evidenceItem3_input;}
        if(isset($request->evidenceItem4_input)){$newNote->device_4_Name=$request->evidenceItem4_input;}
        if(isset($request->evidenceItem5_input)){$newNote->device_5_Name=$request->evidenceItem5_input;}
        if(isset($request->evidenceItem6_input)){$newNote->device_6_Name=$request->evidenceItem6_input;}
        if(isset($request->evidenceItem7_input)){$newNote->device_7_Name=$request->evidenceItem7_input;}
        if(isset($request->evidenceItem8_input)){$newNote->device_8_Name=$request->evidenceItem8_input;}
        if(isset($request->evidenceItem9_input)){$newNote->device_9_Name=$request->evidenceItem9_input;}
        if(isset($request->evidenceItem10_input)){$newNote->device_10_Name=$request->evidenceItem10_input;}



        $newNote->signature=$request->signature_input;
        
        $newNote->latitude=$request->latitude;
        $newNote->longitude=$request->longitude;
        

        $newNote->note_type='Evidence Identification'; 
        $newNote->created_by_id=Auth::user()->id;
        $newNote->case_assigned=$caseID;

        $newNote->evidence_damage = 'N/S'; 
        $newNote->further_details= 'N/S';   

        $newNote->note_start_Time=$request->start_time;
        $newNote->note_start_Date=$request->start_date;

        if($request->file('image1_input')!=null){    
            $imagename = $request->file('image1_input')->store('public/storage/images');
            $newNote->image_1 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('image2_input')!=null){    
            $imagename = $request->file('image2_input')->store('public/storage/images');
            $newNote->image_2 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('image3_input')!=null){    
            $imagename = $request->file('image3_input')->store('public/storage/images');
            $newNote->image_3 = str_replace("public/storage/images/", "", $imagename);
        }   
 
        if($request->file('audio1_input')!=null){    
            $imagename = $request->file('image1_input')->store('public/storage/images');
            $newNote->audio_1 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('audio2_input')!=null){    
            $imagename = $request->file('image2_input')->store('public/storage/images');
            $newNote->audio_2 = str_replace("public/storage/images/", "", $imagename);
        }    
        if($request->file('audio3_input')!=null){    
            $imagename = $request->file('image3_input')->store('public/storage/images');
            $newNote->audio_3 = str_replace("public/storage/images/", "", $imagename);
        }  

        $salt = 'LeedsBeckettUniversityHeadingly'; 
        $collatedData_string = $request->crimeSceneName_input . 
                                $request->crimeSceneDescription_input .

                                $request->evidenceItem1_input .
                                $request->evidenceItem2_input .
                                $request->evidenceItem3_input .
                                $request->evidenceItem4_input .
                                $request->evidenceItem5_input .
                                $request->evidenceItem6_input .
                                $request->evidenceItem7_input .
                                $request->evidenceItem8_input .
                                $request->evidenceItem9_input .
                                $request->evidenceItem10_input .

      
                                $request->signature_input .
                                $request->latitude .
                                $request->longitude .

                                $request->start_time .
                                $request->start_date .

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
