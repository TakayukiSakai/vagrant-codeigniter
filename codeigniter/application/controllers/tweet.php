<?php
class Tweet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('twitter_model');
    }

    #投稿&一覧画面
    public function index()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'ホーム';
        $data['message'] = '';

        $this->form_validation->set_rules('tweet', 'ツイート', 'trim|max_length[140]|required');

        if ($this->form_validation->run() === false)
        {
            $this->load->view('twitter/templates/header', $data);
            $this->load->view('twitter/home', $data);
            $this->load->view('twitter/templates/footer');
        }
        else
        #ツイート投稿
        {
            show_error("ツイートしました。");
        }
    }
}

