<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body class = 'flex-row'>

    <section class = 'pdf_front_cover'>

        <header>
            <p>Content Created By: {{ $CompanyName }}</p>
        </header>

        <footer>
            <p> &copy; <?php echo date("D/M/Y");?> </p>
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

        $count_notes = 1;
        foreach ($json_result as $json_result) {

        ?>

        
        <section class = 'pdf_note'>

            <section style = 'width: 100%;' class = 'note_header'>
                <table style = 'width: 100%;'>
                    <tr style = 'color: grey; font-size: 12px; width: 100%;' >
                        <th style = 'width: 33%;'>Date Created: <?php echo $json_result['created_at'] ?></th>
                        <th style = 'width: 33%;'>Long, Lat: <?php echo $json_result['longitude'] . ', ' . $json_result['latitude'] ?></th>
                        <th style = 'width: 33%;'>Note Type: <?php echo $json_result['note_type'] ?></th>
                    </tr>
                </table>
            </section>

            <section class = 'note_body'>

                <table style = 'width: 100%; margin-top: 20px;'>
                    <tr style = 'color: black; font-size: 16px; width: 100%;' >
                        <th style = 'width: 33%;'>Title: <?php echo $json_result['title'] ?></th>
                    </tr>
                </table>

                <p><span class = 'bold' >Description:</span> <?php echo $json_result['description'] ?></p>  
                
                <?php
                if ($json_result['note_type'] == 'Evidence Identification'){         

                    ?>
                        <h4>Evidence Identified</h4>                                
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
                            <?php if($json_result['device_10_Name'] != 'N/S'){echo '<li>' . $json_result['device10_Name'] . '</li>'; } ?>
                        </ul>
                        
                    <?php
                }
                if ($json_result['note_type'] == 'Bag And Tag'){  
                    ?>                 

                    <table style = 'margin-top: 7px; padding: 8px; width: 100%;'>
                        <tr style = 'margin-bottom: 18px; color: grey; font-size: 12px; width: 100%;' >
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Generated Reference</th>
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Manufacturer</th>
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Model</th>
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Serial Number</th>
                        </tr>
                        <tr>
                            <td style = 'text-align: left;'><?php echo $json_result['evidence_ref'] ?></td>
                            <td style = 'text-align: left;'><?php echo $json_result['manufacturer'] ?></td>
                            <td style = 'text-align: left;'><?php echo $json_result['model'] ?></td>
                            <td style = 'text-align: left;'><?php echo $json_result['serial_number'] ?></td>
                        </tr>
                    </table>

                    <table style = 'margin-top: 7px; padding: 8px; width: 100%;'>
                        <tr style = 'color: grey; font-size: 12px; width: 100%;' >
                        
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Evidence Bag Number</th>
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Court Exhibit Number</th>
                            <th style = 'border-bottom: 1px solid black; text-align: left; width: 33%;'>Storage Reference</th>
                        </tr>
                        <tr>
                            <td><?php echo $json_result['evidence_bag_number'] ?></td>
                            <td><?php echo $json_result['evidence_courtExhibitNumber'] ?></td>
                            <td><?php echo $json_result['evidence_storageRef'] ?></td>
                        </tr>
                    </table>

                    <?php

                }
                if ($json_result['note_type'] == 'Initial Evidence State'){  
                    ?>

                    <p class = 'MB-3'><span class = 'bold'>Power Status:</span> <?php echo $json_result['power_status'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Hardrwae Connections:</span> <?php echo $json_result['hardware_connections'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Hardrwae Connections:</span> <?php echo $json_result['cable_configuration'] ?></p>
                    

                    
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
                    <p class = 'MB-3'><span class = 'bold'>New Evidence Bag ID:</span> <?php echo $json_result['evidence_bagID'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Court Exhibit Number:</span> <?php echo $json_result['evidence_courtExhibitNumber'] ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Storage Reference:</span> <?php if ($json_result['storage_alteration'] == 'removed'){echo 'Evidence Removed From ' . $json_result['evidence_storageRef'];}else {echo $json_result['evidence_storageRef'];} ?></p>
                    <p class = 'MB-3'><span class = 'bold'>Removed / Returned:</span> <?php echo $json_result['storage_alteration'] ?></p>

                    
                    

                    
                    <?php

                }
                ?>
                            
            </section>    
            <?php
            if (!empty($json_result['image_1'])) {
                
                $image1 = $json_result['image_1'];
                $path = 'storage/storage/images/' . $image1;

                if (!is_file($path)){
                    continue;
                }

                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <section style = 'margin-top: 60px;'>
                    <img src = "<?php echo $base64?>" width="auto" height="130">
                    <img src = "<?php echo $base64?>" width="auto" height="130">
                    <img src = "<?php echo $base64?>" width="auto" height="130">
                </section>
            <?php
            }
            ?>
            
            <?php
                $userName = DB::table('users')
                ->where('id','=', $json_result['created_by_id'])
                ->get();
            ?>
            <section style = 'margin-top: 40px; width: 100%;' class = 'note_footer'>
                <table style = 'width: 100%;'>
                    <tr style = 'color: grey; font-size: 12px; width: 100%;' >
                    <th style = 'width: 33%;'>User Name: <?php echo $userName[0]->name; ?></th>
                    <th style = 'width: 33%;'>User ID: <?php echo $json_result['created_by_id'] ?></th>
                        <th style = 'width: 33%;'>Signature: <?php echo $json_result['signature'] ?></th>
                    </tr>
                </table>
            </section>

        </section>

        <?php
        if ($count_notes != 2) {
            $count_notes = $count_notes + 1;
        }
        else { 
            ?>
            <section class="page_break"></section>
            <?php
            $count_notes = 1;
        }
        
        }

        ?>

    </section>

</body>
</html>

<style>
    
    .flex-row {
        display: flex;
        flex-direction: row;
    }
    .page_break { page-break-before: always; }

    .page-center-content {
        margin-top: 25%;
    }

    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        background-color: white;
        color: grey;
        text-align: center;
        /* line-height: 35px; */
        border-bottom: 1px solid grey;
    }

    footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px; 

        background-color: white;
        color: grey;
        text-align: center;
        /* line-height: 35px; */
        border-top: 1px solid grey;
    }
    .pdf_note {
        height: auto;
        width: 100%;
        min-height: 20%;
        border-top: 1px solid grey;
        border-bottom: 1px solid grey;
        padding: 10px;
        margin-top:8px;
        
    }
    .pdf_note {
        background-color: #ECF5F9;
        
    }
    .pdf_note p {
        font-size: 14px;
    }
    
    .bold {
        font-size: 17px;
        font-weight: 900;
        letter-spacing: 0.2px;
}
.MB-3 {
    margin-bottom: 3px !important;
}

</style>