<?php namespace App\Entities;

use CodeIgniter\Entity;

class User extends Entity
{
    protected $id;
    protected $provider_id;
    protected $nickname;
    protected $email;
    protected $name;
    protected $avatar_url;
    protected $created_at;
    protected $updated_at;
}