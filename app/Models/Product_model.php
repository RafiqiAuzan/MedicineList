<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class Product_model extends Model
{
    protected $table   = 'product';
    protected $primaryKey = 'product_id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['product_name', 'product_price'];
    public function pencarian($kunci) {
        return $this->table('product')->like('product_name', $kunci);
    } 
    public function getCategory()
    {
        $builder = $this->db->table('category');
        return $builder->get();
    }
 
    public function getProduct()
    {
        $builder = $this->db->table('product');
        $builder->select('*');
        $builder->join('category', 'category_id = product_category_id','left');
        return $builder->get();
    }
 
    public function saveProduct($data){
        $query = $this->db->table('product')->insert($data);
        return $query;
    }
 
    public function updateProduct($data, $id)
    {
        $query = $this->db->table('product')->update($data, array('product_id' => $id));
        return $query;
    }
 
    public function deleteProduct($id)
    {
        $query = $this->db->table('product')->delete(array('product_id' => $id));
        return $query;
    } 
 
   
}