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
        }

        echo json_encode($tweetArray);
#        $array = array(
#            array(
#                'username' => 'realworld',
#                'text' => '初ツイート',
#                'time' => '2013-10-26 00:00:00'
#            ),array(
#                'username' => 'realworld',
#                'text' => '二回目ツイート',
#                'time' => '2013-10-28 12:02:42'
#            )
#        );
#        echo json_encode($array);
    }
}
