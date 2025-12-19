<?php
class Dashboard_model extends CI_Model
{
    // Total tasks
    public function totalTasks($user_id, $role)
    {
        if ($role == 'employee') {
            $this->db->where('assigned_to', $user_id);
        }
        return $this->db->count_all_results('tasks');
    }

    //Pending tasks
    public function pendingTasks($user_id, $role)
    {
        if ($role == 'employee') {
            $this->db->where('assigned_to', $user_id);
        }
        $this->db->where('status', 'Pending');
        return $this->db->count_all_results('tasks');
    }

    //Completed tasks
    public function completedTasks($user_id, $role)
    {
        if ($role == 'employee') {
            $this->db->where('assigned_to', $user_id);
        }
        $this->db->where('status', 'Completed');
        return $this->db->count_all_results('tasks');
    }

    //Priority based stats
    public function priorityStats($user_id, $role)
    {
        if ($role == 'employee') {
            $this->db->where('assigned_to', $user_id);
        }
        return $this->db
            ->select('priority, COUNT(*) as total')
            ->group_by('priority')
            ->get('tasks')
            ->result();
    }

    //Leaves taken
    public function leavesThisMonth($user_id)
    {
        return $this->db
            ->select('IFNULL(SUM(leave_days),0) as total')
            ->where('user_id', $user_id)
            ->where('MONTH(from_date)', date('m'))
            ->where('YEAR(from_date)', date('Y'))
            ->get('leaves')
            ->row()->total;
    }
}