<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Module;
use App\History;

class SimulationController extends Controller
{
    
    public function show(Request $request)
    {
        $module = new Module();
        $modules = module::all();
        return view("simulate", ["modules"=>$modules]);
    }

    public function getStatus(Request $request)
    {
        /**
         * Updated Modules in the last 30 seconds  : now - update_at<=30; <==> update_at >= now -30;
         * Timezone : UTC.
         */

       $date =  date_create();
       $date->modify('-30 seconds');
       $formatted_date = $date->format('Y-m-d H:i:s'); // Date like : 2020-05-14 20:39:18
       
       $updatedModules = Module::select()->where('updated_at','>', $formatted_date)->get();
        return response()->json($updatedModules); // Return JSON response
    }

    public function update(Request $request)
    {         
        
        $name =  $request->input('name');
        $action =  $request->input('action');

        // Retrieve the module, that has the name in the $name varibale. The name is UNIQUE.

        $module = Module::select()->where('name', $name)->get()[0];

        // Save the current state of the module befire changing 
        $history = new History(
          ['name'=>$module->name,
        'number'=>$module->number,
        'description'=>$module->description,
        'type'=>$module->type,
        'working_state'=>$module->working_state,
        'temperature'=>$module->temperature,
        'working_duration'=>$module->working_duration,
        'number_data_sent'=>$module->number_data_sent
        ]);
        $history = $module->histories()->save($history);

        if ($action=="on-off") { 
                if($module->working_state =='0'){ // IF OFF then ON
                     $module->working_state='1';
                     $module->temperature = Module::generateTemperature();
                     $module->working_duration = Module::generateWorkingDuration();
                     $module->number_data_sent = Module::generateNumberOfDataSent(); 
                    } 
                else {
                     $module->working_state='0';
                     $module->temperature=null;
                      $module->working_duration=null;
                    $module->number_data_sent=null;
                    } 
        }
        elseif($action=="variable"){ // Dysfunction of A Variable
            $variableNotNull = [];
            if($module->temperature != null) array_push($variableNotNull,'t');
            if($module->working_duration != null) array_push($variableNotNull,'d');
            if($module->number_data_sent != null) array_push($variableNotNull,'s');

            if (count($variableNotNull)== 0) {   return;  }
            else {
                $random_variable=array_rand($variableNotNull); // Generate a Random key from the array, to access value array[key] required.
                if ($variableNotNull[$random_variable]=='t') {   $module->temperature=null;   }     // Temperature variable -> disabled
                if ($variableNotNull[$random_variable]=='d') {   $module->working_duration=null;   } // working_duration variable -> disabled
                if ($variableNotNull[$random_variable]=='s') {   $module->number_data_sent=null;   } // number_data_sent variable -> disabled
            }
            
        }
        elseif ($action=="generate") {
            $module->working_state='1';
            $module->temperature = Module::generateTemperature();
            $module->working_duration = Module::generateWorkingDuration();
            $module->number_data_sent = Module::generateNumberOfDataSent();
         }

         // Save the Changes :==> Module update : 
         $module->save();
    }

}