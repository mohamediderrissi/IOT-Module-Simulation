<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id='token' name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Styles -->
    <style>
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

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        /* margin: auto; */
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .modal-body {
        padding: 2px 16px;
    }

    .modal-footer {
        padding: 2px 16px;
        background-color: #5cb85c;
        color: white;
    }

    .add {
        padding: 4px;
        position: fixed;
        right: 50px;
        bottom: 40px;
        width: 100px;
        height: 100px;
        cursor: pointer;
        }

    .add .tooltiptext {
        visibility: hidden;
        color: black;
    }

    .add:hover .tooltiptext {
        visibility: visible;
        color: black;
    }

    .delete .textdelete {
        visibility: hidden;
    }

    .delete:hover .textdelete {
        cursor: pointer;
        visibility: visible;
    }

    .dark-background {
        background-color: rgba(10, 10, 10, .86);
        position: fixed;
    }

 
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    article {
        background-color: #fff5f7;
        border-radius: 10px;
        font-size: 1rem;
        width: 530px;
        height: 220px;
    }

    .message-header-danger p {
        border: 8px solid #ff3860;
        background-color: #ff3860;
        color: #ffffff;
        border-radius: 10px 10px 0px 0px;
    }
    .message-header-success p {
        border: 8px solid green;
        background-color: green;
        color: #ffffff;
        border-radius: 10px 10px 0px 0px;
    }

    section {
        border: 8px solid #fff5f7;
        color: #cd0930;
    }

    #notificationId {
        align-items: center;
        justify-content: center;
		-webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    .seeEffectBtn-danger {		
        position: relative;		
        bottom: 0px;
        border-radius: 8px;
        background: #fff5f7;
        border: solid #ff3860;
        -webkit-box-shadow: 5px 5px 15px 5px #eabebe;
        color: #cd0930;
    }

    .seeEffectBtn-success {		
        position: relative;		
        bottom: 0px;
        border-radius: 8px;
        background: #fff5f7;
        border: solid #008000;
        -webkit-box-shadow: 5px 5px 15px 5px #eabebe;
        color: #008000;
    }
    </style>
</head>

<body>
    @extends('layouts.nav-bar')
    @section('title', 'Simulation')
    @section('content')
    <div class="container pt-5 mt-5">
        <table class="table" onchange="test()">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Module</th>
                    <th scope="col">Action</th>
                    <th scope="col">Time</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="table-body"> </tbody>
        </table>
        <button id="submit-all-btn" class="btn btn-primary" style="display:none">Submit All</button>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Simulation</h2><span class="close" onclick="closeModal(0)">&times;</span>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div>
                            <div class="form-row pt-2">
                                <div class="col" id="col-modules">
                                    <label for="selectionModule">Choose a Module</label>
                                    <select id="selectionModule" name="moduleValue" class="custom-select">

                                    </select>
                                </div>
                                <div class="col">
                                    <label for="">Choose an Action to Simulate</label>
                                    <select id="selectionAction" name="actionValue" class="custom-select">
                                        <option seleted>Choose Action</option>
                                        <option value="on-off">Simulate Switch ON/OFF</option>
                                        <option value="variable">Simulate Dysfunction Of A Variable</option>
                                        <option value="generate">Generate Values for Module</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="selectionTime">Choose The time Before The Action is triggered</label>
                                    <select id="selectionTime" name="timeValue" class="custom-select">
                                        <option seleted>Choose The time Module</option>
                                        <option value="30">30 seconds</option>
                                        <option value="40">40 seconds</option>
                                        <option value="45">45 seconds</option>
                                        <option value="50">50 seconds</option>
                                        <option value="60">1 minute</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addNewSimulation">Submit</button>
        </div>
    </div>

    <div class="add" id="new">
        <span class="tooltiptext">Add Simulation</span>
        <svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="2" fill="none"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="16"></line>
            <line x1="8" y1="12" x2="16" y2="12"></line>
        </svg>

    </div>


    <div id="notificationId" style="display:none justify-content: center; align-items: center;" class="modal">
        <article>
            <header class="message-header-danger">
                <p "display:flex;justify-content:space-between;">Simulations are Running <img class="ml-2"
                        src="/images/update.png" alt="update" style="animation: spin .5s linear infinite;">
                        </p>
            </header>
            <section>
                <div style="display:flex;flex-direction:column;">
                    <div style="display:flex; align-items: flex-start;">
                        <img src="images/attention.png"
                            style="margin-right: 10px" />
                        <p>Please Do Not Close This page: Simulations are Running.
                            To see the effects of the Simulations, Click the button and Wait until the Time of
                            Simulations is Over ! <i>Dashbord will be updated</i></p>
                    </div>
                    <button class="ml-4 seeEffectBtn-danger" onclick="window.open('/dashboard', '_blank');">
                        See Effects
                    </button>
                </div>
            </section>
        </article>
    </div>
