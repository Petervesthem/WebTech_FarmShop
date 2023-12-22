<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
/*
 * //Using the Auth facade to check the user that is logged in instead
    public function userInformation(){
        $users = DB::table('users')->select('name','email','phoneNumber')->get();

        return view('userpage',['userData'=>$users]);
    }
*/

    public function userOrderHistory(){
        $orders = Order::with('users')->with('product')->get();
        //$products = Order_product::with('orders')->get();
        //error_log($products);
        error_log($orders);
        return view('userpage', ['orderdata'=>$orders]);
    }

}

