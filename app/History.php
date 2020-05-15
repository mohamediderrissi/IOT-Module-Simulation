<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    
    public $timestamps = false;
    
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
}
