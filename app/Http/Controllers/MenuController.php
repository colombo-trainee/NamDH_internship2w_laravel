<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Food;
use App\Models\MenuTop;
class MenuController extends Controller
{
    public function index(){

    	$categories = Menu::all();
    	$menuTop 	= MenuTop::all();
    	return view('restaurant.home',[
    			'categories'	=> $categories,
    			'menuTop'		=> $menuTop,
    		]);
    }
}
