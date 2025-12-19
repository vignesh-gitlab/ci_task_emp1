<?php $this->load->view('partials/header'); ?>

<h4>Tasks</h4>

<a href="<?= base_url('tasks/create') ?>" class="btn btn-success mb-3">
    Create Task
</a>

<table class="table table-bordered">
    <tr>
        <th>S.No</th>
        <th>Title</th>
        <th>Project</th>
        <th>Assigned To</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <tbody id="taskBody">
    </tbody>
</table>
<div id="pagination"></div>

<?php $this->load->view('partials/footer'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function loadTasks(page = 1) {
    $.get("<?= base_url('tasks/ajaxList') ?>", {
        page: page
    }, function(res) {

        let data = JSON.parse(res);
        let rows = '';
        let i = data.offset + 1;
        let role = "<?= $this->session->userdata('role') ?>";

        $.each(data.tasks, function(_, t) {

            let actionTd = '';
            if (role === 'employee') {
                actionTd += `
                <form method="post" action="<?= base_url('tasks/updateStatus') ?>">
                    <input type="hidden" name="task_id" value="${t.id}">
                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm mb-1">
                        <option ${t.status=='Pending'?'selected':''}>Pending</option>
                        <option ${t.status=='In Progress'?'selected':''}>In Progress</option>
                        <option ${t.status=='Completed'?'selected':''}>Completed</option>
                    </select>
                </form>`;
            }
            actionTd += `
                <a href="<?= base_url('tasks/comments/') ?>${t.id}" 
                   class="btn btn-sm btn-info">
                   Comments
                </a>`;

            rows += `
            <tr>
                <td>${i++}</td>
                <td>${t.title}</td>
                <td>${t.project_name}</td>
                <td>${t.employee}</td>
                <td>${t.priority}</td>
                <td>${t.status}</td>
                <td>${actionTd}</td>
            </tr>`;
        });

        $('#taskBody').html(rows);
        $('#pagination').html(data.pagination);
    });
}

$(document).ready(function() {
    loadTasks();
});
</script>