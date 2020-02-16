<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {

            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // cek validasi gagal
        if ($this->form_validation->run() == false) {
            # code...
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            // cek user ada 
            if ($user != NULL) {
                // cek user active
                if ($user['is_active'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        // data session
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];
                        // set session 
                        $this->session->set_userdata($data);
                        if ($user['role_id'] == 1) {
                            redirect('admin');
                        } else {
                            redirect('user');
                        }
                    } else {
                        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Password Wrong! </div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Please Activated Your Account !</div>');

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Acoount Not Registrated! </div>');
                redirect('auth');
            }
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {

            redirect('user');
        }
        $data['title'] = 'Registration Page';
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password1', 'Password', 'required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            $email = $this->input->post('email', true);
            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user['email'] == $email) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Email is Ready ! </div>');
                redirect('auth/registration');
                return false;
            }

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpeg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            // siapkan token

            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');
            $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert" > check Email to Activated Account ! </div>');
            redirect(base_url());
        }
    }

    private function _sendEmail($token, $type)
    {
        $confiq = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'codeigniter.app22@gmail.com',
            'smtp_pass' => 'Andung22',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $confiq);

        $email = $this->input->post('email');


        $this->email->initialize($confiq);
        $this->email->from('codeigniter.app22@gmail.com', ' Copyright @Andi Mujur ');
        $this->email->to($email);

        if ($type == 'verify') {

            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify Account : <a href=" ' . base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token) . ' ">Activate </a> ');
        } else if ($type == 'forgot') {

            $this->email->subject('Reset Password');
            $this->email->message('Click this link to Reset Password : <a href=" ' . base_url() . 'auth/resetPassword?email=' . $email . '&token=' . urlencode($token) . ' ">reset </a> ');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user != NULL) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token != NULL) {

                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert" > ' . $email . 'Acoount activated success!</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Acoount activated failed! token expired </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Acoount activated failed! Wrong token </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" > Acoount activated failed! Wrong email </div>');
            redirect('auth');
        }
    }


    public function logout()
    {

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert" > Acoount Success Logout </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer', $data);
    }

    public function forgotPassword()
    {
        $data['title']  = 'Forget Password';
        $this->form_validation->set_rules('findemail', 'Email', 'required|trim');

        if ($this->form_validation->run() ==  FALSE) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forget-password', $data);
            $this->load->view('templates/auth_footer');
        } else {

            $email = $this->input->post('findemail');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
            if ($user != null) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                // $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert" > Check Email For reset password </div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" >Account Not Valid Or Not activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user_token', ['email' => $email]);

        if ($user != NULL) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token != NULL) {
                $this->session->set_userdata('resetPassword', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" >token Not Valid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert" >Account Not Valid!</div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Reset Password';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/forget-password', $data);
        $this->load->view('templates/auth_footer');
    }
}
