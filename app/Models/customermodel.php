<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class customermodel extends Model{
    protected $table = 'customer';
    protected $allowedFields = ['customer_name','customer_email','customer_password','customer_created_at'];
}