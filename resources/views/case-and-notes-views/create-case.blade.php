<x-app-layout :companie_name="$companie_name">
    <section id = 'initiation-header' class = 'flex-row'>
        <ul class = 'flex-row'>
            <li>Company Name: {{auth()->user()->companyConnect->company_name}}</li>
            <li>Signed-In As: <?php echo auth()->user()->name; ?></li>
        </ul>
	</section>
    <section id = 'mainContent-container' class = 'flex-column flex-wrap'>

        <section class = 'MB-10 page-header-strip flex-row align-center full-width'>
            <h2>{{$companie_name}} / Create New Case</h2>
        </section>

        <form action = '/{{$companie_name}}/case/create-case' method = 'POST' enctype='multipart/form-data' class = 'MT-10'>

            @csrf

            <input type = 'hidden' name = 'companieName' value = '{{$companie_name}}'>
            <input type = 'hidden' name = 'companyID' value = '{{auth()->user()->companyConnect->id}}'>

            <section id = 'note_addons'>

                <ul class = 'flex-row'>
                    
                    <li onclick="showChainOfCustodyParams()" class = 'flex-row align-center'>
                        Chain Of Custody Parameters
                        <svg xmlns="http://www.w3.org/2000/svg" class = 'tiny-svg' viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </li>

                    <li onclick="showSaveNote()" class = 'flex-row align-center'>
                        Save
                        <svg xmlns="http://www.w3.org/2000/svg" class = 'tiny-svg' viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                        </svg>
                    </li>
                    @error('signature_input')<li style = 'margin-top: 0px !important;' class="validation_message warning">{{ $message }}</li>@enderror
                </ul>

            </section>

            <section class = 'MT-10 large-grouping-form flex-column'>

                <span class = 'form-column-grouping flex-column'>
                    <input class = 'MR-20 MT-10 thirty-percent-width' type="text" name="caseName_input" value = "{{ old('caseName_input') }}" placeholder = "Case Name">
                    @error('caseName_input')<p class="validation_message warning">{{ $message }}</p>@enderror

                    <textarea style = 'width: 70%;' class = 'MT-10' name = 'caseDescription_input'  placeholder = "Case Description">{{ old('caseDescription_input') }}</textarea>
                    @error('caseDescription_input')<p class="validation_message warning">{{ $message }}</p>@enderror

                    <!-- <span class = 'form-column-grouping flex-row align-center'><label class = 'MB-0 MR-20'>Priority</label><input type="checkbox" name="uniqueId_input" ></span>                  -->


                </span>

            </section>

            <div style = 'display: none;' id="popup2" class="overlay">
                <div class="popup">
                    <h2>Chain Of Custody (Fixed Parameters)</h2>
                    <li class="close" onclick="closeChainOfCustodyParams()">&times;</li>
                    <div class="content flex-column">

                    <ul>
                        <li class = 'flex-row align-center'>
                            <svg xmlns="http://www.w3.org/2000/svg" class = 'pop-up-box-icon' viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                            <!-- Displaying The Current Users Name -->
                            <p><?php echo auth()->user()->name; ?></p>                    
                        </li>
                        <li class = 'flex-row align-center'>
                            <svg xmlns="http://www.w3.org/2000/svg" class = 'pop-up-box-icon' viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                                <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                            </svg>
                            <!-- Displaying The users Company Name -->
                            <p>{{auth()->user()->companyConnect->company_name}}</p>
                        </li>
                        <li class = 'flex-row align-center'>
                            <svg xmlns="http://www.w3.org/2000/svg" class = 'pop-up-box-icon' viewBox="0 0 16 16">
                                <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                            <!-- Displaying the date and time the note was started -->
                            <p><?php  echo date("d/m/y") . ' ' . date("h:i:sa") ?></p>
                        </li>
                        <li class = 'flex-row align-center'>
                            <svg xmlns="http://www.w3.org/2000/svg" class = 'pop-up-box-icon' viewBox="0 0 16 16">
                                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 
                                1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0
                                0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                            </svg>
                            <!-- Display the longitude and latitude gathered -->
                            <p>Lat <span id = 'latitude_show'></span>, Long <span id = 'longitude_show'></span></p>
                        </li>
                    </ul>

                    </div>
                </div>
            </div>
        
            <div style = 'display: none;' id="popup3" class="overlay">
                <div class="popup">
                    <h2>Create Case</h2>
                    <p class = 'warning'>*** Once A Note Has been Saved It Cannot Be Changed And It Will Be Published In The Final Report ***</p>                
                    <li class="close" onclick="closeSaveForm()">&times;</li>
                    <div class="content flex-row full-width align-center">

                    <input class = 'full-width' type = 'text' name = 'signature_input' placeholder = 'Signature'></input>

                    <input class = 'submit-note-button' type = 'submit' value = 'Save Note'></input>
                    
                    </div>
                </div>
            </div>

            <input id = 'latitude_input' type = 'hidden' name = 'latitude' value = ''>
            <input id = 'longitude_input' type = 'hidden' name = 'longitude' value = ''>
        </form>

    </section>


<script>

// The longitude and latitude will be displayed inside two input
// fileds for the user, these variables store them fields.
let latText = document.getElementById("latitude");
let longText = document.getElementById("longitude");

// When the page is loaded run this function
$( document ).ready(function() {
    // This method is used to get the current location of the users device
    navigator.geolocation.getCurrentPosition(function(position) {
        // Getting the longitude and latitude
        let lat = position.coords.latitude;
        $('#latitude_show').text(lat);
        let long = position.coords.longitude;
        $('#longitude_show').text(long);

        // Stores the longitude and latitude positions inside hidden input fields
        // Theses fields will be transfered with the request and stored inside the database
        var s = document.getElementById("longitude_input");
        s.value = long;
        // 
        var s = document.getElementById("latitude_input");
        s.value = lat;

        // displayes the longitude and latitude inside the input fields         
        latText.innerText = lat.toFixed(2) + 'N';
        longText.innerText = long.toFixed(2) + 'W';


    });
});

</script>
</x-layout>
<script>

function showChainOfCustodyParams() {
    var x = document.getElementById("popup2");
    if (x.style.display === "none") {
        x.style.display = "flex";
    } 
    else {
        x.style.display = "none";
    }  
}
function showSaveNote() {
    var x = document.getElementById("popup3");
    if (x.style.display === "none") {
        x.style.display = "flex";
    } 
    else {
        x.style.display = "none";
    }  
}

function closeChainOfCustodyParams() {
    var x = document.getElementById("popup2");
    x.style.display = "none";    
}
function closeSaveForm() {
    var x = document.getElementById("popup3");
    x.style.display = "none";    
}
</script>


<style>
.MB-0 {
    margin-bottom: 0px !important;
}
.validation_message {
    font-size: 11px;
    margin-top: 5px;
}
.MT-10 {
    margin-top: 10px;
}
</style>