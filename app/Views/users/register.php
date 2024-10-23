<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($user) ? 'Edit User' : 'Register' ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-5"><?= isset($user) ? 'Edit User' : 'Register' ?></h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <form action="<?= isset($user) ? site_url('user/update/' . $user['id']) : site_url('register') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name', isset($user) ? $user['name'] : '') ?>">
                <?php if (isset($errors['name'])): ?>
                    <small class="text-danger"><?= $errors['name'] ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= old('email', isset($user) ? $user['email'] : '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <small class="text-danger"><?= $errors['email'] ?></small>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= old('phone', isset($user) ? $user['phone'] : '') ?>">
                <?php if (isset($errors['phone'])): ?>
                    <small class="text-danger"><?= $errors['phone'] ?></small>
                <?php endif; ?>
            </div>
            <?php if (!isset($user)): # Only show password if creating a new user ?>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?php if (isset($errors['password'])): ?>
                        <small class="text-danger"><?= $errors['password'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    <?php if (isset($errors['password_confirm'])): ?>
                        <small class="text-danger"><?= $errors['password_confirm'] ?></small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="user_type">User Type</label>
                <select class="form-control" id="user_type" name="user_type">
                    <option value="user" <?= isset($user) && $user['user_type'] === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= isset($user) && $user['user_type'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                <?php if (isset($errors['profile_image'])): ?>
                    <small class="text-danger"><?= $errors['profile_image'] ?></small>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary"><?= isset($user) ? 'Update' : 'Register' ?></button>
            <p class="mt-3">Already have an account? <a href="<?= site_url('login') ?>">Login</a></p>
        </form>
    </div>
</body>

</html>
