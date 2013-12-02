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

        $this->form_validation->set_rules('name', '名前', 'trim|required');
        $this->form_validation->set_rules('address', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'パスワード', 'trim|required|alpha_numeric|min_length[6]');

        $result = $this->input_check();

        if ($result === 0){
        #登録失敗
            #validation error
            $this->load->view('twitter/templates/head_header', $page);
            $this->load->view('twitter/templates/body_header', $page);
            $this->load->view('twitter/signup_body', $page);
            $this->load->view('twitter/templates/footer');
        }elseif ($result === 1){
            #メールアドレスが既に登録されていた
            $page['message'] = 'そのメールアドレスは既に登録されています。';
            $this->load->view('twitter/templates/head_header', $page);
            $this->load->view('twitter/templates/body_header', $page);
            $this->load->view('twitter/signup_body', $page);
            $this->load->view('twitter/templates/footer');
        }else{
        #登録成功
            $newdata = array(
                'user_id' => $result,
                'username' => $this->input->post('name')
            );

            $this->session->set_userdata($newdata);
            redirect('/mypage', 'location');
        }
    }

    #登録できるかチェックする。
    #できれば、ユーザーIDを返す
    private function input_check(){
        if ($this->form_validation->run() === false){
            #入力構文エラーの場合は自動でエラー文が生成されるので、""を返す。
            return 0;
        }else{
            $signup_data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'password' => $this->input->post('pass')
            );

            $result = $this->user_model->signup($signup_data);
            if ($result === false){
            #メールアドレスが既に登録されていた
                return 1;
            }else{
                return $result;
            }
        }
    }
}

