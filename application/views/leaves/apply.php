<?php $this->load->view('partials/header'); ?>

<h4>Apply Leave</h4>

<?php if ($this->session->flashdata('error')): ?>
<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
<?php endif; ?>

<form method="post">
    <label>From Date</label>
    <input type="date" name="from_date" class="form-control mb-2" required>

    <label>To Date</label>
    <input type="date" name="to_date" class="form-control mb-2" required>

    <label>Reason</label>
    <textarea name="reason" class="form-control mb-2" required></textarea>

    <button class="btn btn-primary w-100">Apply</button>
</form>

<a href="<?= base_url('leaves/myLeaves') ?>" class="d-block text-center mt-3">
    View My Leaves
</a>
<?php $this->load->view('partials/footer'); ?>