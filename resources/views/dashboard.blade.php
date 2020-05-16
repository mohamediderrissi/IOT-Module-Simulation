        <!-- Styles -->
        <style>
.module-layout {
    background: #FFFFFF;
    border-radius: 5px;
    box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);
    width: 290px;
    height: 290px;
}

/* The Modal (background) */
.modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
}

article {
    background-color: #fff5f7;
    border-radius: 10px;
    font-size: 1rem;
    width: 550px;
    height: 130px;
}

.message-header p {
    border: 8px solid #ff3860;
    background-color: #ff3860;
    color: #ffffff;
    border-radius: 10px 10px 0px 0px;
}

section {
    border: 8px solid #fff5f7;
    color: #cd0930;
}

.on {
    background-color: #43ec43;
    /* green */
    width: 16px;
    height: 16px;
    border-radius: 50%;
}

.off {
    background-color: red;
    width: 16px;
    height: 16px;
    border-radius: 50%;
}

/**Loader Style */
.loader {
    border: 3px solid #f3f3f3;
    /* Light grey */
    border-top: 3px solid #3498db;
    /* Blue */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin .5s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }


    100% {
        transform: rotate(360deg);
    }
}
        </style>
        </head>
        @extends('layouts.nav-bar')
        @section('title', 'Dashboard')
        @section('content')

        <div class="container mb-4 mt-4">
            @foreach($modules as $module)
            <div class="module-layout mt-2 mr-2  d-inline-block" id="{{ $module->id }}">
                <div class="text-center py-2">
                    <h3 class="h2"> {{ $module->name }} </h3>
                </div>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">State :</th>
                            <td></td>
                            <td>
                                @if ($module->working_state!=0)
                                <img id="{{ $module->id.'_working_state' }}" src="/images/on.png"" alt=" on"
                                    width="50px" height="25px" />
                                @else
                                <img id="{{ $module->id.'_working_state' }}" src="/images/off.png"" alt=" off"
                                    width="50px" height="25px" />
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th scope="row"><small>Number of Data Sent <img
                                        src="/images/database.png" width="15px"
                                        height="20px" /> :</th></small>
                            <td>
                                <div class="{{ $module->number_data_sent==null ? 'off': 'on' }}"></div>
                            </td>
                            <td>
                                <p id="{{ $module->id.'_number_data_sent' }}">{{ $module->number_data_sent }}</p>
                            </td>
                            <!-- <td><p class="">10kb</p></td>  -->
                        </tr>
                        <tr>
                            <th scope="row"><small>Working Duration <img
                                        src="/images/clock.png" width="20px"
                                        height="20px" />:</th></small>
                            <td>
                                <div class="{{ $module->working_duration==null ? 'off': 'on' }}"></div>
                            </td>
                            <td>
                                <p id="{{ $module->id.'_working_duration' }}">{{ $module->working_duration }}</p>
                            </td>
                            <!-- <td><p>1h:30min</p></td> -->
                        </tr>
                        <tr>
                            <th scope="row"><small>Temperature<img
                                        src="/images/temperature.png" width=""
                                        height="25px" />:</th></small>
                            <td>
                                <div class="{{ $module->temperature==null ? 'off': 'on' }}"></div>
                            </td>
                            <!-- <td><p>28°C</p></td> -->
                            <td>
                                <p id="{{ $module->id.'_temperature' }}">{{ $module->temperature }}</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endforeach
            <div id="loaderId" style="display:none align-items: center; justify-content: center;" class="modal">
                <div class="loader" style="padding: 2px 16px;"></div>
            </div>
        </div>
        @endsection
        <script src="/js/app.js"></script>
        <script>
// Update The dashbord if any change on the server:
var url = "/api/simulate";

function waitBeforeCheck(timems) {
    setTimeout(function() {
        checkAnychanges();
    }, timems);
}

var jsonResponse;

function checkAnychanges() {
    var oReq = new XMLHttpRequest();
    oReq.open("GET", url, true);
    oReq.onload = function(e) {
        jsonResponse = JSON.parse(oReq.response);
        if (jsonResponse.length != 0) { //  some modules changed  --> Update View
            console.log(jsonResponse);
            setTimeout(() => {
                document.getElementById("loaderId").style.display = 'none';
            }, 4000);
            updateView();
            waitBeforeCheck(29000);
        } else { // We check for changes every 30 seconds.
            waitBeforeCheck(29000);
        }
    }
    oReq.send();
}

function updateView() {
    document.getElementById("loaderId").style.display = 'flex';
    for (let i = 0; i < jsonResponse.length; i++) {
        var moduleChanged = jsonResponse[i];
        console.log('upadteView ::' + moduleChanged);
        var id = moduleChanged.id;
        // we update the value of modules:
        var state = document.getElementById(id + '_working_state');
        var numberDataSent = document.getElementById(id + '_number_data_sent');
        var workingDuration = document.getElementById(id + '_working_duration');
        var temperature = document.getElementById(id + '_temperature');

        // Update  state :
        if (moduleChanged.working_state == "1") {
            state.setAttribute("src", "/images/on.png");
        } else {
            state.setAttribute("src", "/images/off.png");
        }
        // update number of Data Sent :
        if (moduleChanged.number_data_sent != null) {
            numberDataSent.parentNode.parentNode.children[1].firstElementChild.setAttribute("class", "on"); 
            numberDataSent.innerText = moduleChanged.number_data_sent;
        } else {
            numberDataSent.parentNode.parentNode.children[1].firstElementChild.setAttribute("class", "off");
            numberDataSent.innerText = " ";
        }
        // update working Duration
        if (moduleChanged.working_duration != null) {
            workingDuration.parentNode.parentNode.children[1].firstElementChild.setAttribute("class", "on");
            workingDuration.innerText = moduleChanged.working_duration;
        } else {
            workingDuration.parentNode.parentNode.children[1].firstElementChild.setAttribute("class", "off");
            workingDuration.innerText = " ";
        }
        // update temperature : 
        if (moduleChanged.temperature != null) {
            temperature.parentNode.parentNode.children[1].firstElementChild.setAttribute("class", "on");
            temperature.innerText = moduleChanged.temperature;
        } else {
            temperature.parentNode.parentNode.children[1].firstElementChild.setAttribute("class", "off");
            temperature.innerText = " ";
        }
    }
}
waitBeforeCheck(29000);
        </script>