<?php namespace App\Models;

use CodeIgniter\Model;

class ListMemberModel extends Model
{
    protected $table = 'list_members';
    protected $returnType = '\App\Entities\ListMember';
    protected $allowedFields = [
        'user_id', 'list_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'entered_at';
    protected $updatedField  = 'left_at';
}