<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\customermodel;
 
class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('login');
    } 
 
    public function auth()
    {
        $session = session();
        $model = new customermodel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('customer_email', $email)->first();
        if($data){
            $pass = $data['customer_password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'customer_id'       => $data['customer_id'],
                    'customer_name'     => $data['customer_name'],
                    'customer_email'    => $data['customer_email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
} 