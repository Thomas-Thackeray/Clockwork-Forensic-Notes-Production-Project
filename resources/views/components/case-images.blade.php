<!DOCTYPE html>
<html>
<head>
    <title>Case Images</title>

</head>
<body class = 'flex-column' :caseName="$caseName" :caseID="$caseID">

    <section class = 'case-images-page-container flex-column '>

        <section class = 'case-images-containerr flex-row flex-wrap'>

            <?php

            use Illuminate\Support\Facades\DB;

            $case_evidence_items = DB::table('fornsic_notes')
            ->where('case_assigned','=', $caseID)
            ->orderBy('created_at')
            ->get();

            $json_result = json_decode($case_evidence_items, true);

            $count_notes = 0;
            foreach ($json_result as $json_result) {
                $count_notes = $count_notes + 1;
                
    
                $image1 = $json_result['image_1'];
                $image2 = $json_result['image_2'];
                $image3 = $json_result['image_3'];
                ?>

                <?php 
                if(!empty($image1)){
                    ?> 
                    <figure class = 'flex-column image-figure'><img src="{{ asset('storage/images/' . $image1)  }}" alt="" title=""><?php echo 'CaseNote: ' . $count_notes . '<br />'; ?> Image 1</figure>
                    <?php
                } 
                ?>
                <?php 
                if(!empty($image2)){
                    ?> 
                    <figure class = 'flex-column image-figure'><img src="{{ asset('storage/images/' . $image2)  }}" alt="" title=""><?php echo 'CaseNote: ' . $count_notes . '<br />'; ?> Image 2</figure>
                    <?php
                } 
                ?>
                <?php 
                if(!empty($image3)){
                    ?> 
                    <figure class = 'flex-column image-figure'><img src="{{ asset('storage/images/' . $image3)  }}" alt="" title=""><?php echo 'CaseNote: ' . $count_notes . '<br />'; ?> Image 3</figure>
                    <?php
                } 
                ?>              

                
                <?php

            }

            ?>

        </section>

    </section>

  



</body>
</html>

<style>

* {
    padding: 0px;
    margin: 0px;
    box-sizing: border-box;
}
.case-images-page-container {
    height: 100%;
    width: 100%;
    padding: 25px;
}

.image-figure {
    height: 280px;
    width: 400px;
    margin: 10px;    
    border: 1px solid #d2d2d2;
    padding: 5px;
    align-items: center;
    text-align: center;
    border-radius: 4px;
}
.image-figure img {
    width: auto;
    max-width: 100%;
    HEIGHT: AUTO;
    max-height: 80%;
    margin-bottom: 7px;
    margin-left: auto;
    margin-right: auto;
    
}
.case-images-containerr {
    border: 1px solid #797979;
    padding: 8px;
}

.flex-column {
    display: flex;
    flex-direction: column;
}
.flex-row {
    display: flex;
    flex-direction: row;
}

.flex-wrap {
    flex-wrap: wrap;
}
</style>