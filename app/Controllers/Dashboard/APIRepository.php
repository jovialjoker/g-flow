<?php namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\UserModel;

class APIRepository extends BaseController
{
    public function index()
    {

        $userHandle = new UserModel();
        $userNick = $userHandle->where('provider_id', $this->session->get('logged_in'))->first()->nickname;

        $data = [
            'repos' => $this->client->api('user')->repositories($userNick),
            'profileData' => $userHandle->where('provider_id', $this->session->get('logged_in'))->first()
        ];

        return view('Dashboard/github_api/home', $data);
    }

    public function read($repoID)
    {
        $userHandle = new UserModel();
        $repos = $this->client->api('repo')->showById($repoID);
        $issues = $this->client->api('issue')->all($repos['owner']['login'], $repos['name'], array('state' => 'open'));
        
        $data = [
            'issues' => $issues,
            'profileData' => $userHandle->where('provider_id', $this->session->get('logged_in'))->first(),
            'repoID' => $repoID
        ];
        return view('Dashboard/github_api/repo_view', $data);
    }

    public function cancel($repoID, $issueID)
    {
        $repos = $this->client->api('repo')->showById($repoID);
        $this->client->authenticate('fnzbz', '', Github\Client::AUTH_HTTP_PASSWORD);
        $this->client->api('issue')->update($repos['owner']['login'], $repos['name'], $issueID, array('state' => 'closed'));

        return redirect()->route('githubView', [$repoID]);
    }
}
