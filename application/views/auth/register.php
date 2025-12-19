<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card col-md-5 mx-auto">
            <div class="card-body">
                <h4 class="text-center">Register</h4>

                <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>

                <form method="post">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name">
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password">

                    <select name="role" class="form-control mb-2">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                    </select>

                    <button class="btn btn-primary w-100">Register</button>
                    <a href="<?= base_url('auth/login') ?>" class="d-block text-center mt-2">Login</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>