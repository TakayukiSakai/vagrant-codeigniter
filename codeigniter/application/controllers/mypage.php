<?php
class Mypage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    #投稿&一覧画面
    public function index()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');

        if ($this->session->userdata('username') === false){
            redirect('/signin', 'location');
        }

        $page['title'] = 'ホーム';
        $page['message'] = '';
        $page['username'] = $this->session->userdata('username');

        $this->form_validation->set_rules('tweet', 'ツイート', 'trim|max_length[140]|required');

        if ($this->form_validation->run() === false)
        {
            $this->load->view('twitter/templates/header', $page);
            $this->load->view('twitter/home', $page);
            $this->load->view('twitter/templates/footer');
        }
        else
        #ツイート投稿
        {
            show_error("ツイートしました。");
        }
    }
}

