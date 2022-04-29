

<x-app-layout :caseID="$caseID" :caseName="$caseName" :companie_name="$companie_name">

<section id = 'initiation-header' class = 'flex-row'>
    <ul class = 'flex-row'>
        <li>Company Name: {{$companie_name}}</li>
        <li>Signed-In As: {{ Auth::user()->name }}</li>
        <li>Case Name: {{$caseName}}</li>
    </ul>
</section>

    <section id = 'mainContent-container' class = 'flex-column'>
<?php echo hjdhgdgh ?>
    <section class = 'flex-column full-width'>
                <form enctype='multipart/form-data' action = '/case/{{$caseName}}/hex-interpreter/get-content' method = 'POST'>
                @csrf
                    <input type="file" name="imageUpload">
                    <input type="submit" name="submitImage" value = 'Get Hex'>
                </form>

                <section class = 'full-width justify-content-center align-center'>

                    <?php 
                    if (isset($imagename)) {
                    ?>
                            <img style = 'margin: 15px; height: 90px; width: 90px;'src="{{ asset('storage/' . $imagename) }}" alt="" title="">               
                        <?php

								$hex = unpack("H*", file_get_contents('storage/' . $imagename));
								$hex = current($hex);
								$chars = str_split($hex);

								$hex_view_display_list = '<p class = "flex-row flex-wrap justify-content-center align-center">';

								$char_count = 0;
								$line_count = 0;

								foreach ($chars as $char) {
								
									if ($char_count == 0) {
										$hex_view_display_list .= "<span class = 'hex_pair flex-column align_center justify-content-center'>";
										$hex_view_display_list .= $char;
										

										$line_count = $line_count + 1;

										if ($line_count == 30) {
											$hex_view_display_list .= '<br />';
											$line_count = 0;
										}
										
									}
									if ($char_count == 1) {

										$hex_view_display_list .= $char;
										$hex_view_display_list .= "</span>";
										

										$line_count = $line_count + 1;

										

										if ($line_count == 30) {
											$hex_view_display_list .= '<br />';
											$line_count = 0;
										}
										
										
									}
									if ($char_count == 1) {
										$char_count = 0;
									}
									else {
										$char_count =+ 1;
									}
										
									
								
								}
								$hex_view_display_list .= "</p>";

                    } 
                    ?>
                    
                </section>

                <section id  = 'hexidecimal-interpreter' class = 'full-width justify-content-center align-center'>

                    <?php if (isset($hex_view_display_list)) {echo $hex_view_display_list;} ?>

                </section>

            </section>

        </section>

    </section>

</x-layout>

<style>
.MB-3 {
    margin-bottom: 3px !important;
}

#hexidecimal-interpreter {
	border: 1px solid grey;
	padding: 5px;
	margin-top: 30px;
}

.hexidecimal-content {
	letter-spacing: 2px;
}
.hex_pair {
	width: 40px;
	height: 40px;
	font-size: 13px;
	margin-right: 32px;
}
</style>