</body>
</html>


<script>
// Global variables
var modules = @json($modules);
console.log(modules);
// At the begining, all modules are not selected, we add all the names of the modules to The unselectedmodules array
var unselectedModules = [];
for (var k = 0; k < modules.length; k++) {
    unselectedModules.push(modules[k].name);
}
/**
*   the variable data is an array that contains list of simulations, each simulation is an object contains
*   the name of the module, the action  and the time  { name: "..", action:"..", time:".." }
*/
var data = [];
function getUnselectedModules() {

    var select_elemet = document.getElementById("selectionModule");

    // Delete All elements : 
    select_elemet.parentNode.removeChild(select_elemet);
    select_elemet = document.createElement("SELECT");
    select_elemet.setAttribute('id', 'selectionModule');
    select_elemet.setAttribute('class', 'custom-select');

    document.getElementById("col-modules").appendChild(select_elemet);

    // Insert the message Text :
    var e = document.createElement("OPTION");
    e.setAttribute('selected', true);
    var msg = document.createTextNode("Choose A Module");
    e.appendChild(msg);
    select_elemet.appendChild(e);

    for (let i = 0; i < unselectedModules.length; i++) {
        var node = document.createElement("OPTION");
        var textnode = document.createTextNode(unselectedModules[i]);
        node.appendChild(textnode);
        select_elemet.appendChild(node);
    }
}

var addNewSim = document.getElementById("addNewSimulation");
// Add new Simulation
addNewSim.onclick = function() {
    var tbody = document.getElementById("table-body");
    var module = document.getElementById("selectionModule"); // module selected
    var action = document.getElementById("selectionAction");
    var time = document.getElementById("selectionTime");

    //console.log(module.value);

    /** TO-DO : validation :  All inputs are filled.
     */
    if (module.selectedIndex == 0 || action.selectedIndex == 0 || time.selectedIndex == 0) {
        // Invalid Inputs
        alert("Please Insert Valide Values");
    } else {
        //  Valide inputs, we could add it to the table.  
        //  We should first remove the module from unselecetedModules list.
        unselectedModules = unselectedModules.filter(e => e !== module.value);

        //We then update the view : remove the 'Submit All' button if no module selected.
        updateView();


        var label_action;
        var label_time;

        time.value < "60" ? label_time = time.value + " seconds" : label_time = "1 minute";
        if (action.value == "generate") {
            label_action = "Generate Value for Module";
        }
        else if(action.value == "on-off") {
            label_action = "Switch The Module ON/OFF";
        }
        else if(action.value == "variable") {
            label_action = "Dysfunction of A Variable Of the Module";
        }
        var row = '<tr>';
        row += '<td>' + module.value + '</td>';
        row += '<td>' + label_action + '</td>';
        row += '<td>' + label_time + '</td>';
        row +=
            '<td><div class="delete" onclick="deleteSimulationItem()"><img  style="cursor:pointer;" src="/images/delete.png" width="25px" height="30px"/><span class="textdelete">Delete</span></div></td>';
        row += '</tr>';
        tbody.innerHTML += row;
        modal.style.display = "none";

        //  we add the module selected to data array
        var obj = {
            "name": module.value,
            "action": action.value,
            "time": time.value
        };
        //var moduleJSON = JSON.stringify(obj);
        data.push(obj);
    }
}

