<?php
class Twitter_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    #認証用関数
    #認証に成功したときのみtrueを返す
    #それ以外のときはfalseを返す
    public function signin()
    {
        $query = $this->db->get_where('user', array('address' => $this->input->post('address'), 'password' => sha1($this->input->post('pass'))), 2);
        return (count($query->result_array()) != 0);
    }

    #登録用関数
    #登録に成功したときのみtrueを返す
    #それ以外のときはfalseを返す
    public function signup()
    {
        $query = $this->db->get_where('user', array('address' => $this->input->post('address')), 1);
        if (count($query->result_array()) != 0)
        #既にそのメールアドレスが登録されている場合
        {
            return false;
        }
        else
        #メールアドレスが登録可能である場合
        {
            $data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'password' => sha1($this->input->post('pass'))
            );
            return $this->db->insert('user', $data);
        }


    }
}
