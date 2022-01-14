<?php namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ListMemberModel;
use App\Models\ListTaskModel;
use App\Models\NotificationModel;

class DashboardHome extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $notificationModel = new NotificationModel();
        $listMemberModel = new ListMemberModel();
        $listTaskModel = new ListTaskModel();

        $profileData = $userModel->where('provider_id', $this->session->get('logged_in'))->first();

        $data = [
            'profile' => $profileData,
            'notifications' => count($notificationModel->where('user_id', $this->session->get('logged_in'))->findAll()),
            'tasks' => count($listTaskModel->where('user_id', $this->session->get('logged_in'))->findAll()),
            'lists' => count($listMemberModel->where('user_id', $this->session->get('logged_in'))->findAll()),
            'userstable' => $userModel->orderBy('id', 'DESC')->limit(5)->findAll()
        ];
        return view('dashboard/home', $data);
    }
    
}