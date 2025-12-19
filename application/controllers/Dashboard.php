<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $role    = $this->session->userdata('role');
        $data['total_tasks']      = $this->Dashboard_model->totalTasks($user_id, $role);
        $data['pending_tasks']    = $this->Dashboard_model->pendingTasks($user_id, $role);
        $data['completed_tasks']  = $this->Dashboard_model->completedTasks($user_id, $role);
        $data['priority_stats']   = $this->Dashboard_model->priorityStats($user_id, $role);
        $data['leaves_this_month'] = $this->Dashboard_model->leavesThisMonth($user_id);

        $this->load->view('dashboard/index', $data);
    }
}