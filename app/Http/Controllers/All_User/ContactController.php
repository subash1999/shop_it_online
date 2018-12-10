<?php

namespace App\Http\Controllers\All_User;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
	public function index(Request $request)
	{
		return view('public/pages/contact',['success'=>'']);
	}
	function sendMessage(Request $request)
	{
		$valid = $request->validate([
			'name' => 'required|max:255',
			'phone' => 'required|max:30',
			'email'=>'email|required|max:200',
			'message'=>'string|required|min:10',
		]);
		Mail::send(new ContactMail());
		return redirect('contact')->with('success',"Mail Sent Successfully");
	}
}
