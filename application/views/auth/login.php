<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card col-md-4 mx-auto">
            <div class="card-body">
                <h4 class="text-center">Login</h4>

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="post">
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password">

                    <button class="btn btn-success w-100">Login</button>
                    <a href="<?= base_url('auth/register') ?>" class="d-block text-center mt-2">Register</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>