<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles --> <style></style>
    </head>
    <body>
        @extends('layouts.nav-bar')
        @section('title', 'Create')
        @section('content')
        <div class="container pt-5 mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="create" method="post">
                                {{ csrf_field() }} <!-- we could use also @csrf -->
                                <div class="form-group">
                                    <label for="moduleName">The Name Of The New Module</label>
                                    <input type="text" class="form-control" id="moduleName" name="name"  required="true"  placeholder="Module's Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="moduleNumber">The Number Of The New Module</label>
                                    <input type="text" class="form-control" id="moduleNumber" name="number"  required="true"  placeholder="Module's Number"/>
                                </div>
                                <div class="form-group">
                                    <label for="moduleDescription">The Description Of The New Module</label>
                                    <input type="text" class="form-control" id="moduleDescription" name="description"  required="true"  placeholder="Module's Description"/>
                                </div>
                                <div class="form-group">
                                    <label for="moduleType">The Type Of The New Module</label>
                                    <input type="text" class="form-control" id="moduleType" name="type"   required="true" placeholder="Module's Type"/>
                                </div>

                                <div>
                                    <div class="form-group form-check">
                                        <input type="checkbox"  class="form-check-input" value="1" name="temperature" /> <label for="temperature">Temperature</label><br />
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox"  class="form-check-input" value="1" name="working_duration" /> <label for="working_duration">Working Duration</label><br />
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox"  class="form-check-input" value="1" name="number_data_sent" /> <label for="number_data_sent">Number Of Data Sent</label><br />
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox"  class="form-check-input" value="1" checked name="working_state" /> <label for="working_state">Working State</label>
                                    </div>                        
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                    </form>        
                </div>
            </div>        
                
        </div>
       
    </body>
</html>
