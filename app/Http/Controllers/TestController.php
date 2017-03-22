<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use Table;
use TableView;
use App\User;
use App\Texts;
use App\Http\Requests;
use Mapper;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test(Request $request){
        
        return view('welcome', compact('table', 'searched', 'usersTableView'));
    }
    
    public function languages(){
        Mapper::location('Lithuania')->map(['draggable' => true,  'eventDragEnd' => 'console.log(markers[0].position.lat(), markers[0].position.lng());']);
      
        $map = Mapper::render();

      
        return view('languages', compact('map'));
    }
}
