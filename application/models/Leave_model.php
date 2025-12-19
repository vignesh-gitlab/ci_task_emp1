<?php
class Leave_model extends CI_Model
{
    //Check overlapped leaves
    public function hasOverlap($user_id, $from, $to)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('from_date <=', $to);
        $this->db->where('to_date >=', $from);
        return $this->db->get('leaves')->num_rows() > 0;
    }

    //Count leaves in current month
    public function countMonthlyLeaves($user_id, $from)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('MONTH(from_date)', date('m', strtotime($from)))
            ->where('YEAR(from_date)', date('Y', strtotime($from)))
            ->count_all_results('leaves');
    }

    public function insert($data)
    {
        return $this->db->insert('leaves', $data);
    }

    public function getMyLeaves($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('id', 'DESC')
            ->get('leaves')->result();
    }
}