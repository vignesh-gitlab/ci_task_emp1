<?php
class Comment_model extends CI_Model
{
    public function add($data)
    {
        return $this->db->insert('task_comments', $data);
    }

    public function getByTask($task_id)
    {
        return $this->db
            ->select('task_comments.*,users.name')
            ->join('users', 'users.id=task_comments.user_id')
            ->where('task_id', $task_id)
            ->order_by('id', 'DESC')
            ->get('task_comments')->result();
    }
}