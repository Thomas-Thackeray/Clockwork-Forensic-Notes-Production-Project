

<x-app-layout :caseID="$caseID" :caseName="$caseName" :companie_name="$companie_name">

<section id = 'initiation-header' class = 'flex-row'>
    <ul class = 'flex-row'>
        <li>Company Name: {{$companie_name}}</li>
        <li>Signed-In As: {{ Auth::user()->name }}</li>
        <li>Case Name: {{$caseName}}</li>
    </ul>
</section>

    <section id = 'mainContent-container' class = 'flex-column'>

    <section class = 'flex-column full-width'>
                <form enctype="multipart/form-data" action = '/case/{{$caseName}}/hex-interpreter/get-content' method = 'POST'>
                @csrf
                    <input type="file" name="imageUpload">
                    <input type="submit" name="submitImage" value = 'Get Metadata'>
                </form>

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
</style>