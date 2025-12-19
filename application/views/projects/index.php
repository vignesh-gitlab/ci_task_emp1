<?php $this->load->view('partials/header'); ?>

<h4>Projects</h4>

<a href="<?= base_url('projects/create') ?>" class="btn btn-primary mb-3">
    Create Project
</a>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>

    <?php foreach ($projects as $p): ?>
    <tr>
        <td><?= $p->name ?></td>
        <td><?= $p->description ?></td>
        <td><?= $p->start_date ?></td>
        <td><?= $p->end_date ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php $this->load->view('partials/footer'); ?>