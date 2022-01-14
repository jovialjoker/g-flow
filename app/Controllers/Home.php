<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
	public function index()
	{
		if(!$this->session->has('language'))
			$this->session->set('language', 'en');
			
		return view('home');
	}

	public function language()
	{
		if($this->session->get('language') == 'en')
			$this->session->set('language', 'ro');
		else
			$this->session->set('language', 'en');
		return redirect()->back();
	}
}
