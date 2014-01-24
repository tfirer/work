<?php

class Community_model extends CI_Model {
    private $_TABLE = 't_community_eri_compare';
    function __construct() {
        parent::__construct();
    }

    public function is_duplicitous_post($token) {
        $this->db->where('token', $token);
        $query = $this->db->get($this->_TABLE);
        return $query->num_rows() ? true : false;
    }

    public function insert($data) {
        return $this->db->insert($this->_TABLE, $data);
    }
    
    public function dump_communities() {
        $this->db->order_by('time');
        $query = $this->db->get($this->_TABLE);
        if ($query->num_rows()) return $query->result();
        return null;
    }
    
}

/* End of file */
