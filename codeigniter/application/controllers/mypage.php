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
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');

        if ($this->session->userdata('username') === false
            || $this->session->userdata('user_id') === false){
            $this->session->sess_destroy();
            redirect('/signin', 'location');
        }

        $page['title'] = 'ホーム';
        $page['message'] = '';
        $page['username'] = $this->session->userdata('username');

        $this->form_validation->set_rules('tweet_text', 'ツイート', 'max_length[140]|required');

        if ($this->form_validation->run() === false)
        {
            $this->load->view('twitter/templates/head_header', $page);
            $this->load->view('twitter/mypage_head', $page);
            $this->load->view('twitter/templates/body_header', $page);
            $this->load->view('twitter/mypage_body', $page);
            $this->load->view('twitter/templates/footer');
        }
        else
        #ツイート投稿
        {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'text' => $this->input->post('tweet_text')
            );
            $this->tweet_model->tweet($data);
            $this->load->view('twitter/templates/head_header', $page);
            $this->load->view('twitter/mypage_head', $page);
            $this->load->view('twitter/templates/body_header', $page);
            $this->load->view('twitter/mypage_body', $page);
            $this->load->view('twitter/templates/footer');
        }
    }
}

