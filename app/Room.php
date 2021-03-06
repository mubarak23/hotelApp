<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Room extends Model
{
    //

    public function getAvailableRooms($start_date, $end_date){

    	$avalible_rooms = DB::table('rooms as r')
    						->select('r.id', 'r.name')
    						->whereRaw("
    							 r.id NOT IN(
    							 	select b.room_id FROM reservations b
    							 	WHERE NOT(
    							 		b.date_out < '{$start_date}' OR 
    							 		b.date_in > '{$end_date}'
    							 		)
    							 	)
    							")
    							->orderBy("r.id")
    							->get();

    							return $avalible_rooms;

    }

    public function isRoomBooked($room_id, $start_date, $end_date){

    		$avalible_rooms = DB::table('reservations')
    							->whereRaw("
    								NOT(
    								date_out < '{$start_date}' OR
    								date_in	 > '{$end_date}'
    									)	
    								")
    							->where('room_id', $room_id)
    							->count()
    						;		

    		return $avalible_rooms;				

    }
}
