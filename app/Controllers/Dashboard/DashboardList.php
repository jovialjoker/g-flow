<?php namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\ListMemberModel;
use App\Models\ListModel;
use App\Models\ListTaskModel;
use App\Models\UserModel;

class DashboardList extends BaseController
{
    public function index()
    {
        $userHandle = new UserModel();
        $listTaskHandle = new ListTaskModel();
        $listMemberHandle = new ListMemberModel();
        $listJoinHandle = new ListModel();
        $profileData = $userHandle->where('provider_id', $this->session->get('logged_in'))->first();

        $listTaskData = $listTaskHandle->where('user_id', $this->session->get('logged_in'));
        $listMemberData = $listMemberHandle->where('user_id', $this->session->get('logged_in'))->findAll();
        $listJoinData = $listJoinHandle->join('list_members', 'list_members.list_id = lists.id')->where('list_members.user_id', $this->session->get('logged_in'));
        $data = [
            'pageData' => (object) [
                'countResults' => count($listMemberData),
                'latestList' => !is_null($listJoinData->orderBy('lists.id', 'DESC')->first()) ? $listJoinData->orderBy('lists.id', 'DESC')->first()->name : 'N/A',
                'totalTasks' => count($listTaskData->findAll()),
                'completedTasks' => count($listTaskHandle->where('user_id', $this->session->get('logged_in'))->where('completed_at !=', 'NULL')->findAll()),
                'urgentTasks' => count($listTaskHandle->where('user_id', $this->session->get('logged_in'))->where('priority', 1)->findAll()),
                'lists' => $listJoinData->paginate(5)
            ],
            'profileData' => $profileData
        ];
        return view('dashboard/list', $data);
    }

    public function read($listID)
    {
        $userHandle = new UserModel();
        $listMemberHandle = (new ListMemberModel)->where('list_id', $listID)->findAll();
        
        $pager = 1;
        if(is_numeric($this->request->getGet('page')))
            $pager = $this->request->getGet('page');
        else $pager = 1;
        
        
        $profileData = $userHandle->where('provider_id', $this->session->get('logged_in'))->first();
        $listData = (new ListModel)->where('id', $listID);
        $listTaskData = $this->db->table('list_tasks')
                 ->join('users', 'list_tasks.user_id = users.provider_id', 'left')->select(['users.avatar_url', 'users.nickname', 'list_tasks.id', 'list_tasks.priority', 'list_tasks.created_at', 'list_tasks.completed_at', 'users.provider_id', 'list_tasks.text'])
                 ->where('list_tasks.list_id', $listID)->orderBy('list_tasks.id', 'DESC');
        $userJoinData = (new UserModel)->join('list_members', 'list_members.user_id = users.provider_id')->where('list_members.list_id', $listID)->findAll();
        $data = [
            'pageData' => (object) [
                'list_id' => $listID,
                'title' => $listData->first()->name,
                'tasks' => $listTaskData->get(5, ($pager - 1) * 5)->getResultArray(),
                'check_owner' => $listData->first()->owner == $this->session->get('logged_in') ? true : false,
                'prevPage' => $pager - 1 ? $pager - 1 : 0,
                'nextPage' =>  $pager + 1,
                'totalPages' => intval($listTaskData->countAllResults() / 5) + ($listTaskData->countAllResults() % 5 ? 1 : 0),
                'userData' => $userJoinData
            ],
            'profileData' => $profileData,
            'users' => $listMemberHandle
        ];

        return view('dashboard/list_view', $data);
    }

    public function taskDelete($taskID)
    {
        $taskModel = new ListTaskModel();
        $listID = $taskModel->where('id', $taskID)->first()->list_id;

        $taskModel->delete($taskID);
        return redirect()->route('viewList', [$listID]);
    }

    public function markStatus($taskID)
    {
        $taskModel = new ListTaskModel();
        $taskHandle = $taskModel->where('id', $taskID)->first();

        $listID = $taskHandle->list_id;
        
        $newStatus = $taskHandle->completed_at;
        if(!is_null($newStatus))
            $newStatus = NULL;
        else $newStatus = date("Y-m-d H:i:s", time());

        $data = [
            'completed_at' => $newStatus
        ];
        $taskModel->update($taskID, $data);
        
        return redirect()->route('viewList', [$listID]);
    }

    public function changePriority($taskID)
    {
        $taskModel = new ListTaskModel();
        $taskHandle = $taskModel->where('id', $taskID)->first();

        $listID = $taskHandle->list_id;
        
        $newStatus = $taskHandle->priority;
        if(!$newStatus)
            $newStatus = 1;
        else $newStatus = 0;

        $data = [
            'priority' => $newStatus
        ];
        $taskModel->update($taskID, $data);
        
        return redirect()->route('viewList', [$listID]);
    }

    public function createTask($listID)
    {
        if(strlen(htmlspecialchars($this->request->getPost('task-name'))) < 10) return redirect()->route('viewList', [$listID]);
        $taskModel = new ListTaskModel();

        $priority = 0;
        if($this->request->getPost('checkbox-task')) $priority = 1;

        $data = [
            'user_id' => htmlspecialchars($this->request->getPost('user')),
            'text' => htmlspecialchars($this->request->getPost('task-name')),
            'list_id' => $listID,
            'priority' => $priority,
        ];
        $taskHandle = $taskModel->insert($data);
        return redirect()->route('viewList', [$listID]);
    }

    public function deleteList($listID)
    {
        $listModel = new ListModel();
        $listModel->delete($listID);
        (new \App\Helpers\Functions)->sendNotification($this->session->get('logged_in'), 'You have deleted a list with success', 'dashboard/list');
        return redirect()->route('list');
    }

    public function assignTo($taskID)
    {
        $listTaskModel = new ListTaskModel();
        $listID = $listTaskModel->where('id', $taskID)->first()->list_id;
        if(!$this->validate([
            'user' => 'required'
        ])) return redirect()->route('viewList', [$listID]);
        
        $userID = htmlspecialchars($this->request->getPost('user'));
        $listTaskModel->update($taskID, ['user_id' => $userID]);
        return redirect()->route('viewList', [$listID]);
    }

    public function createList()
    {
        $listModel = new ListModel();
        $listMemberModel = new ListMemberModel();

        if(!$this->validate([
            'list-name' => 'required',
            'list-date' => 'required'
        ])) return redirect()->route('list');

        $listName = htmlspecialchars($this->request->getPost('list-name'));
        $listDate = htmlspecialchars($this->request->getPost('list-date'));

        $listModel->insert(['name' => $listName, 'owner' => $this->session->get('logged_in'), 'deadline_date' => $listDate]);
        $listMemberModel->insert(['user_id' => $this->session->get('logged_in'), 'list_id' => $listModel->where('owner', $this->session->get('logged_in'))->orderBy('id', 'DESC')->first()->id]);
        (new \App\Helpers\Functions)->sendNotification($this->session->get('logged_in'), 'You have created a new list with success', 'dashboard/list');

        return redirect()->route('list');
    }
}