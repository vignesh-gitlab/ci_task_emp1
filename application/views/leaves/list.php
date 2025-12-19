<?php $this->load->view('partials/header'); ?>
<h4>My Leave History</h4>

<table class="table table-bordered">
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Days</th>
        <th>Reason</th>
    </tr>

    <?php foreach ($leaves as $l): ?>
    <tr>
        <td><?= $l->from_date ?></td>
        <td><?= $l->to_date ?></td>
        <td><?= $l->leave_days ?></td>
        <td><?= $l->reason ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php $this->load->view('partials/footer'); ?>