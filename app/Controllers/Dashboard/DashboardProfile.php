<?php namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardProfile extends BaseController
{
    public function index()
    {
        $userData = (new UserModel)->where('provider_id', $this->session->get('logged_in'))->first();
        $apiData = (object) $this->client->api('users')->show($userData->nickname);
        $data = [
            'userdata' => $userData,
            'apidata' => $apiData
        ];
        return view('dashboard/profile', $data);
    }

    public function updateProfile()
    {
        if(!$this->validate([
            'name' => 'required|min_length[10]|max_length[48]',
            'email' => 'required|valid_email'
        ])) return redirect()->route('profilePage');
        
        $data = [
            'name' => htmlspecialchars($this->request->getPost('name')),
            'email' => htmlspecialchars($this->request->getPost('email'))
        ];
        $userData = new UserModel();
        $userHandle = $userData->where('provider_id', $this->session->get('logged_in'));
        $userData->update($userHandle->id, $data);
        (new \App\Helpers\Functions)->sendNotification($this->session->get('logged_in'), 'You have updated your profile with success', 'dashboard/profile');

        return redirect()->route('profilePage');
    }
}