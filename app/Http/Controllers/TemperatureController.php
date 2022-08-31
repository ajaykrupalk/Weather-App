<?php

namespace App\Http\Controllers;
use App\Models\Temperature;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    //
    public function fetch()
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?lat=12.9716&lon=77.5946&units=metric&appid=f92d3f9b489e383709de5eefbd3d9f59");
        $temperatures = json_decode($response->body());
        for($x = 0; $x < count($temperatures->list); $x++) {
            $temperature = new Temperature;
            $date = date("Y-m-d H:i:s",$temperatures->list[$x]->dt);
            $temperature->cur_date = $date;
            $temperature->cur_temp = $temperatures->list[$x]->main->temp;
            $temperature->icon = $temperatures->list[$x]->weather[0]->icon;
            $temperature->save();
        }
        return "DONE";
    }
}
