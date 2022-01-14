<?php namespace App\Controllers;

use CodeIgniter\Controller;
use League\OAuth2\Client\Provider\Github;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function handle()
    {
        $provider = new Github([
            'clientId' => env('app.github.clientid'),
            'clientSecret' => env('app.github.secret'),
            'redirectUri' => env('app.github.redirect'),
        ]);

        $apiUrl = $provider->getAuthorizationUrl();
        $this->session->set('o-auth', $provider->getState());
        header('Location: ' . $apiUrl);
        exit;
    }

    public function callback()
    {
        $provider = new Github([
            'clientId' => env('app.github.clientid'),
            'clientSecret' => env('app.github.secret'),
            'redirectUri' => env('app.github.redirect'),
        ]);

        if(is_null($this->request->getGet('state')) || ($this->request->getGet('state') !== $this->session->get('o-auth'))) 
        {
            $this->session->remove('o-auth');
            return redirect()->to('/');
        }

        $token = $provider->getAccessToken('authorization_code', [ 'code' => $this->request->getGet('code') ]);
        $this->client->authenticate($token, null, \Github\Client::AUTH_URL_TOKEN);
        $apiUser = $provider->getResourceOwner($token)->toArray();
        
        $userModel = new \App\Models\UserModel;
        $user = $userModel->where('provider_id', $apiUser['id'])->first();

        if(!$user)
        {
            $data = [
                'provider_id' => $apiUser['id'],
                'nickname' => $apiUser['login'],
                'email' => $apiUser['email'],
                'name' => $apiUser['name'],
                'avatar_url' => $apiUser['avatar_url']
            ];
            $userModel->insert($data);
            $this->session->set('logged_in', $apiUser['id']);
            (new \App\Helpers\Functions)->sendNotification($this->session->get('logged_in'), 'Your account was created with success', 'dashboard');
        }
        else $this->session->set('logged_in', $apiUser['id']);
        $this->session->set('avatar_url', $apiUser['avatar_url']);
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect('/');   
    }
}