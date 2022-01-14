<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $returnType = '\App\Entities\User';
    protected $allowedFields = [
        'provider_id', 'name', 'email', 'nickname', 'avatar_url'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}