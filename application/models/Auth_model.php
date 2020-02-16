<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function insertUser()
    {
    }

    private function _sendEmail()
    {
        $confiq = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'codeigniter.app22',
            'smtp_pass' => 'Andung22',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $confiq);

        $this->email->from('codeigniter.app22', 'My Website');
        $this->email->to('andung2209@gmail.com');
        $this->email->subject('testing');
        $this->email->message('hellowordl');

        if ($this->email->send()) {
            return true;
        } else {
            # code...
            echo $this->email->print_debugger();
            die;
        }
    }
}
