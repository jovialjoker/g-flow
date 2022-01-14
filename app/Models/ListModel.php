<?php namespace App\Models;

use CodeIgniter\Model;

class ListModel extends Model
{
    protected $table = 'lists';
    protected $returnType = '\App\Entities\Lists';
    protected $allowedFields = [
        'name', 'deadline_date', 'owner'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}