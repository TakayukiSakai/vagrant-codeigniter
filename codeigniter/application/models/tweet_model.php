<?php
class Tweet_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    #ツイート用関数
    #tweetテーブルに１行追加。基本的には必ず成功するはず
    #成功したときに何を返すかは未定
    #万が一失敗したら、falseを返す
    public function tweet($data)
    {
        # $dataには既にuser_idとtextは入っている
        $data['time'] = date("Y-m-d H:i:s");
        return $this->db->insert('tweet', $data);
    }

    #過去のツイートを取得するための関数
    #tweetテーブルから自分のツイートを10個追加取得する
    #渡すデータはユーザーIDと既にどの時刻までのツイートまでを取得したかを表すデータ
    #返り値はツイート内容とツイート時刻を格納した長さ10の配列
    public function getTweet($data)
    {
        $cond = array(
            'user_id' => $data['user_id'],
            'time < ' => $data['time']
        );
        $this->db->where($cond);
        $this->db->select('time, text');
        $this->db->order_by('time', 'desc');
        $this->db->limit(10);
        $query = $this->db->get('tweet');
        return $query->result_array();
    }
}

