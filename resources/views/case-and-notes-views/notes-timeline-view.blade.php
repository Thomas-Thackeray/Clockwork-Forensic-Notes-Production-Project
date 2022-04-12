

<x-app-layout :caseID="$caseID" :caseName="$caseName" :companie_name="$companie_name">

<section id = 'initiation-header' class = 'flex-row'>
    <ul class = 'flex-row'>
        <li>Company Name: {{$companie_name}}</li>
        <li>Signed-In As: {{ Auth::user()->name }}</li>
        <li>Case Name: {{$caseName}}</li>
    </ul>
</section>

    <section id = 'mainContent-container' class = 'flex-column'>

        <div class="timeline">

        <?php

            $case_evidence_items = DB::table('fornsic_notes')
            ->where('case_assigned','=', $caseID)
            ->orderBy('created_at')
            ->get();

            $json_result = json_decode($case_evidence_items, true);

            // 0 = LEFT 1 = RIGHT
            $timeline_side = 0;

            foreach ($json_result as $json_result) {
                ?>

                    <section class = "<?php if($timeline_side == 0){echo "container left";}else {echo "container right";}?>">
                        <div class="content flex-column">

                            <span class = 'timeline-box-header flex-row space-between align-center'>

                                <p>Note Type: <?php echo $json_result['note_type'] ?></p>
                                <p>Created: <?php echo $json_result['created_at'] ?></p>

                            </span>

                            <span class = 'timeline-box-body flex-column '>
                                <h3><?php echo $json_result['title'] ?></h3>
                                <p><?php echo $json_result['description'] ?></p>

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

                                <p class = 'MB-3'><span class = 'bold'>Manufacturer:</span> <?php echo $json_result['manufacturer'] ?></p>
                                <p class = 'MB-3'><span class = 'bold'>Model:</span> <?php echo $json_result['model'] ?></p>
                                <p class = 'MB-3'><span class = 'bold'>Serial Number:</span> <?php echo $json_result['serial_number'] ?></p>

                                <p class = 'MB-3'><span class = 'bold'>Created Reference:</span> <?php echo $json_result['evidence_ref'] ?></p>

                                <p class = 'MB-3'><span class = 'bold'>Evidence Bag Number:</span> <?php echo $json_result['evidence_bag_number'] ?></p>
                                <p class = 'MB-3'><span class = 'bold'>Court Exhibit Number:</span> <?php echo $json_result['evidence_courtExhibitNumber'] ?></p>
                                <p class = 'MB-3'><span class = 'bold'>Storage Reference:</span> <?php echo $json_result['evidence_storageRef'] ?></p>

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

                                <h4 class = 'signature_show'>Signed By: <?php echo $json_result['signature'] ?></h4>     
                            </span>

                            <span class = 'timeline-box-footer flex-row space-between align-center'>

                                <p>Long, Lat: <?php echo $json_result['longitude'] . ', ' . $json_result['latitude']; ?></p>

                            </span>

                        </div>
                    </section>

                <?php
                if($timeline_side == 0) {
                    $timeline_side = 1;
                }
                else {
                    $timeline_side = 0;
                }

            }
        ?>
        
        </div>


    </section>

</x-layout>

<style>

/* TimeLine  */

/* The actual timeline (the vertical ruler) */
.timeline {
  position: relative;
  max-width: 1200px;
  margin: 0 auto;
  width: 100%;
  max-height: 3000px;
  overflow-y: scroll;
}

/* The actual timeline (the vertical ruler) */
.timeline::after {
  content: '';
  position: absolute;
  width: 6px;
  background-color: orange;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -3px;
}

/* Container around content */
.container {
  padding: 10px 40px;
  position: relative;
  background-color: inherit;
  width: 50%;
  border: 1px solid #dadada;
  border-radius: 6px;
}

/* The circles on the timeline */
.container::after {
  content: '';
  position: absolute;
  width: 25px;
  height: 25px;
  right: -13.9px;
  background-color: orange;
  border: 4px solid #0969da;
  top: 15px;
  border-radius: 50%;
  z-index: 1;
}

/* Place the container to the left */
.left {
  left: 0;
}

/* Place the container to the right */
.right {
  left: 50%;
}

/* Add arrows to the left container (pointing right) */
.left::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  right: 30px;
  border: medium solid white;
  border-width: 10px 0 10px 10px;
  border-color: transparent transparent transparent white;
}

/* Add arrows to the right container (pointing left) */
.right::before {
  content: " ";
  height: 0;
  position: absolute;
  top: 22px;
  width: 0;
  z-index: 1;
  left: 30px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
}

/* Fix the circle for containers on the right side */
.right::after {
  left: -12px;
}

/* The actual content */
.content {
  padding: 20px 30px;
  background-color: white;
  position: relative;
  border-radius: 6px;
}
.content h2 {
	font-size: 17px;
	font-weight: 800;
}
.content h3 {
	font-size: 16px;
	font-weight: 800;
}
.content h4 {
	font-size: 14px;
	font-weight: 500;
	margin-top: 10px;
}
.content p {
	font-size: 13px;
	line-height: 1.3;
	margin-top: 8px;
	margin-bottom: 8px;
	font-weight: 100;
}
/* Media queries - Responsive timeline on screens less than 600px wide */
@media screen and (max-width: 600px) {
  /* Place the timelime to the left */
  .timeline::after {
  left: 31px;
  }
  
  /* Full-width containers */
  .container {
  width: 100%;
  padding-left: 70px;
  padding-right: 25px;
  }
  
  /* Make sure that all arrows are pointing leftwards */
  .container::before {
  left: 60px;
  border: medium solid white;
  border-width: 10px 10px 10px 0;
  border-color: transparent white transparent transparent;
  }

  /* Make sure all circles are at the same spot */
  .left::after, .right::after {
  left: 15px;
  }
  
  /* Make all right containers behave like the left ones */
  .right {
  left: 0%;
  }
}



.timeline-box-header {
    border-bottom: 1px solid grey;
    margin-bottom: 8px;
}
.timeline-box-header p {
    font-size: 10px;
}
.timeline-box-footer {
    border-top: 1px solid grey;
    margin-top: 8px;
}
.timeline-box-footer p {
    font-size: 10px;
}
.timeline-box-body ul li {
    font-size: 12px;
    list-style: inside;

}
.timeline-box-body h4 {
    margin-bottom: 10px;
}
.signature_show {
    margin-left: auto;
}
.bold {
    font-size: 13px;
    font-weight: 900;
}
.MB-3 {
    margin-bottom: 3px !important;
}
</style>