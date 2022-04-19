<!-- <!DOCTYPE html>
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
                            <?php if($json_result['device_10_Name'] != 'N/S'){echo '<li>' . $json_result['device10_Name'] . '</li>'; } ?>
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

                <?php
                    //in Controller    
                    $path = 'public/storage/images/logo.png';
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    //in View
                ?>

                <img src="{{ $data['logo'] }}" width="150" height="150" />

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
</style> -->

Skip to content
Search or jump to…
Pull requests
Issues
Marketplace
Explore
 
@Thomas-Thackeray 
Thomas-Thackeray
/
Clockwork-Forensic-Notes-Production-Project
Public
Code
Issues
Pull requests
Actions
Projects
Wiki
Security
Insights
Settings
Clockwork-Forensic-Notes-Production-Project/resources/views/components/case-notes-pdf.blade.php
@c3554686
c3554686 First commit
Latest commit 06c53d1 7 days ago
 History
 1 contributor
294 lines (227 sloc)  11.6 KB
   
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
