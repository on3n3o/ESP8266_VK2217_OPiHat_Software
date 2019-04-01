<?php

namespace App\Http\Controllers;

use App\Network;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $config['center'] = '51.9478458, 19.4682356';
        $config['zoom'] = '6.75';
        app('map')->initialize($config);
	$all_networks = Network::all();
        $networks = Network::whereHas('calculatedPosition')->get();

        foreach($networks as $network){
            $circle = [];
            $circle['center'] = $network->calculatedPosition->lat . ', ' . $network->calculatedPosition->lng;
            $circle['radius'] = $network->calculatedPosition->size;
            app('map')->add_circle($circle);
            $marker = [];
            $marker['position'] = $network->calculatedPosition->lat . ', ' . $network->calculatedPosition->lng;
            $marker['infowindow_content'] = '<h3>' . $network->name . '</h3>'. 
                '<p>Nazwa: ' . $network->name . '</p>' .
                '<p>Mac: ' . $network->mac . '</p>' .
                '<p>Rozmiar: ' . $network->calculatedPosition->size . '</p>'
            ;
            app('map')->add_marker($marker);
        }

        $map = app('map')->create_map();

        /** @todo move this to resources views */
        return view('home', compact('map', 'networks', 'all_networks'));
    }
}
