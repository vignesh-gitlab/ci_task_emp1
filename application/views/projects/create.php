<?php $this->load->view('partials/header'); ?>

<h4>Create Project</h4>

<form method="post">
    <label>Name</label>
    <input type="text" name="name" class="form-control mb-2" required>

    <label>Description</label>
    <textarea name="description" class="form-control mb-2"></textarea>

    <label>Start Date</label>
    <input type="date" name="start_date" class="form-control mb-2" required>

    <label>End Date</label>
    <input type="date" name="end_date" class="form-control mb-2" required>

    <button class="btn btn-success">Save Project</button>
</form>

<?php $this->load->view('partials/footer'); ?>