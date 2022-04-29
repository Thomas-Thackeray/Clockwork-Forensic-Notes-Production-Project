<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\fornsic_notes;
use Illuminate\Support\Facades\Auth;

class bagAndTagController extends Controller
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

        return View::make('case-and-notes-views.bag-and-tag', ['case_name' => $caseName, 'companie_name' => $companie_name, 'caseID' => $caseID]);


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
            'evidenceName_input' => 'required|max:30',
            'evidenceReferenceNumber_input' => 'required|max:10',
            'evidenceDescription_input' => 'required|max:255',
            'manufacturer_input' => 'max:35',
            'model_input' => 'max:35',
            'serialNumber_input' => 'required|max:30',
            'uniqueId_input' => 'required|max:30',
            'courtExhibitNumber_input' => 'required|max:30',
            'storageReference_input' => 'required|max:30',
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

        $newNote->title=$request->evidenceName_input;
        $newNote->evidence_ref=$request->evidenceReferenceNumber_input;
        $newNote->description=$request->evidenceDescription_input;
        $newNote->manufacturer=$request->manufacturer_input;
        $newNote->model=$request->model_input;
        $newNote->serial_number=$request->serialNumber_input;
        $newNote->evidence_bag_number=$request->uniqueId_input;
        $newNote->evidence_courtExhibitNumber=$request->courtExhibitNumber_input;
        $newNote->evidence_storageRef=$request->storageReference_input;
        $newNote->signature=$request->signature_input;
        
        $newNote->latitude=$request->latitude;
        $newNote->longitude=$request->longitude;
        

        $newNote->note_type='Bag And Tag'; 
        $newNote->created_by_id=Auth::user()->id;
        $newNote->case_assigned=$caseID;

        $newNote->evidence_damage = 'N/S'; 
        $newNote->further_details= 'N/S';   

        $newNote->note_start_Time=$request->start_time;
        $newNote->note_start_Date=$request->start_date;

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

        $salt = 'LeedsBeckettUniversityHeadingly'; 
        $collatedData_string = $request->evidenceName_input . 
                                $request->evidenceReferenceNumber_input .
                                $request->evidenceDescription_input .
                                $request->manufacturer_input .
                                $request->model_input .
                                $request->serialNumber_input .
                                $request->uniqueId_input .
                                $request->courtExhibitNumber_input .
                                $request->storageReference_input .
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
