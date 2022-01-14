<?php namespace App\Helpers;

class Functions {
    public function checkIsUserInList($userID, $listID)
    {
        $listMemberModel = new \App\Models\ListMemberModel();
        $listHandler = $listMemberModel->where(['user_id' => $userID, 'list_id' => $listID])->findAll();

        return count($listHandler);
    }
    public function countUserList($userID)
    {
        $listMemberModel = new \App\Models\ListMemberModel();
        $listHandler = $listMemberModel->where('user_id', $userID)->findAll();

        return count($listHandler);
    }
    public function getNameByID($userID)
    {
        $userModel = new \App\Models\UserModel();
        $userHandler = $userModel->where('provider_id', $userID)->first()->nickname;

        return $userHandler;
    }
    public function getListAvatars($listID)
    {
        $userModel = new \App\Models\UserModel();
        $listMemberModel = new \App\Models\ListMemberModel();

        $userJoinData = $userModel->join('list_members', 'list_members.user_id = users.provider_id')->where('list_members.list_id', $listID)->findAll();
        return $userJoinData;
    }
    public function sendNotification($userID, $text, $action)
    {
        $data = [
            'text' => $text,
            'user_id' => $userID,
            'action' => $action
        ];

        $notificationModel = new \App\Models\NotificationModel();
        $notificationModel->insert($data);
    }
}