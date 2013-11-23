<?php
class Twitter extends CI_Controller
{
    #ログイン画面
    public function signin()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'ログイン';
        $data['message'] = '';

        $this->form_validation->set_rules('address', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'パスワード', 'trim|required|alpha_numeric|min_length[6]');

        if ($this->form_validation->run() === false)
        {
            $this->load->view('twitter/templates/header', $data);
            $this->load->view('twitter/signin', $data);
            $this->load->view('twitter/templates/footer');
        }
        else
        {
            if ($this->confirm() === null)
            #認証失敗
            {
                $data['message'] =
                    'メールアドレスとパスワードの組み合わせが間違っているようです。';

                $this->load->view('twitter/templates/header', $data);
                $this->load->view('twitter/signin', $data);
                $this->load->view('twitter/templates/footer');
            }
            else
            #認証成功
            {
                $this->load->view('twitter/templates/header', $data);
                $this->load->view('twitter/home', $data);
                $this->load->view('twitter/templates/footer');
            }
        }
    }

    #ユーザー登録画面
    public function signup()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'ユーザー登録';
        $data['message'] = '';

        $this->form_validation->set_rules('name', '名前', 'trim|required');
        $this->form_validation->set_rules('address', 'メールアドレス', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass', 'パスワード', 'trim|required|alpha_numeric|min_length[6]');

        if ($this->form_validation->run() === false)
        {
            $this->load->view('twitter/templates/header', $data);
            $this->load->view('twitter/signup', $data);
            $this->load->view('twitter/templates/footer');
        }
        else
        {
            if ($this->register() === null)
            #登録失敗
            {
                $data['message'] = 'そのメールアドレスは既に登録されています。';

                $this->load->view('twitter/templates/header', $data);
                $this->load->view('twitter/signup', $data);
                $this->load->view('twitter/templates/footer');
            }
            else
            #登録成功
            {
                $this->load->view('twitter/templates/header', $data);
                $this->load->view('twitter/home', $data);
                $this->load->view('twitter/templates/footer');
            }
        }
    }

    #投稿&一覧画面
    public function home()
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


###############以下、private関数##################

    #ユーザー認証用の関数
    #認証が成功した場合はアカウントIDを返す
    #認証が失敗した場合はnullを返す
    private function confirm()
    {
        return 1;
    }

    #ユーザー登録用の関数
    #登録が成功した場合は作成されたアカウントIDを返す
    #登録が失敗した場合はnullを返す
    private function register()
    {
        return 1;
    }
}

