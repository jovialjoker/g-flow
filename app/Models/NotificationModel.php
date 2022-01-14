<?php namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $returnType = '\App\Entities\Notification';
    protected $allowedFields = [
        'user_id', 'text', 'action_id', 'viewed_at', 'id'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'viewed_at';
}