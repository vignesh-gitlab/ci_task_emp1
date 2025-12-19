<?php
class User_model extends CI_Model
{

    public function insertUser($data)
    {
        return $this->db->insert('users', $data);
    }

    public function getUserByEmail($email)
    {
        return $this->db->where('email', $email)->get('users')->row();
    }
}