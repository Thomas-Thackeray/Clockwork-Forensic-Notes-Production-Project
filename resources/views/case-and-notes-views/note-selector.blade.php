
<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;

?>

<x-app-layout :case_name="$case_name" :companie_name="$companie_name">

    <?php
            $get_case = DB::table('fornsic_cases')
            ->where('case_name','=', $case_name)
            ->get();

    ?>

    @if (session('status'))<p id = 'hideMe' class = 'alert alert-success'>{{ session('status') }}</p>@endif  
    
    <section id = 'initiation-header' class = 'flex-row'>
        <ul class = 'flex-row'>
            <li>Company Name: {{$companie_name}}</li>
            <li>Signed-In As: {{ Auth::user()->name }}</li>
            <li>Case Name: {{$case_name}}</li>
        </ul>
    </section>

    <section id = 'mainContent-container' class = 'flex-row flex-wrap'>
        <?php
        $check_EvidenceIdentification = DB::table('fornsic_notes')
        ->where('note_type','=', 'Evidence Identification')
        ->where('case_assigned','=', $get_case[0]->id)
        ->get()->count();
        ?>
        @if (!empty($check_EvidenceIdentification))
        <section class = 'flex-column form-wrapper white-box note-type text-center justify-content-center align-center'>
            <h2>Bag n' Tag</h2>
            <p class = ''>Have You Just Bagged n' Tagged Evidence? Remember You Need To Record It To Maintain A Chain Of Custody.</p>
            <li class = 'create-buton'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case_name}}/new-note/bag-and-tag'>Create Note</a></li>
        </section>
        @endif
        <!-- The Initial crime scene report note container -->
        <section class = 'flex-column form-wrapper white-box note-type text-center justify-content-center align-center'>
            <h2>Initial Crime Scene Report</h2>
            <p class = ''>Just Arrived At The Crime Scene, record what you can see as possible 
            evidence. Phone's, Computers, Tablets, Laptops, Satnavs etc.</p>
            <li class = 'create-buton'><a class = 'flex-column justify-content-center align-center' 
            href = '/case/{{$case_name}}/new-note/evidence-identification'>Create Note</a></li>
        </section>

        <section class = 'flex-column form-wrapper white-box note-type text-center justify-content-center align-center'>
            <h2>Lab Investigation Notes</h2>
            <p class = ''>Every Process Completed When Interacting With The Evidence Should Be Recorded.</p>
            <li class = 'create-buton'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case_name}}/new-note/lab-investigation'>Create Note</a></li>
        </section>

        <?php
        $check_InitialEvidenceState = DB::table('fornsic_notes')
        ->where('note_type','=', 'Evidence Identification')
        ->where('case_assigned','=', $get_case[0]->id)
        ->get()->count();
        ?>
        @if (!empty($check_InitialEvidenceState))
        <section class = 'flex-column form-wrapper white-box note-type text-center justify-content-center align-center'>
            <h2>Initial Evidence State</h2>
            <p class = ''>What State I The Evidence In At The Scene. Inputs, Connections, Damage etc.</p>
            <li class = 'create-buton'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case_name}}/new-note/initial-evidence-state'>Create Note</a></li>
        </section>
        @endif

        <?php
        $check_BagAndTag = DB::table('fornsic_notes')
        ->where('note_type','=', 'Bag And Tag')
        ->where('case_assigned','=', $get_case[0]->id)
        ->get()->count();
        ?>
        @if (!empty($check_BagAndTag))
        <section class = 'flex-column form-wrapper white-box note-type text-center justify-content-center align-center'>
            <h2>Evidence Storage Interaction</h2>
            <p class = ''>To Maintain A Good Chain Of Custody All Evidence Retrived And Placed In Storage Should Be Recorded.</p>
            <li class = 'create-buton'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case_name}}/new-note/storage-alteration'>Create Note</a></li>
        </section>
        @endif

        @if (User::find(Auth::user()->id)->ruleConnect->role_name == 'Company Manager')
        <section class = 'flex-column form-wrapper white-box note-type text-center justify-content-center align-center'>
            <h2>Case Closure</h2>
            <p class = ''>Once A Case Has Been Completed, Sign It Off. By Signing A Case Of No One Can Create Any More Notes.</p>
            <li class = 'create-buton'><a class = 'flex-column justify-content-center align-center' href = '/case/{{$case_name}}/new-note/change-case-status'>Create Note</a></li>
        </section>
        @endif
      
  
      
    </section>
</x-layout>

<style>
#hideMe {
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
}
@keyframes cssAnimation {
    to {
        width:0;
        height:0;
        overflow:hidden;
    }
}
@-webkit-keyframes cssAnimation {
    to {
        width:0;
        height:0;
        visibility:hidden;
    }
}
.alert {
    color: green;
    font-size: 11px;
}
</style>