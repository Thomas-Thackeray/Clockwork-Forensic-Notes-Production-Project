<x-app-layout>


    <section id = 'initiation-header' class = 'flex-row'>
        <ul class = 'flex-row'>
            <li>Company Name: {{$companie_name}}</li>
            <li>Signed-In As: {{ Auth::user()->name }}</li>
            <li>Case Name: {{$caseName}}</li>
        </ul>
    </section>


    <section id = 'mainContent-container' class = 'flex-column flex-wrap'>

        <section class = 'details_box'>

            <ul>

                <li><span class = 'primary-highlight bold'>Case Name: </span>{{$caseName}}</li>
                <li><span class = 'primary-highlight bold'>Created Date: </span>{{$case_created_date}}</li>
                <li><span class = 'primary-highlight bold'>Company Name: </span>{{$companie_name}}</li>
                <li><span class = 'primary-highlight bold'>Note Count: </span>{{$total_notes}}</li>

            </ul>

        </section>

        <section id = 'note-collection-holder' class = 'flex-column full-width'>

        <h2>Case Notes</h2>

        <?php

        $case_evidence_items = DB::table('fornsic_notes')
        ->where('case_assigned','=', $caseID)
        ->orderBy('created_at')
        ->get();

        $json_result = json_decode($case_evidence_items, true);

        foreach ($json_result as $json_result) {
            // echo $json_result['title'];
            ?>

            <section class = 'note-collection-item flex-column space-between full-width'>

                <section id = 'note-collection-holder-header' class = 'full-width'>

                    <ul class = 'remove-bullets flex-row align-center '>

                        <li class = 'header-fotter-list-item'>ID: <?php echo $json_result['id']; ?></li>
                        <li class = 'header-fotter-list-item'>Note Type: <?php echo $json_result['note_type']; ?> </li>
                        <li class = 'header-fotter-list-item'>Locked: <?php echo $json_result['locked']; ?></li>
                        <li class = 'header-fotter-list-item'>Created At: <?php echo $json_result['created_at']; ?></li>

                    </ul>

                </section>

                <section id = 'note-collection-holder-body' class = 'full-width flex-row'>

                <section>
                    <h3><?php echo $json_result['title']; ?></h3>

                    <?php
                    if ($json_result['note_type'] == 'Evidence Identification'){         

                    ?>
                        <h4>Evidence Identified At Crime Scene</h4>                                
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


                </section>

                <section id = 'note-collection-holder-footer' class = 'full-width'>

                    <ul class = 'remove-bullets flex-row align-center'>

                        <li class = 'header-fotter-list-item'>MD5 Hash: <?php echo $json_result['md5_hash']; ?></li>
                        <li class = 'header-fotter-list-item'>SHA1 Hash: <?php echo $json_result['sha1_hash']; ?></li>
                        <li class = 'header-fotter-list-item'>Long Lat: <?php echo $json_result['longitude'] . ', ' . $json_result['latitude']; ?></li>

                    </ul>

                </section>

            </section>

            <?php
                
            }
        ?>

        </section>

    </section>
    
</x-layout>