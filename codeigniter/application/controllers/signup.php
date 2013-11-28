<?php
class Signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    #ユーザー登録画面
    public function index()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');

        if ($this->session->userdata('username') != false){
            redirect('/mypage', 'location');
        }

        $page['title'] = 'ユーザー登録';
        $page['message'] = '';
        $page['username'] = $this->session->userdata('username');
        $page['name'] = $this->input->post('name');
        $page['address'] = $this->input->post('address');
        $page['password'] = $this->input->post('pass');

        $this->form_validation->set_rules('name', '名前', 'trim|required');
        $this->form_validation->set_rules('address', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'パスワード', 'trim|required|alpha_numeric|min_length[6]');

        $err_message = $this->input_check();

        if ($err_message != 'OK'){
        #登録失敗
            $page['message'] = $err_message;
            $this->load->view('twitter/templates/header', $page);
            $this->load->view('twitter/signup', $page);
            $this->load->view('twitter/templates/footer');
        }else{
        #登録成功
            $newdata = array(
                'username' => $page['name']
            );

            $this->session->set_userdata($newdata);
            redirect('/mypage', 'location');
        }
    }

    #登録できるかチェックする。
    #できなければ、理由を書いた文字列を返す
    #できれば、'OK'を返す
    private function input_check(){
        if ($this->form_validation->run() === false){
            #入力構文エラーの場合は自動でエラー文が生成されるので、""を返す。
            return "";
        }else{
            $signup_data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'password' => $this->input->post('pass')
            );

            if (!$this->user_model->signup($signup_data)){
                return 'そのメールアドレスは既に登録されています。';
            }else{
                return 'OK';
            }
        }
    }
}

