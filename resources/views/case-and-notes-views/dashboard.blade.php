<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Get the users company ID
$current_user_company_id = auth()->user()->company_id;

// Get every case which is associated with the company
$case = DB::table('fornsic_cases')
->where('company_id','=', $current_user_company_id)
->get();
$result = json_decode($case, true);
?>
<x-app-layout>

    <section id = 'mainContent-container' class = 'flex-row flex-wrap'>
        <?php
            // For each case the users company is associated with print to screen
            foreach ($case as $case) {
                // Counts the amount of users in the user access list
                $number_of_members = substr_count($case->user_Access_List, ",");
                // Gets the status of the case if it is closed or not
                $complete_status =  $result[0]['completed'];
                // Counts the amount of notes inside the case
                $notes = DB::table('fornsic_notes')
                ->where('case_assigned','=', $case->id)
                ->count();              
                ?>
                <!-- The start of the box which contains a case  -->                
                <div id = "{{$case->id;}}" class = 'indervidual-case-box flex-column'>
                    <span class = 'space-between flex-row case-box-title'>
                        <h3>{{$case->case_name}}</h3>
                        
                        @if($case->completed == '1') 
                            <svg xmlns="http://www.w3.org/2000/svg" class = 'small-svg case-close-svg' viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            </svg>                   
                        
                        @else 
                            <svg class = 'small-svg case-open-svg' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2z"/>
                            </svg>                    
                        @endif
                    </span>

                    <span class = 'flex-column space-between case-box-body'>

                        <ul class = 'mini-case-stats text-center'>
                            <li>Last Accessed: {{$case->updated_at}}</li>

                            <?php
                            $latestNote = DB::table('fornsic_notes')
                            ->where('case_assigned','=', $case->id)
                            ->latest('updated_at', 'desc')->get();

                            if ($latestNote->count()) {
                                
                                $latestNote = DB::table('users')
                                ->where('id','=', $latestNote[0]->created_by_id)
                                ->get();
                                
                                ?>
                                <li>Last Accessed By: <?php echo $latestNote[0]->name; ?></li>
                                <?php
                                
                            }
                            else {
                                
                            }
                            ?>

                        </ul>

                        <div class = 'full-width special-stats align-center justify-content-center flex-row'>
                            <div class = 'half-width flex-column text-center'>
                                <h5>Notes</h5>
                                <h6><?php echo $notes; ?></h6>
                            </div>
                            <div class = "half-width flex-column text-center">
                                <h5>Members</h5>
                                <h6><?php echo $number_of_members; ?></h6>
                            </div>
                        </div>
                        @if($case->completed == '1') 
                        <section class = 'flex-row space-between MT-10' >                
                        <li class = 'button-transition full-width open-link'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case->case_name}}/create-pdf'>Create PDF</a></li>
                        <!-- <li class = 'button-transition below-half-width open-link'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case->case_name}}/case-closed/view-notes'>View Case</a></li> -->
                        @else                        
                        <li class = 'button-transition full-width open-link'>
                        <a class = 'flex-column justify-content-center align-center' 
                        href = '/case/{{$case->case_name}}'>Open Case</a></li>  
                                                  
                        @endif
                
                                                    
                    </span>
                    
                </div>

        <?php

        }
        ?>


    </section>
</x-layout>