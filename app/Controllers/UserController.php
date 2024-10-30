<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Debug\Timer;


class UserController extends BaseController
{

    public function __construct()
    {
        #loading mail helper function
        helper('email');
    }

    public function login()
    {
        # Start benchmarking
        $timer = new Timer();
        $timer->start('login_process');
        if ($this->request->getMethod() === 'POST') {
            $model = new UserModel();
            $username = trim($this->request->getPost('username'));
            $password = $this->request->getPost('password');

            #validate credentials
            $user = $model->where('name', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                #set user session
                $this->setUserSession($user);
                return redirect()->to('dashboard');
            } else {
                session()->setFlashdata('error', 'Invalid username or password');
                return redirect()->to('login');
            }
        }
        // Stop benchmarking
        $timer->stop('login_process');
        // Log the execution time
        log_message('info', 'Login method execution time: ' . $timer->getElapsedTime('login_process') . ' seconds');
        return view('users/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new UserModel();
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT), // Hashing password
                'user_type' => $this->request->getPost('user_type')
            ];
            $file = $this->request->getFile('profile_image');

            try {
                if ($file && $file->isValid()) {
                    $fileNameToStore = $file->store();
                    $data['profile_image'] = 'uploads/' . $fileNameToStore;
                } else {
                    $data['profile_image'] = null;
                }

                if ($model->insert($data)) {
                    # Send email notification
                    $to = $data['email'];
                    $subject = 'Welcome to Our Service!';
                    $message = 'Dear ' . $data['name'] . ',<br>Thank you for registering!';
                    sendEmail($to, $subject, $message);
                    return redirect()->to('login')->with('success', 'Registration successful!');
                } else {
                    $errors = $model->errors();
                    session()->setFlashdata('errors', $errors);
                    session()->setFlashdata('error', 'Registration failed!');
                    return redirect()->to('register');
                }
            } catch (\Exception $e) {
                session()->setFlashdata('error', 'An error occurred during registration: ' . $e->getMessage());
                return redirect()->to('register');
            }
        }
        return view('users/register', ['errors' => session()->getFlashdata('errors')]);
    }


    public function dashboard()
    {

        # checks if the user is logged in by looking
        # for a session variable named isLoggedIn
        if (!session()->get('isLoggedIn')) {
            #if not login redirect to /login route
            return redirect()->to('login');
        }
        $dashboard = new DashboardController();
        try {
            $data = $dashboard->index();
            return view('users/dashboard', ['users' => $data]);
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'An error occurred while fetching dashboard data: ' . $e->getMessage());
            return redirect()->to('login');
        }
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'username' => $user['name'],
            'isLoggedIn' => true
        ];
        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
