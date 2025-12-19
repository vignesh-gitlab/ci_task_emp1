<h2>Welcome <?= $this->session->userdata('name'); ?></h2>
<p>Role: <?= $this->session->userdata('role'); ?></p>
<a href="<?= base_url('auth/logout'); ?>">Logout</a>