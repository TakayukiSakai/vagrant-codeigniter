<?php
class Signin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    #ログイン画面
    public function index()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');

        if ($this->session->userdata('username') != false){
            redirect('/mypage', 'location');
        }

        $page['title'] = 'ログイン';
        $page['message'] = '';
        $page['username'] = $this->session->userdata('username');

        $this->form_validation->set_rules('address', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'パスワード', 'trim|required|alpha_numeric|min_length[6]');

        $result = $this->input_check();

        if ($result === 0){
        #認証失敗
            #validation error
            $this->load->view('twitter/templates/head_header', $page);
            $this->load->view('twitter/templates/body_header', $page);
            $this->load->view('twitter/signin_body', $page);
            $this->load->view('twitter/templates/footer');
        }elseif ($result === 1){
            #アドレスとパスワードの不一致
            $page['message'] = 'メールアドレスとパスワードの組み合わせが間違っているようです。';
            $this->load->view('twitter/templates/head_header', $page);
            $this->load->view('twitter/templates/body_header', $page);
            $this->load->view('twitter/signin_body', $page);
            $this->load->view('twitter/templates/footer');
        }else{
        #認証成功
            $newdata = $result;
            $this->session->set_userdata($newdata);
            redirect('/mypage', 'location');
        }
    }

    #ログインできるかチェックする。
    #できれば、ユーザーIDとユーザー名が入った配列を返す
    private function input_check(){
        if ($this->form_validation->run() === false){
            #入力構文エラーの場合は自動でエラー文が生成されるので、""を返す。
            return 0;
        }else{
            $signin_data = array(
                'address' => $this->input->post('address'),
                'password' => $this->input->post('pass')
            );

            $result = $this->user_model->signin($signin_data);
            if ($result === false){
            #アドレスとパスワードが不一致
                return 1;
            }else{
                return $result;
            }
        }
    }
}

