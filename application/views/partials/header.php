<!DOCTYPE html>
<html>

<head>
    <title>Project Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">

            <a class="navbar-brand" href="<?= base_url('dashboard') ?>">PMS</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a>
                </li>

                <?php if ($this->session->userdata('role') == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('projects') ?>">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('tasks') ?>">Tasks</a>
                </li>
                <?php endif; ?>

                <?php if ($this->session->userdata('role') == 'employee'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('tasks') ?>">My Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('leaves/apply') ?>">Apply Leave</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('leaves/myLeaves') ?>">My Leaves</a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-warning" href="<?= base_url('auth/logout') ?>">Logout</a>
                </li>

            </ul>
        </div>
    </nav>

    <div class="container mt-4">