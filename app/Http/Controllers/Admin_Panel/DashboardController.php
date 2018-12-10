<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Admin\AdminHelper;
use App\Seller;
use App\User;
use Auth;
use Illuminate\Http\Request;
class DashboardController extends Controller
{	
	/**
	 * it returns the view of admin dashboard or admin controller
	 * @return view of admin_panel i.e. admin.admin_panel [description]
	 */
     public function index()
    {
        $total_users = Count(User::all());
        $total_sellers = Seller::all()->count();

        return view("admin.sb_admin.admin",compact('total_users','total_sellers'));
    }
   

   
}
