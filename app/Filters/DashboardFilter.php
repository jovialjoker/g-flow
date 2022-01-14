<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DashboardFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
		  $session = \Config\Services::session();
      if(is_null($session->get('logged_in')))
      {
        return redirect('/');
      }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}