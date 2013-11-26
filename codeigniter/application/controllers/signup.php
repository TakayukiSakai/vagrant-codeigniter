<?php
class Signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('twitter_model');
    }

    #ユーザー登録画面
    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

        $data['title'] = 'ユーザー登録';
        $data['message'] = '';

        $this->form_validation->set_rules('name', '名前', 'trim|required');
        $this->form_validation->set_rules('address', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'パスワード', 'trim|required|alpha_numeric|min_length[6]');

        if ($this->form_validation->run() === false)
        {
            $this->load->view('twitter/templates/header', $data);
            $this->load->view('twitter/signup', $data);
            $this->load->view('twitter/templates/footer');
        }
        else
        {
            if (!$this->twitter_model->signup())
            #登録失敗
            {
                $data['message'] = 'そのメールアドレスは既に登録されています。';

                $this->load->view('twitter/templates/header', $data);
                $this->load->view('twitter/signup', $data);
                $this->load->view('twitter/templates/footer');
            }
            else
            #登録成功
            {
                $newdata = array(
                    'username' => $this->input->post('address')
                );
                $this->session->set_userdata($newdata);
                $this->load->view('twitter/templates/header', $data);
                $this->load->view('twitter/home', $data);
                $this->load->view('twitter/templates/footer');
            }
        }

        var_dump($this->session->userdata('username'));

    }
}

