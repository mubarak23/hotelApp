<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;

class RoomsController extends Controller
{
    //

    public function checkAvailableRooms(Request $request, $client_id){

    	$data = $request->all();

    	$dateFrom = $request->input('dateFrom');
    	$dateTo = $request->input('dateTo');

    	$client = new Client();
    	$room = new Room();

    	$data = [];
    	$data['room_id'] = $room->id;
    	$data['client_id'] = $client_id;   	
    	$data['dateFrom'] = $dateFrom;
    	$data['dateTo'] = $dateTo;

    	$data['rooms'] = $room->getAvailableRooms($dateFrom, $dateTo);

    	$data['client'] = $client->find($client_id);



    	return view('rooms/checkAvailableRooms', $data);
    }

}
