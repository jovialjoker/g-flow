<?php namespace App\Entities;

use CodeIgniter\Entity;

class ListTask extends Entity
{
    protected $id;
    protected $text;
    protected $user_id;
    protected $list_id;
    protected $priority;
    protected $created_at;
    protected $completed_at;
}