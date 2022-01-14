<?php namespace App\Entities;

use CodeIgniter\Entity;

class Notification extends Entity
{
    protected $id;
    protected $text;
    protected $user_id;
    protected $action;
    protected $created_at;
    protected $viewed_at;
}