<?php $this->load->view('partials/header'); ?>

<h3>Welcome, <?= $this->session->userdata('name') ?></h3>

<h3>Dashboard</h3>

<div class="row">

    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5>Total Tasks</h5>
                <h2><?= $total_tasks ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5>Pending Tasks</h5>
                <h2><?= $pending_tasks ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5>Completed Tasks</h5>
                <h2><?= $completed_tasks ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5>Leaves This Month</h5>
                <h2><?= $leaves_this_month ?></h2>
            </div>
        </div>
    </div>

</div>

<div class="card mt-4">
    <div class="card-header">
        Priority Based Task Statistics
    </div>
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>Priority</th>
                <th>Total Tasks</th>
            </tr>

            <?php foreach ($priority_stats as $p): ?>
            <tr>
                <td><?= $p->priority ?></td>
                <td><?= $p->total ?></td>
            </tr>
            <?php endforeach; ?>

        </table>

    </div>
</div>

<?php $this->load->view('partials/footer'); ?>