<?php
class Tasks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model(['Task_model', 'Project_model', 'Comment_model']);
    }

    // public function index()
    // {
    //     $data['tasks'] = $this->Task_model->getTasks(
    //         $this->session->userdata('user_id'),
    //         $this->session->userdata('role')
    //     );
    //     $this->load->view('tasks/index', $data);
    // }
    public function index()
    {
        $this->load->library('pagination');

        $limit = 5;
        $page  = $this->uri->segment(3);
        $offset = $page ? $page : 0;

        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');

        if ($role == 'admin') {
            $total_rows = $this->Task_model->countAllTasks();
            $tasks = $this->Task_model->getAllTasks($limit, $offset);
        } else {
            $total_rows = $this->Task_model->countUserTasks($user_id);
            $tasks = $this->Task_model->getUserTasks($user_id, $limit, $offset);
        }

        $config['base_url'] = base_url('tasks/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;

        $config['full_tag_open']   = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close']  = '</ul></nav>';

        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
        $config['first_tag_open']  = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';

        $config['prev_link']       = '&laquo;';
        $config['prev_tag_open']   = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';

        $config['next_link']       = '&raquo;';
        $config['next_tag_open']   = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '</span></li>';

        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';

        $config['attributes']      = ['class' => 'page-link'];


        $this->pagination->initialize($config);

        $data['tasks'] = $tasks;
        $data['pagination'] = $this->pagination->create_links();
        $data['offset'] = $offset;

        $this->load->view('tasks/index', $data);
    }


    public function create()
    {
        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            if ($this->form_validation->run()) {
                $this->Task_model->insert([
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'project_id' => $this->input->post('project_id'),
                    'assigned_to' => $this->input->post('assigned_to'),
                    'priority' => $this->input->post('priority'),
                    'status' => $this->input->post('status'),
                    'created_by' => $this->session->userdata('user_id')
                ]);
                redirect('tasks');
            }
        }
        $data['projects'] = $this->Project_model->getAll();
        $data['users'] = $this->db->where('role', 'employee')->get('users')->result();
        $this->load->view('tasks/create', $data);
    }

    public function updateStatus()
    {
        $this->Task_model->updateStatus(
            $this->input->post('task_id'),
            $this->input->post('status'),
            $this->session->userdata('user_id')
        );
        redirect('tasks');
    }

    public function comments($task_id)
    {
        if ($this->input->post()) {
            $this->Comment_model->add([
                'task_id' => $task_id,
                'user_id' => $this->session->userdata('user_id'),
                'comment' => $this->input->post('comment')
            ]);
        }
        $data['comments'] = $this->Comment_model->getByTask($task_id);
        $this->load->view('tasks/comments', $data);
    }

    public function ajaxList()
    {
        $limit = 5;
        $page  = $this->input->get('page') ?? 1;
        $offset = ($page - 1) * $limit;

        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');

        if ($role == 'admin') {
            $total_rows = $this->Task_model->countAllTasks();
            $tasks = $this->Task_model->getAllTasks($limit, $offset);
        } else {
            $total_rows = $this->Task_model->countUserTasks($user_id);
            $tasks = $this->Task_model->getUserTasks($user_id, $limit, $offset);
        }

        $pagination = $this->_ajaxPagination($total_rows, $limit, $page);

        echo json_encode([
            'tasks' => $tasks,
            'pagination' => $pagination,
            'offset' => $offset
        ]);
    }

    private function _ajaxPagination($total, $limit, $page)
    {
        $pages = ceil($total / $limit);
        $html = '<nav><ul class="pagination justify-content-end">';

        if ($page > 1) {
            $html .= '<li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadTasks(' . ($page - 1) . ')">&laquo;</a>
                  </li>';
        }

        for ($i = 1; $i <= $pages; $i++) {
            $active = $i == $page ? 'active' : '';
            $html .= '<li class="page-item ' . $active . '">
                    <a class="page-link" href="javascript:void(0)" onclick="loadTasks(' . $i . ')">' . $i . '</a>
                  </li>';
        }

        if ($page < $pages) {
            $html .= '<li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadTasks(' . ($page + 1) . ')">&raquo;</a>
                  </li>';
        }

        $html .= '</ul></nav>';
        return $html;
    }
}