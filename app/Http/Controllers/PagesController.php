<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use Mail;  //facsod
use Session;

class PagesController extends Controller {
	public function getIndex() {
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		
		return View('pages/welcome')->withPosts($posts);
	}	

	public function getAbout() {		
		$first = 'Ken';
		$last = 'Paulson';

		$fullname = $first . " " . $last;
		$email = 'kenpaulson@att.net';
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $fullname;		

		return View('pages/about')->with('data', $data);
	}

	public function getContact() {
		return View('pages/contact');
	}

	public function postContact(Request $request) {
		$this->validate($request, [
			'email'   => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10']);

		$data = array(
			'email'       => $request->email,
			'subject'     => $request->subject,
			'bodyMessage' => $request->message  //can't use message element because mail uses it already
			);									//every key will become a varable in the view

		Mail::send('emails.contact', $data, function($message) use ($data){  
			$message->from($data['email']);
			$message->to('kmp102602@att.net');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Your Email was Sent!');

		return redirect('/');
	}
}