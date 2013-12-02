<?php
class Gettweet extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tweet_model');
        $this->load->library('session');
    }

    public function index()
    {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'time' => $this->input->post('stored_time')
        );
        $tweetArray = $this->tweet_model->getTweet($data);
        for ($i = 0; $i < count($tweetArray); $i++){
            $tweetArray[$i]['username'] = $this->session->userdata('username');
            $date = new DateTime($tweetArray[$i]['time']);
            $tweetArray[$i]['timestamp'] = $date->format('U');
        }

        echo json_encode($tweetArray);
    }
}
