<?php namespace App\Entities;

use CodeIgniter\Entity;

class ListMember extends Entity
{
    protected $id;
    protected $user_id;
    protected $list_id;
    protected $entered_at;
    protected $left_at;
}