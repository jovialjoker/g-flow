<?php namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\NotificationModel;
use App\Models\UserModel;

class DashboardNotification extends BaseController
{
    public function index()
    {
        $notificationModel = new NotificationModel();
        $userModel = new UserModel();

        $notifyData = $notificationModel->where(['user_id' => $this->session->get('logged_in'), 'viewed_at' => NULL])->findAll();
        $profileData = $userModel->where('provider_id', $this->session->get('logged_in'))->first();

        $data = [
            'notifications' => $notifyData,
            'profile' => $profileData
        ];
        return view('Dashboard/notification', $data);
    }

    public function notificationDelete($notifID)
    {
        $notificationModel = new NotificationModel();
        $notificationModel->update($notifID, ['viewed_at' => date("Y-m-d H:i:s", time())]);

        return redirect()->route('notification');
    }
}