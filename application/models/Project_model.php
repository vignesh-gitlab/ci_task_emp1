<?php
class Project_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('projects', $data);
    }

    public function getAll()
    {
        return $this->db->order_by('id', 'DESC')->get('projects')->result();
    }
}