function deleteSimulationItem() {
    // console.log(event.target); // span or img
    // console.log(event.target.parentElement); // div
    // console.log(event.target.parentElement.parentElement); // td
    // console.log(event.target.parentElement.parentElement.parentElement.rowIndex); //tr

    var tr_removed = event.target.parentElement.parentElement.parentElement; //<tr>
    // Add the module to unseletedModules:
    unselectedModules.push(tr_removed.firstChild.innerText);

    //  we remove the module from the data array
    for (var i = 0; i < data.length; i++) {
        console.log();
        if (data[i].name == tr_removed.firstChild.innerText) {
            data.splice(i, 1);
        }
    }
    //console.log(data);

    //We update the view : add the 'Submit All' button.
    updateView();

    tr_removed.parentNode.removeChild(tr_removed);
}

// updateView by adding or removing the 'Submit All' Button.
updateView(); // At the begining we call the method
function updateView() {
    if (unselectedModules.length == modules.length) {
        // No Module selected  --> we don't add the submit all button 
        document.getElementById("submit-all-btn").style.display = "none";
    } else {
        document.getElementById("submit-all-btn").style.display = "block";
    }
}

// Method to Send the Simulations and redirect the user :
document.getElementById("submit-all-btn").onclick = function() {
    let maxtimeOfSimulation = 0;
    data.forEach(function(e,index,data) {
        if (maxtimeOfSimulation < e.time) { maxtimeOfSimulation=e.time;     }
        if (index === data.length-1) { console.log(maxtimeOfSimulation); }
        setTimeout(() => {
            sendUpdate(e.name, e.action);
        }, parseInt(e.time) * 1000);
    });

    document.getElementById('notificationId').style.display = "flex";

    // remove "submit all" button :
        var submitAll = document.getElementById("submit-all-btn");
        submitAll.remove();

    // Remove delete buttons :
    var deletebuttons = document.getElementsByClassName('delete');
    for(deleteBtn of deletebuttons) {
         deleteBtn.style.display="none";        
    }

    // Remove "Add Simulation" button : 
    document.getElementById("new").remove();

    // Wait for the Max time of simulation Before update the Notification.
    setTimeout(() => { updateNotification(); }, maxtimeOfSimulation*1000);
     
}

function updateNotification() {
    var elm = document.getElementById('notificationId');
    var header = elm.firstElementChild.children[0];
    var section = elm.firstElementChild.children[1];

    var headerHtml = '<header class="message-header-success"><p "display:flex;justify-content:space-between;">'
    +'Simulations are Done Successfully'
    +'<img class="ml-2" src="/images/success.svg" style="width: 23px;" alt="success"><span class="close" onclick="closeModal(1)">'
    +'&times;</span></p>'
    +'</header>';

    var sectionHtml = '<section>'
                    +'<div style="display:flex;flex-direction:column;">'
                    +'<div style="display:flex; align-items: flex-start;">'
                    +'<img src="/images/success.svg" style="width: 50px; margin-right: 10px" />'
                    +'<p>You Can Now Close This page If you want.'
                    +'Click the button to See The Dashbord !</p></div>'
                    +'<button class="ml-4 seeEffectBtn-success" onclick="window.open(\'/dashboard\', \'_blank\');">See Effects</button>'
                    +'</div></section>';
    header.innerHTML=headerHtml;
    section.innerHTML=sectionHtml;
   
}

function sendUpdate(name, action) {
    var obj = {
        "name": name,
        "action": action
    };
    var moduleJSON = JSON.stringify(obj);

    // Sendind a Post Request :
    var xhr = new XMLHttpRequest();
    xhr.open("POST", '/api/simulate', true);

    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(xhr.response);
        }
    }
    // csrf-protection
    xhr.setRequestHeader('X-CSRF-TOKEN', document.getElementById('token').getAttribute('content'));
    xhr.send(moduleJSON);

}





// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("new");


// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    onclick = getUnselectedModules();
}

// When the user clicks on <span> (x), close the modal

function closeModal(e) {
    if(e==0) {
        modal.style.display = "none";
    }else {
        document.getElementById('notificationId').style.display = "none";
    }
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>