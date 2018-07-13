<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client as Client;
use App\Room as Room;
use App\Reservation as Reservation;

class ReservationsController extends Controller
{
    //

    public function bookRoom($client_id, $room_id, $date_in, $date_out){

    		$reservation = new Reservation();
    		$client_instant = new Client();
    		$room_instant = new Room();

    		//find client by id
    		$client = $client_instant->find($client_id);
    		$room = $room_instant->find($room_id);
    		$reservation->date_in = $date_in;
    		$reservation->date_out = $date_out;

    		//associate room and reservations
    		$reservation->room()->associate($room);
    		$reservation->client()->associate($client);

    		if($room_instant->isRoomBooked($room_id, $date_in, $date_out)){
    			
    			abort(405, 'Trying to Book an Already Booked Room');
    		}
    		$reservation->save();

    		return redirect()->route('clients');


    	//return view('reservations/bookRoom');

    }
}
