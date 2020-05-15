        <!-- Styles -->
        <style>
.module-layout {
    background: #FFFFFF;
    border-radius: 15px;
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
        </style>
        </head>
        @extends('layouts.nav-bar')
        @section('title', 'Dashboard')
        @section('content')

        <div class="container mb-4 mt-4">
            @foreach($modules as $module)
            <div class="module-layout mt-2 mr-2  d-inline-block ">
                <div class="text-center py-2">
                    <h3 class="h2"> {{ $module->name }} </h3>
                </div>
                <table class="table table-sm table-borderless">
                    <tbody>
                        <tr>
                            <th scope="row">State :</th>
                            <td></td>
                            @if ($module->working_state!=0)
                            <td>
                                <img src="/images/on.png"" alt=" on" width="50px" height="25px">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Number of Data Sent <img
                                    src="https://img.icons8.com/ios-filled/100/000000/database.png" width="15px"
                                    height="20px" /> :</th>
                            <td></td>
                            <td>
                                <p class="">{{ $module->number_data_sent }}</p>
                            </td>
                            <!-- <td><p class="">10kb</p></td>  -->
                        </tr>
                        <tr>
                            <th scope="row">Working Duration <img
                                    src="https://img.icons8.com/material-rounded/64/000000/clock.png" width="20px"
                                    height="20px" />:</th>
                            <td></td>
                            <td>
                                <p class="">{{ $module->working_duration }}</p>
                            </td>
                            <!-- <td><p>1h:30min</p></td> -->
                        </tr>
                        <tr>
                            <th scope="row">Temperature<img
                                    src="https://img.icons8.com/ios-filled/50/000000/temperature.png" width=""
                                    height="25px" />:</th>
                            <td></td>
                            <!-- <td><p>28°C</p></td> -->
                            <td>
                                <p class="">{{ $module->temperature }}</p>
                            </td>
                        </tr>
                        @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td>
                            <img src="/images/off.png"" alt=" off" width="50px" height="25px" />
                        </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
        <script src="/js/app.js"></script>

        <div id="notificationId" style="display:none align-items: center; justify-content: center;" class="modal">
            <div>
                <article>
                    <header class="message-header">
                        <p>Some Changes Happened !</p>
                    </header>
                    <section>
                        <img src="https://img.icons8.com/color/80/000000/high-importance--v1.png" width="30px"
                            height="30px" /> Please Update The page - Some Modules Changed !
                        <button class="ml-4" onclick="refrechPage()"
                            style="border-radius: 8px; background: #fff5f7; border: solid #ff3860;-webkit-box-shadow: 5px 5px 15px 5px #eabebe;color:#cd0930">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16"
                                viewBox="0 0 172 172" style=" fill:#000000;">
                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                                    stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray=""
                                    stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none"
                                    text-anchor="none" style="mix-blend-mode: normal">
                                    <path d="M0,172v-172h172v172z" fill="none"></path>
                                    <g>
                                        <path
                                            d="M86,166.625c-24.0542,0 -45.90035,-10.55005 -61.5158,-29.7044l-0.7525,-0.92235l-18.3567,18.3567v-56.52995h54.56055l-18.31585,20.3519l0.5074,0.7052c9.9588,13.74065 26.359,21.9429 43.8729,21.9429c21.70425,0 42.2389,-14.99195 50.20465,-36.55h27.99945c-8.5484,36.20815 -41.22195,62.35 -78.2041,62.35z"
                                            fill="#ff3860"></path>
                                        <path
                                            d="M57.52325,98.9l-16.1207,17.91165l-1.16315,1.29215l1.0191,1.40825c10.15875,14.018 26.8836,22.38795 44.7415,22.38795c21.91065,0 42.6474,-14.9554 50.94855,-36.55h25.88385c-4.1882,16.46255 -13.6224,31.36635 -26.7675,42.2045c-14.08035,11.60355 -31.8587,17.9955 -50.0649,17.9955c-23.7231,0 -45.2747,-10.40815 -60.68375,-29.3088l-1.50285,-1.8447l-1.68345,1.68345l-15.67995,15.67995v-52.8599h51.07325M62.35,96.75h-58.05v60.2l19.35,-19.35c14.9683,18.35885 36.81015,30.1 62.35,30.1c39.10635,0 71.52835,-27.7995 79.55,-64.5h-30.1c-7.21755,20.3863 -26.5912,36.55 -49.45,36.55c-17.49025,0 -33.46905,-8.3463 -43,-21.5l19.35,-21.5z"
                                            fill="#4e7ab5"></path>
                                        <g>
                                            <path
                                                d="M112.06445,74.175l18.31585,-20.3519l-0.5074,-0.7052c-9.9588,-13.74065 -26.359,-21.9429 -43.8729,-21.9429c-21.70425,0 -42.2389,14.99195 -50.20465,36.55h-27.99945c8.5484,-36.20815 41.22195,-62.35 78.2041,-62.35c24.05205,0 45.90035,10.55005 61.5158,29.7044l0.7525,0.92235l18.3567,-18.3567v56.52995z"
                                                fill="#ff3860"></path>
                                            <path
                                                d="M86,6.45c23.7231,0 45.2747,10.40815 60.68375,29.3088l1.50285,1.8447l1.68345,-1.68345l15.67995,-15.67995v52.8599h-51.07325l16.1207,-17.91165l1.16315,-1.29215l-1.0191,-1.40825c-10.15875,-14.018 -26.8836,-22.38795 -44.7415,-22.38795c-21.91065,0 -42.6474,14.9554 -50.94855,36.55h-25.88385c4.1882,-16.46255 13.6224,-31.36635 26.7675,-42.2045c14.08035,-11.60355 31.8587,-17.9955 50.0649,-17.9955M86,4.3c-39.10635,0 -71.52835,27.7995 -79.55,64.5h30.1c7.21755,-20.3863 26.5912,-36.55 49.45,-36.55c17.49025,0 33.46905,8.3463 43,21.5l-19.35,21.5h58.05v-60.2l-19.35,19.35c-14.9683,-18.35885 -36.81015,-30.1 -62.35,-30.1z"
                                                fill="#4e7ab5"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            Update
                        </button>
                    </section>
                </article>
            </div>
        </div>
        @endsection
        <script>
// This function to refrech the page, when click the 'Update' button.
function refrechPage() {
    window.location.replace("/dashboard");
}
// Update The dashbord if any change on the server:
var url = "/api/simulate";

function waitBeforeCheck(timems) {
    setTimeout(function() {
        checkAnychanges();
    }, timems);
}

function checkAnychanges() {
    var oReq = new XMLHttpRequest();
    oReq.open("GET", url, true);
    oReq.onload = function(e) {
        console.log(oReq.response);
        if (JSON.parse(oReq.response).changed == "true_") { // True some changes happned --> Update View
            console.log(oReq.response);
            //updateView();
        } else { // We check for changes every 21 seconds.
            //waitBeforeCheck(21);
        }
    }
    oReq.send();
}

function updateView() {
    document.getElementById('notificationId').style.display = "flex";
}

waitBeforeCheck(20);
        </script>