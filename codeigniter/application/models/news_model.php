<?php
class News_model extends CI_Model
{
    public function __construct()
    {
        $config['hostname'] = 'localhost';
        $config['username'] = 'root';
        $config['password'] = '';
        $config['database'] = 'codeigniter';
        $config['dbdriver'] = 'mysql';
        $config['dbprefix'] = '';
        $config['pconnect'] = TRUE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $config['swap_pre'] = '';
        $config['autoinit'] = TRUE;
        $config['stricton'] = FALSE;
        $this->load->database($config);
    }

    public function get_news($slug = false)
    {
        if ($slug === false)
        {
            $query = $this->db->get('news');
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }

    public function set_news()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', true);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}
