<?php
class Mypage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->library('session');
    }

    #投稿&一覧画面
    public function index()
    {
        $this->load->helper('url');
        $this->load->helper('form');

        if ($this->session->userdata('username') === false
            || $this->session->userdata('user_id') === false){
            $this->session->sess_destroy();
            redirect('/signin', 'location');
        }

        $page['title'] = 'ホーム';
        $page['message'] = '';
        $page['username'] = htmlspecialchars($this->session->userdata('username'));
        $date = new DateTime();
        $page['timestamp'] = $date->format('U');

        $this->load->view('twitter/templates/head_header', $page);
        $this->load->view('twitter/mypage_head', $page);
        $this->load->view('twitter/templates/body_header', $page);
        $this->load->view('twitter/mypage_body', $page);
        $this->load->view('twitter/templates/footer');
    }
}

