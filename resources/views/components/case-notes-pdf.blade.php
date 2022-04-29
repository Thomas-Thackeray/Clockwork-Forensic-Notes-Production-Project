<!DOCTYPE html>
<html>
<head>
    <title>Contemporaneous Notes</title>
</head>
<body class = 'flex-row'>

    <section class = 'pdf_front_cover'>

        <header>
            <p>Content Created By: {{ $CompanyName }}</p>
        </header>

        <footer>
            <p> &copy; <?php

use Illuminate\Support\Facades\DB;

echo date("D/M/Y");?> </p>
        </footer>

        <section class = 'page-center-content'>

            <h1 style = 'text-align:center;'>Contemporaneous Notes</h1>
            <p style = 'text-align:center;'>Company Name: {{ $CompanyName }}</p>      
            <p style = 'text-align:center;'>Case Name: {{ $CaseName }}</p>          
            
        </section>
        
    </section>
  
    <section class="page_break"></section>


    <section class = 'pdf_main_content'>

    <?php

        $case_evidence_items = DB::table('fornsic_notes')
        ->where('case_assigned','=', $CaseID)
        ->orderBy('created_at')
        ->get();

        $json_result = json_decode($case_evidence_items, true);

        $count_notes = 0;
        foreach ($json_result as $json_result) {
            $count_notes = $count_notes + 1;

            $userName = DB::table('users')
            ->where('id','=', $json_result['created_by_id'])
            ->get();
        
            ?>
                <section class = 'pdf_main_content'>

                    <section class = 'pdf_main_content_page_hedaer'>
                        <p style = 'text-align:center;'>Company Name: {{ $CompanyName }}</p> 
                    </section>

                    <table class = 'single_col_table'>
                        <tr>
                            <th>Case Note: <?php echo $count_notes; ?><br /> Created By: <?php echo $userName[0]->name; ?></th>
                            <th>Start Date / Time: <?php echo '<br/>' . $json_result['note_start_Time'] . ' ' . $json_result['note_start_Date']; ?></th>
                            <th>Finsih Date / Time: <?php echo '<br />' . $json_result['created_at']; ?></th>
                        </tr>
                    </table>

                    <table class = 'single_col_table_hash'>
                        <tr>
                            <th>MD5 Hash: <?php echo $json_result['md5_hash'];?></th>
                            <th>SHA-1 Hash: <?php echo $json_result['sha1_hash']; ?></th>
                        </tr>
                    </table>

                    <table class = 'single_col_table_hash'>
                        <tr>
                            <th>Longitude: <?php echo $json_result['longitude'];?></th>
                            <th>Latitude: <?php echo $json_result['latitude']; ?></th>

                            <?php
                            $image_count = 0;
                            if(!empty($json_result['image_1'])) {$image_count = $image_count + 1;}
                            if(!empty($json_result['image_2'])) {$image_count = $image_count + 1;}
                            if(!empty($json_result['image_3'])) {$image_count = $image_count + 1;}

                            ?>

                                                        
                            <th>Images: <?php echo $image_count; if($image_count > 0){echo " (See Case Image Page)";} ?></th>
                        </tr>
                    </table>

                    <table class = 'single-row-table-left-column'>
                        <tr>
                            <th>Note Type: <?php echo $json_result['note_type'];?></th>
                        </tr>
                    </table>

                    <table class = 'single-row-table-left-column'>
                        <tr>
                            <th>Title: <?php echo $json_result['title'];?></th>
                        </tr>
                    </table>

                    <table class = 'single-row-table-left-column'>
                        <tr>
                            <th><?php echo $json_result['description'];?></th>
                        </tr>
                    </table>

                    <?php
                if ($json_result['note_type'] == 'Evidence Identification'){         
                    ?>
                        <h4>Evidence Identified</h4>      
                        <table class = 'single-row-table-left-column paragraph'>
                            <tr>
                                <th><?php echo "Some evidence was identified at the scene these were";?></th>
                            </tr>
                        </table>                          
                        <ul>
                            <?php if($json_result['device_1_Name'] != 'N/S'){echo '<li>' . $json_result['device_1_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_2_Name'] != 'N/S'){echo '<li>' . $json_result['device_2_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_3_Name'] != 'N/S'){echo '<li>' . $json_result['device_3_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_4_Name'] != 'N/S'){echo '<li>' . $json_result['device_4_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_5_Name'] != 'N/S'){echo '<li>' . $json_result['device_5_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_6_Name'] != 'N/S'){echo '<li>' . $json_result['device_6_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_7_Name'] != 'N/S'){echo '<li>' . $json_result['device_7_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_8_Name'] != 'N/S'){echo '<li>' . $json_result['device_8_Name'] . '</li>'; } ?>
                            <?php if($json_result['device_9_Name'] != 'N/S'){echo '<li>' . $json_result['device_9_Name'] . '</li>'; } ?>
                            
                        </ul>
                        
                    <?php
                }
                if ($json_result['note_type'] == 'Bag And Tag'){  
                    ?>          
                    <table class = 'single-row-table-left-column paragraph'>
                        <tr>
                            <th><?php echo 'A piece of evidence was seized, the evidence was made by ' . $json_result['manufacturer'] . '. Its model was ' . $json_result['model'] . ' and servisal number ' . $json_result['serial_number'] .
                            ' This evidence was then placed into a evidence bad which was provided the court exhibit number, ' . $json_result['evidence_courtExhibitNumber'] . '. The evidence bag
                            has the unique id of ' . $json_result['evidence_bag_number'] . 'and was stored at location ' . $json_result['evidence_storageRef'];?></th>
                        </tr>
                    </table>           

                    <?php
                }
                if ($json_result['note_type'] == 'Initial Evidence State'){  
                    ?>

                    <table class = 'single-row-table-left-column paragraph'>
                        <tr>
                            <th><?php echo 'After identifying this piece of evidence at the scene it\'s initial state found at the crime scene was noted. It had the
                            power status of ' . $json_result['power_status'] . '. <br />' . $json_result['hardware_connections'] . '<br />' . $json_result['cable_configuration']; ?></th>
                        </tr>
                    </table>   
                    
                    <?php
                }
                if ($json_result['note_type'] == 'Lab Investigation'){  
                    ?>
                    <p class = 'MB-3'><span class = 'bold'>Evidence Name / Ref:</span> <?php echo $json_result['evidence_ref'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Action Type:</span> <?php echo $json_result['action_type'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Outcome:</span> <?php echo $json_result['outcome_type'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Tool Used:</span> <?php echo $json_result['tool_name'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Tool Version:</span> <?php echo $json_result['tool_version'] ?></p>

                    
                    <?php
                }
                if ($json_result['note_type'] == 'Storage Alteration'){  
                    ?>
                    <table class = 'single-row-table-left-column paragraph'>
                        <tr>
                            <th><?php echo 'The evidence was ' . $json_result['storage_alteration'] . ' to storage in a new evidence bag with the id ' . 
                            $json_result['evidence_bagID'] . ' and the court exhibit number' . $json_result['hardware_connections'] . '. It was placed in storage location ' . $json_result['evidence_storageRef']; ?></th>
                        </tr>
                    </table>   

                    <?php

                    
                }
                ?>
                
                </section>

                <section class="page_break"></section>

            <?php        
            
        }

        ?>

    </section>

</body>
</html>

<style>
    
    .page_break { page-break-before: always; }

    .page-center-content {
        margin-top: 25%;
    }

    .pdf_main_content_page_hedaer {
        position: fixed;
        top: 0px;
        left: 0px;
        right: 0px;
        height: 50px;

        background-color: white;
        color: grey;
        text-align: center;
        border-bottom: 1px solid grey;
        margin-bottom: 30px;
    }


.MB-3 {
    margin-bottom: 3px !important;
}

.single_col_table {
    width: 100%;
    border-top: 1px solid #c7c1c1;
    border-bottom: 1px solid #c7c1c1;
    margin-top: 70px;
    background-color: #ededed;
}
.single_col_table tr {
    height: 100%;
}
.single_col_table tr th {
    width: 33%;
    padding-top: 20px;
    padding-bottom: 20px;
    font-size: 13px;
    line-height: 20px;
}

.single_col_table_hash {
    width: 100%;
    border-top: 1px solid #c7c1c1;
    border-bottom: 1px solid #c7c1c1;
    background-color: #ededed; 
    margin-top: 5px;
}
.single_col_table_hash tr th {
    width: 50%;
    padding-top: 5px;
    padding-bottom: 5px;
    font-size: 12px;
}

.single-row-table-left-column {
    width: 100%;
    margin-top: 5px;    
}
.single-row-table-left-column tr th {
    width: 100%;
    padding-top: 5px;
    padding-bottom: 5px;
    font-size: 14px;
    text-align: left;
}
.paragraph {
    padding-top: 0px;
    padding-bottom: 0px;
    font-weight: 100;
    line-height: 18px;
}
</style>
