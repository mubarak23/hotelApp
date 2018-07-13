<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;

class ClientController extends Controller
{
    //
    public function __construct(Title $titles){

    	$this->titles = $titles->all();

    }

    public function di(){
    	dd($this->titles);

    }

    public function index(){

       $data = [];      
       	$data['clients'] = Client::all();

    	return view('client/index', $data);

    }

    public function newClient(Request $request){
    
    	$data = [];	
    	
    	/*$data['titles'] = $this->titles;
    	$data['modify'] = 0;*/

      if($request->isMethod('post')){

          // dd($data);
        /*$this->validate($request, [
            'name' => 'required|min:5',
            'lastName' => 'required|min:5',
            'address' => 'required',
            'zip_code'  => 'required',
            'city'  => 'required',
            'state' => 'required',
            'email' => 'required'
          ]
        );*/

        $data = $request->all();
        //dd($data);
        $new_client = new Client();
        $new_client->title = $data['title'];
        $new_client->name = $data['name'];
        $new_client->last_name = $data['last_name'];
        $new_client->zip_code = $data['zipcode'];
        $new_client->address = $data['address'];
        $new_client->city = $data['city'];
        $new_client->state = $data['state'];
        $new_client->email = $data['email'];

        if($new_client->save()){
            return redirect('clients');
        }

        $data['titles'] = $this->titles;
      $data['modify'] = 0;

            return view('client/form', $data);
      }

      $data['titles'] = $this->titles;
      $data['modify'] = 0;

    	return view('client/form', $data);

    }	

    public function create(){
    	return view('client/create');
    }

    public function show($client_id){
    	$data = [];
      

    	$data['titles'] = $this->titles;
    	$data['modify'] = 1;

      $client_data = Client::find($client_id);

      $data['name'] = $client_data->name;
      $data['last_name']   = $client_data->last_name;
      $data['state']  = $client_data->zipcode;
      $data['zipcode'] = $client_data->zip_code;
      $data['email'] = $client_data->email;
      $data['city'] = $client_data->city;
      $data['address']   =  $client_data->address;
      

    		return view('client/form', $data);
    
    }

}
