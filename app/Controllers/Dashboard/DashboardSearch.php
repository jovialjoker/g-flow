<?php namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ListModel;
use App\Models\ListMemberModel;

class DashboardSearch extends BaseController
{
    public function index($toFind)
    {
        $userModel = new UserModel();
        $listModel = new ListModel();
        $userData = $userModel->like('nickname', htmlspecialchars($toFind), 'both', true)->limit(5)->findAll();
        $profileData = $userModel->where('provider_id', $this->session->get('logged_in'))->first();
        $listData = $listModel->where('owner', $this->session->get('logged_in'))->findAll();

        $data = [
            'users' => $userData,
            'profileData' => $profileData,
            'lists' => $listData
        ];
        return view('dashboard/search', $data);
    }

    public function doSearch()
    {
        if(!$this->validate([
            'search' => 'required', 
        ])) return redirect()->back();
        return redirect()->route('search', [htmlspecialchars($this->request->getPost('search'))]);
    }

    public function inviteToList($userID)
    {
        if(!$this->validate([
            'user' => 'required', 
        ])) return redirect()->back();
        $listID = $this->request->getPost('user');

        $listMemberModel = new ListMemberModel();
        $listMemberModel->insert(['user_id' => htmlspecialchars($userID), 'list_id' => htmlspecialchars($listID)]);
        
        (new \App\Helpers\Functions)->sendNotification($this->session->get('logged_in'), 'You have invited with success userID: #' . $userID . ' to listID: #' . $listID, 'dashboard/list');
        (new \App\Helpers\Functions)->sendNotification($userID, 'You were invited with success to a list: listID: #' . $listID, 'dashboard/list');
        
        return redirect()->route('list');  
    }
}