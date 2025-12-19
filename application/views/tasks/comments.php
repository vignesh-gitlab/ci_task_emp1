<?php $this->load->view('partials/header'); ?>

<h4>Task Comments</h4>

<form method="post">
    <textarea name="comment" class="form-control mb-2" required></textarea>
    <button class="btn btn-primary">Add Comment</button>
</form>

<hr>

<?php foreach ($comments as $c): ?>
<p>
    <b><?= $c->name ?>:</b> <?= $c->comment ?><br>
    <small><?= $c->created_at ?></small>
</p>
<?php endforeach; ?>

<?php $this->load->view('partials/footer'); ?>