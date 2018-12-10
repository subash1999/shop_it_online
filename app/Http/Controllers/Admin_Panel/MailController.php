<?php

namespace App\Http\Controllers\Admin_Panel;

use App\Http\Controllers\Controller;
use App\Mail\MailToUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
    	$users = User::all();
    	return view('admin/sb_admin/admin_pages/admin_mail',['success'=>'','users'=>$users]);
    }
    function sendMail(Request $request)
	{
		$valid = $request->validate([
			'email'=>'email|required|max:200',
			'message'=>'string|required|min:10',
			'title'=>'string|required',
			'subject'=>'string|required|min:5',
		]);
		Mail::send(new MailToUsers());
		$users = User::all();
		return view('admin/sb_admin/admin_pages/admin_mail',['success'=>'Message Sent Successfully','users'=>$users]);
	}
}

