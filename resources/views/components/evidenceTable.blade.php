

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

                <span class = 'custom-table-1-header-cell custom-table-1-cell'>Evidence Name / Ref</span>
                <span class = 'custom-table-1-header-cell custom-table-1-cell'>Location Status</span>
                <span class = 'custom-table-1-header-cell custom-table-1-cell'>Current Storage Location</span>
                <span class = 'custom-table-1-header-cell custom-table-1-cell'>Date Aquired</span>
                <span class = 'custom-table-1-header-cell custom-table-1-cell'>Last Interaction By</span>
                
            </span>

            <?php

                $case_evidence_items = DB::table('fornsic_notes')
                ->where('case_assigned','=', $caseID)
                ->where('note_type', '=', 'Bag And Tag')
                ->get();

                $json_result = json_decode($case_evidence_items, true);

                foreach ($json_result as $json_result) {
                    // echo $json_result['title'];

                    $name_ref = $json_result['title'] . ' (Ref: ' . $json_result['evidence_ref'] . ')';
                    ?>
                        <span class = 'custom-table-1-body flex-row align-center'>

                            <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell title'><?php echo $json_result['title'] . '(Ref: ' . $json_result['evidence_ref'] . ')' ?></span>

                            <?php
                                $evidence_item_last_interact = DB::table('fornsic_notes')
                                ->where('case_assigned','=', $caseID)
                                ->where('title', '=', $name_ref)
                                ->where('note_type' , '=', 'Storage Alteration')
                                ->latest('created_at')
                                ->first();

                                if ($evidence_item_last_interact)
                                {
                                    ?>
                                    <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell storageref'><?php echo $evidence_item_last_interact->storage_alteration; ?></span>
                                    <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell storageref'><?php if ($evidence_item_last_interact->storage_alteration == 'removed'){echo 'Removed From: ' . $evidence_item_last_interact->evidence_storageRef;}else {echo $evidence_item_last_interact->evidence_storageRef;} ?></span>
                                    <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell storageref'><?php echo $json_result['created_at'] ?></span>
                                    <span class = 'flex-row align-center custom-table-1-body-cell custom-table-1-cell storageref'><?php echo $evidence_item_last_interact->signature . '<br />' . $evidence_item_last_interact->created_at?></span>
                                    <?php
                                }



   
                            ?>

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
    width: 20%;
}
.custom-table-1-body {
    margin-top: 5px;
}
.custom-table-1-body-cell {
    width: 20%;
    font-size: 14px;
}
</style>