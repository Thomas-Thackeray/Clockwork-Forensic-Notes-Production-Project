<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body class = 'flex-row' :caseName="$caseName" :caseID="$caseID" class="l-navbar" id="nav-bar">

    <section class = 'image-container'>

        <?php

        use Illuminate\Support\Facades\DB;

        $case_evidence_items = DB::table('fornsic_notes')
        ->where('case_assigned','=', $caseID)
        ->orderBy('created_at')
        ->get();

        $json_result = json_decode($case_evidence_items, true);

        $count_notes = 0;
        foreach ($json_result as $json_result) {
            // echo $json_result['image_2'];
            ?>

        
            

            <?php
            $image1 = $json_result['image_1'];
            $image2 = $json_result['image_2'];
            $image3 = $json_result['image_3'];
            ?>

            <img src="{{ asset('storage/images/' . $image1)  }}" alt="" title=""></a>
            <img src="{{ asset('storage/images/' . $image2)  }}" alt="" title=""></a>
            <img src="{{ asset('storage/images/' . $image3)  }}" alt="" title=""></a>

            
            <?php

        }

        ?>

    </section>

  



</body>
</html>



