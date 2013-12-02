<?php
class Tweet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tweet_text', 'ツイート', 'max_length[140]|required');

        if ($this->form_validation->run() === false){
            echo json_encode(array(
                'check' => false,
                'msg' => form_error('tweet_text')
            ));
        }else{
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'text' => $this->input->post('tweet_text')
            );
            $tweet_time = $this->tweet_model->tweet($data);

            if ($tweet_time === false){
                echo json_encode(array(
                    'check' => false,
                    'msg' => 'server error'
                ));
            }else{
                echo json_encode(array(
                    'check' => true,
                    'username' => $this->session->userdata('username'),
                    'time' => $tweet_time
                ));
            }
        }
    }
}
