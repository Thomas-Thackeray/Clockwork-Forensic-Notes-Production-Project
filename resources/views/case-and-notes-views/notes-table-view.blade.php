

<x-app-layout :caseID="$caseID" :caseName="$caseName" :companie_name="$companie_name">

<section id = 'initiation-header' class = 'flex-row'>
    <ul class = 'flex-row'>
        <li>Company Name: {{$companie_name}}</li>
        <li>Signed-In As: {{ Auth::user()->name }}</li>
        <li>Case Name: {{$caseName}}</li>
    </ul>
</section>

<section id = 'mainContent-container' class = 'flex-column'>

    <section class = 'custom-table-1 full-width flex-column'>

        <span class = 'custom-table-1-header flex-row align-center'>

            <span class = 'custom-table-1-header-cell custom-table-1-cell'>Note Type</span>
            <span class = 'custom-table-1-header-cell custom-table-1-cell'>Title</span>
            <span class = 'custom-table-1-header-cell custom-table-1-cell'>Description</span>
            <span class = 'custom-table-1-header-cell custom-table-1-cell'>Created At</span>
            <span class = 'custom-table-1-header-cell custom-table-1-cell'>Signature</span>
            <span class = 'custom-table-1-header-cell custom-table-1-cell small-cell'>Manage</span>
            
        </span>

        <?php

            $case_evidence_items = DB::table('fornsic_notes')
            ->where('case_assigned','=', $caseID)
            ->orderBy('created_at')
            ->get();

            $json_result = json_decode($case_evidence_items, true);

            foreach ($json_result as $json_result) {
                // echo $json_result['title'];

                $name_ref = $json_result['title'] . ' (Ref: ' . $json_result['evidence_ref'] . ')';
                ?>
                    <span class = 'custom-table-1-body flex-row align-center'>

                        <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell title'><?php echo $json_result['note_type'] ?></span>
                        <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell title'><?php echo $json_result['title'] ?></span>
                        <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell title'><?php echo $json_result['description'] ?></span>
                        <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell title'><?php echo $json_result['created_at'] ?></span>
                        <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell title'><?php echo $json_result['signature'] ?></span>
                        <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell small-cell title'>

                            <svg xmlns="http://www.w3.org/2000/svg" class="table-svg-small" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523
                                 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881
                                  3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                            </svg>
                        </span>
                    </span>
                <?php
                
            }
        ?>


    </section>


</section>

</x-layout>

<style>

.custom-table-1 {
height: max-content;
overflow: hidden;
}
.custom-table-1-header {
background-color: var(--success-colour);
padding: 10px;
border-top-right-radius: 8px;
border-top-left-radius: 8px;
overflow:hidden;
color: white;
}
.custom-table-1-header-cell {
width: 195px;
}
.custom-table-1-body {
margin-top: 10px;
}
.custom-table-1-body:nth-child(odd) {
  background: #dfdfdf;
}
.custom-table-1-body-cell {
width: 195px;
font-size: 14px;
padding: 10px;
}
.table-svg-small {
    height: 18px;
    width: 18px;
    fill: var(--success-colour);
    margin-left: auto;
    margin-right: auto;
}
.small-cell {
    width: 80px;
}
</style>