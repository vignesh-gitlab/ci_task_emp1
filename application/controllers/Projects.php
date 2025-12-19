<?php
class Projects extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 'admin') {
            show_error('Access Denied');
        }
        $this->load->model('Project_model');
    }

    public function index()
    {
        $data['projects'] = $this->Project_model->getAll();
        $this->load->view('projects/index', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run()) {
                $this->Project_model->insert([
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
                    'created_by' => $this->session->userdata('user_id')
                ]);
                redirect('projects');
            }
        }
        $this->load->view('projects/create');
    }
}