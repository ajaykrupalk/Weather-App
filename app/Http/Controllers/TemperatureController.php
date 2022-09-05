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
        $response = Http::get("http://www.geoplugin.net/json.gp?ip=xx.xx.xx.xx");
        $location = $response->json();
        $latitude = $location['geoplugin_latitude'];
        $longitude = $location['geoplugin_longitude'];

        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?lat=$latitude&lon=$longitude&units=metric&appid=f92d3f9b489e383709de5eefbd3d9f59");
        $temperatures = json_decode($response->body());
        for($x = 0; $x < count($temperatures->list); $x++) {
            $temperature = new Temperature;
            $date = date("Y-m-d H:i:s",$temperatures->list[$x]->dt);
            if(Temperature::where('cur_date', $date)->doesntExist()) {
                $temperature->cur_date = $date;
                $temperature->cur_temp = $temperatures->list[$x]->main->temp;
                $temperature->icon = $temperatures->list[$x]->weather[0]->icon;
                $temperature->save();
            }
        }
        // return "Done";
        return redirect('/home');
    }
}
