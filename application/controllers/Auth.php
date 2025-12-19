<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function register()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run()) {
                $data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role' => $this->input->post('role')
                ];
                $this->User_model->insertUser($data);
                redirect('auth/login');
            }
        }
        $this->load->view('auth/register');
    }

    public function login()
    {
        if ($this->input->post()) {
            $user = $this->User_model->getUserByEmail(
                $this->input->post('email')
            );

            if ($user && password_verify($this->input->post('password'), $user->password)) {
                $token = generate_jwt([
                    'id'   => $user->id,
                    'role' => $user->role,
                    'name' => $user->name
                ]);
                $decoded = validate_jwt($token);

                if (!$decoded) {
                    show_error('Token validation failed', 401);
                }
                // for checking jwt token creation
                set_cookie([
                    'name'     => 'jwt_token',
                    'value'    => $token,
                    'expire'   => 3600,
                    'httponly' => true,
                    'secure'   => false
                ]);

                $this->session->set_userdata([
                    'user_id'   => $decoded->data->id,
                    'name'      => $decoded->data->name,
                    'role'      => $decoded->data->role,
                    'logged_in' => true
                ]);

                redirect('dashboard');
            } else {
                $data['error'] = "Invalid Email or Password";
            }
        }

        $this->load->view('auth/login', @$data);
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}