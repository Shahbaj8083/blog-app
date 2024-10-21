<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function login()
    {
        if($this->request->getMethod() === 'POST'){
            $model = new UserModel();
            $username = trim($this->request->getPost('username'));
            echo "Username from POST: " . htmlspecialchars($username) . "<br>";
            $username = htmlspecialchars($username); // Sanitize the input
            $password = $this->request->getPost('password');

            #validate credentials
            $user = $model->where('name', $username)->first();
            // $db = \Config\Database::connect(); // Connect to the database
            // $user = $db->query('Select * from users limit 1;');
            dd($user);
               
            if (!$user) {
                echo "User not found"; // This will help debug if the user isn't found
            } else {
                // You can print user info for debugging
                echo "<pre>";
                print_r($user);
                echo "</pre>";
            }
            if($user && password_verify($password, $user['password'])){
                #set user session
                $this->setUserSession($user);
                return redirect()->to('dashboard');
            }
            else{
                session()->setFlashdata('error', 'Invalid username or password');
                return redirect()->to('login');
            }
        }
        return view('users/login');
    }

    public function register()
    {
        // print_r($this->request->getMethod());
        if($this->request->getMethod() === 'POST'){
            // $request = \Config\Services::request();
            $model = new UserModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'password' => $this->request->getPost('password'),
                'user_type' => $this->request->getPost('user_type')
            ];
            
            if($model->insert($data)){
                return redirect()->to('login')->with('success', 'Registration successful!');
            }else{
                session()->setFlashdata('error', 'Registration failed!');
                return redirect()->to('register');
            }
        }
        return view('users/register');
        

    }

    public function dashboard()
    {
        # checks if the user is logged in by looking
        # for a session variable named isLoggedIn
        if (!session()->get('isLoggedIn')) {
            #if not login redirect to /login route
            return redirect()->to('login');
        }

        return view('users/dashboard');
    }

    private function setUserSession($user){
        $data = [
            'id' => $user['id'],
            'username' => $user['name'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }
}
