<?php namespace App\Models;

use CodeIgniter\Model;

class ListTaskModel extends Model
{
    protected $table = 'list_tasks';
    protected $returnType = '\App\Entities\ListTask';
    protected $allowedFields = [
        'text', 'user_id', 'list_id', 'completed_at', 'priority'
    ];

    protected $useTimestamps = false;
}