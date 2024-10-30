<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public $model;
    public $db;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->db = \Config\Database::connect();

    }
    public function index()
    {
        $users = $this->model->findAll();
        // $users = $this->db->table('users');
        // dd($users);
        return $users;
    }

    public function edit($id)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return redirect()->to('dashboard')->with('error', 'User not found!');
        }
        return view('users/register', ['user' => $user]);
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'POST') {
            $this->model->update($id, $this->request->getPost());
            return redirect()->to('dashboard')->with('success', 'User updated successfully!');
        }
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('dashboard')
            ->with('success', 'User deleted successfully.');
    }
}
