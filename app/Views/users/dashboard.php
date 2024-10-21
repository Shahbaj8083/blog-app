<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .dashboard-container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome to the Dashboard!</h2>
        <p>You are logged in as <?= session()->get('username'); ?></p>
        <form action="<?= site_url('logout') ?>" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>
