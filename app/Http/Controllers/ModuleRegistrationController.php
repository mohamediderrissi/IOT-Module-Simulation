<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requestes;
use App\Http\Controllers\Controller;
use App\Module;

class ModuleRegistrationController extends Controller
{
    public function moduleRegister(Request $request) {
        
        // Validation of the form's input.
            $request->validate([
                'name'=>'required|string',
                'number'=>'required|string',
                'description'=>'required|string',
                'type'=>'required|string'
            ]);          


        //Retrieve the information of The New module
        $name = $request->input('name');
        $number = $request->input('number');
        $description = $request->input('description');
        $type = $request->input('type');

        $temperature = $request->input('temperature');
        $duration = $request->input('working_duration');
        $numberOfData = $request->input('number_data_sent');
        $workState = $request->input('working_state');
        
        echo $temperature;
        echo $duration;
        echo $numberOfData;
        echo $workState;


        // Create a new Module
        $module = new Module(
            [ 'name'=>$name,
            'number'=>$number,
            'description'=>$description,
            'type'=>$type
            ]
        );

        if ($workState=='1') {
            $module->working_state=$workState;
            if ($temperature =='1') {  $module->temperature = Module::generateTemperature();    }
            if ($duration =='1') {  $module->working_duration = Module::generateWorkingDuration();    }
            if ($numberOfData=='1') {  $module->number_data_sent = Module::generateNumberOfDataSent();    }
        }
        else {
            $module->working_state='0';
        }
        
        // Saving The New Module :
        $module->save();
        // Retrieving All Modules : 
        $modules = $module::all();

       // return redirect('/dashboard')->with('success', 'Module saved!'); 
      return view("dashboard", ["modules"=>$modules]);
 
    }

    public function showModules(Request $request)
    {
        $module = new Module();
        $modules = module::all();
        return view("dashboard", ["modules"=>$modules]);
    }

}
