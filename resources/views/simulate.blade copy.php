<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta id='token' name="csrf-token" content="{{ csrf_token() }}">
				<title>Laravel</title>

				<!-- Styles --> 
				<style>
	 /* The Modal (background) */
		 .modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
				position: relative;
				background-color: #fefefe;
				/* margin: auto; */
				padding: 0;
				border: 1px solid #888;
				width: 80%;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
				-webkit-animation-name: animatetop;
				-webkit-animation-duration: 0.4s;
				animation-name: animatetop;
				animation-duration: 0.4s
			}

			/* Add Animation */
			@-webkit-keyframes animatetop {
				from {top:-300px; opacity:0} 
				to {top:0; opacity:1}
			}

			@keyframes animatetop {
				from {top:-300px; opacity:0}
				to {top:0; opacity:1}
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

			.modal-body {padding: 2px 16px;}

			.modal-footer {
				padding: 2px 16px;
				background-color: #5cb85c;
				color: white;
			}                   
						.add {
								/* display: flex; */
								/* justify-content: center; */
								padding: 4px;
								position: fixed;
								right: 50px;
								bottom: 40px;
								width: 100px;
								height: 100px;
								cursor:pointer;               
								}
								.add .tooltiptext {
										visibility: hidden;
										/* width: 20px; */
										/* background-color: black; */
										color: black;
										/* text-align: center; */
										/* border-radius: 6px;
										padding: 5px 0; */

										/* Position the tooltip
										position: absolute;
										z-index: 1; */
										}

								.add:hover .tooltiptext {
										visibility: visible;
										color: black;
								}

								.delete .textdelete{
										visibility: hidden;
								}
								.delete:hover .textdelete{
										cursor:pointer;
										visibility: visible;
								}
								.dark-background {
										background-color:rgba(10,10,10,.86); position:fixed;
								}

								/**Loader Style */
								.loader {
										border: 3px solid #f3f3f3; /* Light grey */
										border-top: 3px solid #3498db; /* Blue */
										border-radius: 50%;
										width: 60px;
										height: 60px;
										animation: spin .5s linear infinite; 
									}

								@keyframes spin {
										0% { transform: rotate(0deg); }
										100% { transform: rotate(360deg); }
									}
									article {
										background-color: #fff5f7;
										border-radius: 10px;
										font-size: 1rem;
										width:750px; height:250px; 
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
									/* .notification {
										display:flex;
										flex-flow:row;
										justify-content:center;
									} */
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
												<tbody id="table-body" >  </tbody>
								</table>
								<button id="submit-all-btn" class="btn btn-primary" style="display:none" >Submit All</button>
		</div>

		<!-- The Modal -->
		<div id="myModal" class="modal">

			<!-- Modal content -->
			<div class="modal-content">
				<div class="modal-header">          
					<h2>Add New Simulation</h2><span class="close">&times;</span>
				</div>
			<div class="modal-body">
				<div class="container">
										<div class="row justify-content-center">
												<div>
																<div class="form-row pt-2">
																		<div class="col" id="col-modules">
																				<label for="selectionModule">Choose a Module</label>
																				<select id="selectionModule"  name="moduleValue" class="custom-select" >
							
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
											<svg viewBox="0 0 24 24" width="50" height="50" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<circle  cx="12" cy="12" r="10"></circle>
													<line x1="12" y1="8" x2="12" y2="16"></line>
													<line x1="8" y1="12" x2="16" y2="12"></line>                        
											</svg>                    
								
			</div>

			<!-- <div   id="loaderId" style="display:none align-items: center; justify-content: center;" class="modal"> -->
					<!-- <div class="loader" style="padding: 2px 16px;"></div> -->
			<!-- <div   id="loaderId" style="display:none align-items: center; justify-content: center;" class="modal">
                  <div>
                    <article>
                        <header class="message-header"><p>Simulation are Running !</p> </header> 
                        <section>
                        <img src="https://img.icons8.com/color/80/000000/high-importance--v1.png" width="30px" height="30px"/> 
						<p>Please Do Not Close This page</p>
						<p>To see the effects of the simulation, click the button and wait until the time of simulation is over !</p>
                        <button class="ml-4" onclick="refrechPage()" style="border-radius: 8px; background: #fff5f7; border: solid #ff3860;-webkit-box-shadow: 5px 5px 15px 5px #eabebe;color:#cd0930">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="16" height="16"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M86,166.625c-24.0542,0 -45.90035,-10.55005 -61.5158,-29.7044l-0.7525,-0.92235l-18.3567,18.3567v-56.52995h54.56055l-18.31585,20.3519l0.5074,0.7052c9.9588,13.74065 26.359,21.9429 43.8729,21.9429c21.70425,0 42.2389,-14.99195 50.20465,-36.55h27.99945c-8.5484,36.20815 -41.22195,62.35 -78.2041,62.35z" fill="#ff3860"></path><path d="M57.52325,98.9l-16.1207,17.91165l-1.16315,1.29215l1.0191,1.40825c10.15875,14.018 26.8836,22.38795 44.7415,22.38795c21.91065,0 42.6474,-14.9554 50.94855,-36.55h25.88385c-4.1882,16.46255 -13.6224,31.36635 -26.7675,42.2045c-14.08035,11.60355 -31.8587,17.9955 -50.0649,17.9955c-23.7231,0 -45.2747,-10.40815 -60.68375,-29.3088l-1.50285,-1.8447l-1.68345,1.68345l-15.67995,15.67995v-52.8599h51.07325M62.35,96.75h-58.05v60.2l19.35,-19.35c14.9683,18.35885 36.81015,30.1 62.35,30.1c39.10635,0 71.52835,-27.7995 79.55,-64.5h-30.1c-7.21755,20.3863 -26.5912,36.55 -49.45,36.55c-17.49025,0 -33.46905,-8.3463 -43,-21.5l19.35,-21.5z" fill="#4e7ab5"></path><g><path d="M112.06445,74.175l18.31585,-20.3519l-0.5074,-0.7052c-9.9588,-13.74065 -26.359,-21.9429 -43.8729,-21.9429c-21.70425,0 -42.2389,14.99195 -50.20465,36.55h-27.99945c8.5484,-36.20815 41.22195,-62.35 78.2041,-62.35c24.05205,0 45.90035,10.55005 61.5158,29.7044l0.7525,0.92235l18.3567,-18.3567v56.52995z" fill="#ff3860"></path><path d="M86,6.45c23.7231,0 45.2747,10.40815 60.68375,29.3088l1.50285,1.8447l1.68345,-1.68345l15.67995,-15.67995v52.8599h-51.07325l16.1207,-17.91165l1.16315,-1.29215l-1.0191,-1.40825c-10.15875,-14.018 -26.8836,-22.38795 -44.7415,-22.38795c-21.91065,0 -42.6474,14.9554 -50.94855,36.55h-25.88385c4.1882,-16.46255 13.6224,-31.36635 26.7675,-42.2045c14.08035,-11.60355 31.8587,-17.9955 50.0649,-17.9955M86,4.3c-39.10635,0 -71.52835,27.7995 -79.55,64.5h30.1c7.21755,-20.3863 26.5912,-36.55 49.45,-36.55c17.49025,0 33.46905,8.3463 43,21.5l-19.35,21.5h58.05v-60.2l-19.35,19.35c-14.9683,-18.35885 -36.81015,-30.1 -62.35,-30.1z" fill="#4e7ab5"></path></g></g></g></svg>
                            Update
                        </button>
                        </section>
                    </article>
                  </div>
    		</div> -->

			<div  id="loaderId" style="display:none" class="notification modal">				
					<article>
							<header class="message-header"><p>Simulation are Running !</p> </header> 
							<section>
							<img src="https://img.icons8.com/color/80/000000/high-importance--v1.png" width="30px" height="30px"/>
							<p>Please Do Not Close This page, Simulation are Running<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="16" height="16"viewBox="0 0 172 172"style="animation: spin .5s linear infinite; fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M86,166.625c-24.0542,0 -45.90035,-10.55005 -61.5158,-29.7044l-0.7525,-0.92235l-18.3567,18.3567v-56.52995h54.56055l-18.31585,20.3519l0.5074,0.7052c9.9588,13.74065 26.359,21.9429 43.8729,21.9429c21.70425,0 42.2389,-14.99195 50.20465,-36.55h27.99945c-8.5484,36.20815 -41.22195,62.35 -78.2041,62.35z" fill="#ff3860"></path><path d="M57.52325,98.9l-16.1207,17.91165l-1.16315,1.29215l1.0191,1.40825c10.15875,14.018 26.8836,22.38795 44.7415,22.38795c21.91065,0 42.6474,-14.9554 50.94855,-36.55h25.88385c-4.1882,16.46255 -13.6224,31.36635 -26.7675,42.2045c-14.08035,11.60355 -31.8587,17.9955 -50.0649,17.9955c-23.7231,0 -45.2747,-10.40815 -60.68375,-29.3088l-1.50285,-1.8447l-1.68345,1.68345l-15.67995,15.67995v-52.8599h51.07325M62.35,96.75h-58.05v60.2l19.35,-19.35c14.9683,18.35885 36.81015,30.1 62.35,30.1c39.10635,0 71.52835,-27.7995 79.55,-64.5h-30.1c-7.21755,20.3863 -26.5912,36.55 -49.45,36.55c-17.49025,0 -33.46905,-8.3463 -43,-21.5l19.35,-21.5z" fill="#4e7ab5"></path><g><path d="M112.06445,74.175l18.31585,-20.3519l-0.5074,-0.7052c-9.9588,-13.74065 -26.359,-21.9429 -43.8729,-21.9429c-21.70425,0 -42.2389,14.99195 -50.20465,36.55h-27.99945c8.5484,-36.20815 41.22195,-62.35 78.2041,-62.35c24.05205,0 45.90035,10.55005 61.5158,29.7044l0.7525,0.92235l18.3567,-18.3567v56.52995z" fill="#ff3860"></path><path d="M86,6.45c23.7231,0 45.2747,10.40815 60.68375,29.3088l1.50285,1.8447l1.68345,-1.68345l15.67995,-15.67995v52.8599h-51.07325l16.1207,-17.91165l1.16315,-1.29215l-1.0191,-1.40825c-10.15875,-14.018 -26.8836,-22.38795 -44.7415,-22.38795c-21.91065,0 -42.6474,14.9554 -50.94855,36.55h-25.88385c4.1882,-16.46255 13.6224,-31.36635 26.7675,-42.2045c14.08035,-11.60355 31.8587,-17.9955 50.0649,-17.9955M86,4.3c-39.10635,0 -71.52835,27.7995 -79.55,64.5h30.1c7.21755,-20.3863 26.5912,-36.55 49.45,-36.55c17.49025,0 33.46905,8.3463 43,21.5l-19.35,21.5h58.05v-60.2l-19.35,19.35c-14.9683,-18.35885 -36.81015,-30.1 -62.35,-30.1z" fill="#4e7ab5"></path></g></g></g></svg></p>
							<p>To see the effects of the simulation, click the button and wait until the time of simulation is over !</p>
							<button class="ml-4" onclick="window.open('/dashboard', '_blank');" style="border-radius: 8px; background: #fff5f7; border: solid #ff3860;-webkit-box-shadow: 5px 5px 15px 5px #eabebe;color:#cd0930">
								See Effects
							</button>
							</section>
						</article>			
			</div>


					<!-- <section>
							<article>
									<h1>Important !</h1>
									<p>Please Do not Close this Window, simulations are runing ...</p>
									<p>In order to see the effects, click this button, and wait until the time of
										simulation over.
									</p>
							</article>
					</section> -->
			<!-- </div>  -->
	</body>
</html>


<script>
// Global variables
var modules = @json($modules);
console.log(modules);
// At the begining, all modules are not selected, we add all the names of the modules to The unselectedmodules array
var unselectedModules= []; 
for(var k= 0; k<modules.length; k++) { unselectedModules.push(modules[k].name); }

var data=[]; // this variable contains list of simulations, each simulation is an object contains
						// the name of the module, the action  and the time  { name: "..", action:"..", time:".." }

function getUnselectedModules(){

				var select_elemet = document.getElementById("selectionModule");

			// Delete All elements : 
				select_elemet.parentNode.removeChild(select_elemet);
				select_elemet = document.createElement("SELECT");
				select_elemet.setAttribute('id','selectionModule');
				select_elemet.setAttribute('class','custom-select');

				document.getElementById("col-modules").appendChild(select_elemet);

				// Inser the message Text :
				var e = document.createElement("OPTION");
				e.setAttribute('selected',true);        
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
			 if(module.selectedIndex == 0 || action.selectedIndex == 0 ||time.selectedIndex == 0 ){
					// Invalid Inputs
						alert("Please Insert Valide Values");
			 }   
			 else {
				 //  Valide inputs, we could add it to the table.  
				 //  We should first remove the module from unselecetedModules list.
					unselectedModules = unselectedModules.filter(e => e !== module.value);

				//We then update the view : remove the 'Submit All' button if no module selected.
					updateView();


				var label_action;
				var label_time;

				time.value<"60" ? label_time=time.value+" seconds" : label_time="1 minute";
				if(action.value=="generate") { label_action="Generate Value for Module" }
				action.value=="on-off" ? label_action="Switch The Module ON/OFF" : label_action="Dysfunction of A Variable Of the Module";
				 var row = '<tr>';
					row+='<td>'+ module.value +'</td>';
					row+='<td>'+ label_action+'</td>';
					row+='<td>'+ label_time+'</td>';
					row+='<td><div class="delete" onclick="deleteSimulationItem()"><img  style="cursor:pointer;" src="/images/delete.png" width="25px" height="30px"/><span class="textdelete">Delete</span></div></td>';
					row+='</tr>';
					tbody.innerHTML+=row;
					modal.style.display = "none";

					//  we add the module selected to data array
					var obj = { "name": module.value, "action": action.value, "time": time.value };
					//var moduleJSON = JSON.stringify(obj);
					data.push(obj);
			 }
	}

function deleteSimulationItem(){
	// console.log(event.target); // span or img
	// console.log(event.target.parentElement); // div
	// console.log(event.target.parentElement.parentElement); // td
	// console.log(event.target.parentElement.parentElement.parentElement.rowIndex); //tr

	var tr_removed = event.target.parentElement.parentElement.parentElement; //<tr>
	// Add the module to unseletedModules:
	unselectedModules.push(tr_removed.firstChild.innerText);

	//  we remove the module from the data array
		for (var i=0; i < data.length; i++) {
					console.log();
					if (JSON.parse(data[i])['name'] == tr_removed.firstChild.innerText){
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
function updateView(){
				if(unselectedModules.length == modules.length){
					 // No Module selected  --> we don't add the submit all button 
					 document.getElementById("submit-all-btn").style.display = "none"; 
				}
		else { 
					document.getElementById("submit-all-btn").style.display = "block";
			}
}
	 
// Method to Send the Simulations and redirect the user :
document.getElementById("submit-all-btn").onclick = function () {

			data.forEach(function (e) {
				setTimeout(() => {
					sendUpdate(e.name,e.action);
				}, parseInt(e.time)*100);
		});
		

document.getElementById('loaderId').style.display = "flex";
}

function sendUpdate(name,action){
				var obj = { "name": name, "action": action};
				var moduleJSON = JSON.stringify(obj);

				// Sendind a Post Request :
				var xhr = new XMLHttpRequest();
				xhr.open("POST", '/api/simulate_', true);

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

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		modal.style.display = "block";
		onclick=getUnselectedModules();
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}

</script>