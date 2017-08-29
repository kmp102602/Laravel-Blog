<?php
namespace App\Http\Controllers;

class PagesController extends Controller {
	public function getIndex() {
		$name = "Ken";
		return View('pages/welcome');
	}

	public function getContact() {
		return View('pages/contact');
	}

	public function getAbout() {		
		$data = [];
		$data['fullName'] = "Ken Paulson";
		$data['email'] = "kenpaulson@att.net";

		return View('pages/about')->with('data', $data);
	}
}