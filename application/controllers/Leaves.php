<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leaves extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (
            !$this->session->userdata('logged_in') ||
            $this->session->userdata('role') != 'employee'
        ) {
            redirect('auth/login');
        }
        $this->load->model('Leave_model');
        $this->load->library('form_validation');
    }

    public function apply()
    {
        if ($this->input->post()) {

            $this->form_validation->set_rules('from_date', 'From Date', 'required');
            $this->form_validation->set_rules('to_date', 'To Date', 'required');
            $this->form_validation->set_rules('reason', 'Reason', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('leaves/apply');
            }

            $from = $this->input->post('from_date');
            $to   = $this->input->post('to_date');
            $user = $this->session->userdata('user_id');

            //Past date not allowed
            if ($from < date('Y-m-d')) {
                $this->session->set_flashdata('error', 'Past dates not allowed');
                redirect('leaves/apply');
            }
            //Overlapped leave
            if ($this->Leave_model->hasOverlap($user, $from, $to)) {
                $this->session->set_flashdata('error', 'Leave dates overlap');
                redirect('leaves/apply');
            }

            //Max 2 leaves/month
            if ($this->Leave_model->countMonthlyLeaves($user, $from) >= 2) {
                $this->session->set_flashdata('error', 'Max 2 leaves per month allowed');
                redirect('leaves/apply');
            }
            //Leave without weekends
            $leave_days = $this->calculateLeaveDays($from, $to);

            if ($leave_days <= 0) {
                $this->session->set_flashdata('error', 'No valid working days selected');
                redirect('leaves/apply');
            }

            $this->Leave_model->insert([
                'user_id' => $user,
                'from_date' => $from,
                'to_date' => $to,
                'leave_days' => $leave_days,
                'reason' => $this->input->post('reason')
            ]);

            $this->session->set_flashdata('success', 'Leave applied successfully');
            redirect('leaves/myLeaves');
        }

        $this->load->view('leaves/apply');
    }

    public function myLeaves()
    {
        $data['leaves'] = $this->Leave_model->getMyLeaves(
            $this->session->userdata('user_id')
        );
        $this->load->view('leaves/list', $data);
    }

    private function calculateLeaveDays($from, $to)
    {
        $days = 0;
        while (strtotime($from) <= strtotime($to)) {
            $day = date('N', strtotime($from));
            if ($day != 6 && $day != 7) {
                $days++;
            }
            $from = date('Y-m-d', strtotime('+1 day', strtotime($from)));
        }
        return $days;
    }
}