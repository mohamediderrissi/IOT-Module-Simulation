<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\History;
class Module extends Model
{
    /**
     
    public $name;
    public $number;
    public $description;
    public $type;
    public $temperature;
    public $working_duration;
    public $number_data_sent;
    public $working_state;
    **/
    //public $timestamps = false;
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    //  protected $attributes = [
    //     'temperature' => '27°C',
    //     'working_duration'=> '20min',
    //     'number_data_sent' =>'15Kb',
    //     'working_state'=>'0'
    // ];

    protected $fillable = [
        'name',
        'number',
        'description',
        'type',
        'temperature',
        'working_duration',
        'number_data_sent',
        'working_state'
         ];   
         
    protected static function generateTemperature(){
        $randNumber = mt_rand(0,60);
        $value = strval($randNumber).'°C';
        return $value;
    }

    protected static function generateWorkingDuration(){
        $hour = mt_rand(1,10);
        $minute = mt_rand(1,59);
        $value = strval($hour).'h'.strval($minute).'min';
        return $value;
    }

    protected static function generateNumberOfDataSent(){
        $randNumber = mt_rand(1,150);
        $value = strval($randNumber).'Kb';
        return $value;
    }

    // OneToMany Relation : Module has many History
    public function histories()
    {
        return $this->hasMany(History::class);
    }


}