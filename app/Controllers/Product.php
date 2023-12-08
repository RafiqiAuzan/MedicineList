<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Product_model;
 
class Product extends Controller
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $model = new Product_Model();
        $data['product']  = $model->getProduct()->getResult();
        $data['category']  = $model->getCategory()->getResult();
        $kunci = $this->request->getVar('cari');

        if ($kunci) {
            $query = $model->pencarian($kunci);
            $jumlah = "Pencarian dengan nama <B>$kunci</B> ditemukan ".$query->affectedRows()." Data";
        } else {
            $query = $model;
            $jumlah = "";
        }
        $data['product'] = $model->paginate(5);
        $data['pager'] = $model->pager;
        $data['jumlah'] = $jumlah;
        echo view('product_view', $data);
    }
 
    public function save()
    {
        $model = new Product_model();
        $data = array(
            'product_name'        => $this->request->getPost('product_name'),
            'product_price'       => $this->request->getPost('product_price'),
            'product_category_id' => $this->request->getPost('product_category'),
        );
        $model->saveProduct($data);
        return redirect()->to('/product');
    }
 
    public function update()
    {
        $model = new Product_model();
        $id = $this->request->getPost('product_id');
        $data = array(
            'product_name'        => $this->request->getPost('product_name'),
            'product_price'       => $this->request->getPost('product_price'),
            'product_category_id' => $this->request->getPost('product_category'),
        );
        $model->updateProduct($data, $id);
        return redirect()->to('/product');
    }
 
    public function delete()
    {
        $model = new Product_model();
        $id = $this->request->getPost('product_id');
        $model->deleteProduct($id);
        return redirect()->to('/product');
    }
 
}