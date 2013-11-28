<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    #認証用関数
    #認証に成功したときのみユーザー名を返す
    #それ以外のときはfalseを返す
    public function signin($data)
    {
        #一致するアドレスを探しに行く
        $query = $this->db->get_where('user', array('address' => $data['address']), 2);
        $result = $query->result_array();

        if (count($result) == 0){
        #一致するアドレスがない
            return false;
        }elseif (count($result) >= 2){
        #複数のアカウントがあった(原理的にありえない)
            return false;
        }else{
        #一致するアカウントがひとつだけあった。
        #パスワード認証へ
            if (!($result[0]['password'] ===
                $this->encrypt($data['password'], $result[0]['salt']))){
            #パスワード認証失敗
                return false;
            }else{
            #成功
                return $result[0]['name'];
            }
        }

    }

    #登録用関数
    #登録に成功したときのみtrueを返す
    #それ以外のときはfalseを返す
    public function signup($data)
    {
        $query = $this->db->get_where('user', array('address' => $data['address']), 1);
        if (count($query->result_array()) != 0)
        #既にそのメールアドレスが登録されている場合
        {
            return false;
        }
        else
        #メールアドレスが登録可能である場合
        {
            $time = date("Y-m-d H:i:s");
            #メールアドレスをもとに20文字のソルトを生成
            $salt = substr(sha1($data['address']), 10, 20);

            $data['password'] = $this->encrypt($data['password'], $salt);
            $data['signup_time'] = $time;
            $data['salt'] = $salt;
            return $this->db->insert('user', $data);
        }
    }

    #暗号化
    #ソルトとストレッチングを行う
    private function encrypt($string, $salt)
    {
        $stretch = 100;

        for ($i = 0; $i < $stretch; $i++){
            $string = hash('sha256', $string . $salt);
        }
        return $string;
    }
}
