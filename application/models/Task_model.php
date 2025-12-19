<?php
class Task_model extends CI_Model
{
    public function insert($data)
    {
        return $this->db->insert('tasks', $data);
    }

    public function getTasks($user_id, $role)
    {
        if ($role == 'employee') {
            $this->db->where('assigned_to', $user_id);
        }
        return $this->db
            ->select('tasks.*,projects.name as project_name,users.name as employee')
            ->join('projects', 'projects.id=tasks.project_id')
            ->join('users', 'users.id=tasks.assigned_to')
            ->order_by('tasks.id', 'DESC')
            ->get('tasks')->result();
    }

    public function updateStatus($task_id, $status, $user_id)
    {
        return $this->db
            ->where('id', $task_id)
            ->where('assigned_to', $user_id)
            ->update('tasks', ['status' => $status]);
    }
    public function countAllTasks()
    {
        return $this->db->count_all('tasks');
    }

    public function countUserTasks($user_id)
    {
        return $this->db->where('assigned_to', $user_id)
            ->count_all_results('tasks');
    }

    public function getAllTasks($limit, $offset)
    {
        $this->db->select('tasks.*, projects.name as project_name, users.name as employee');
        $this->db->from('tasks');
        $this->db->join('projects', 'projects.id=tasks.project_id');
        $this->db->join('users', 'users.id=tasks.assigned_to');
        $this->db->limit($limit, $offset);
        $this->db->order_by('tasks.id', 'DESC');
        return $this->db->get()->result();
    }

    public function getUserTasks($user_id, $limit, $offset)
    {
        $this->db->select('tasks.*, projects.name as project_name, users.name as employee');
        $this->db->from('tasks');
        $this->db->join('projects', 'projects.id=tasks.project_id');
        $this->db->join('users', 'users.id=tasks.assigned_to');
        $this->db->where('tasks.assigned_to', $user_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by('tasks.id', 'DESC');
        return $this->db->get()->result();
    }
}