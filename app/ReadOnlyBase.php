<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase 
{
    //

    protected $title_array = [];

    public function all(){
    	return $this->title_array;
    }

    public function get( $id ){
    	return $this->title_array[$id];
    }
}
