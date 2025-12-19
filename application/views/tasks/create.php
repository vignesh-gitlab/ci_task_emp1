<?php $this->load->view('partials/header'); ?>

<h4>Create Task</h4>

<form method="post">

    <label>Title</label>
    <input type="text" name="title" class="form-control mb-2" required>

    <label>Description</label>
    <textarea name="description" class="form-control mb-2"></textarea>

    <label>Project</label>
    <select name="project_id" class="form-control mb-2" required>
        <?php foreach ($projects as $p): ?>
        <option value="<?= $p->id ?>"><?= $p->name ?></option>
        <?php endforeach; ?>
    </select>

    <label>Assign To</label>
    <select name="assigned_to" class="form-control mb-2" required>
        <?php foreach ($users as $u): ?>
        <option value="<?= $u->id ?>"><?= $u->name ?></option>
        <?php endforeach; ?>
    </select>

    <label>Priority</label>
    <select name="priority" class="form-control mb-2">
        <option>Low</option>
        <option>Medium</option>
        <option>High</option>
    </select>

    <label>Status</label>
    <select name="status" class="form-control mb-2">
        <option>Pending</option>
        <option>In Progress</option>
        <option>Completed</option>
    </select>

    <button class="btn btn-primary">Create Task</button>
</form>

<?php $this->load->view('partials/footer'); ?>