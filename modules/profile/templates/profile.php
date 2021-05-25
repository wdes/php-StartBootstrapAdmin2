<?php $this->render('head'); ?>

<!-- Page Heading -->
<h1 class="h3 mb-1 text-gray-800">Profile</h1>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php $this->value('username'); ?>'s profile</h6>
            </div>
            <div class="card-body">
                <form action="<?php $this->route('/user/profile'); ?>" method="POST">
                    <div class="form-group">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First name" value="<?php $this->value('first_name'); ?>" name="first_name" autocomplete="given-name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name" value="<?php $this->value('last_name'); ?>" name="last_name" autocomplete="familly-name">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New password</label>
                        <input type="password" class="form-control" id="newPassword" placeholder="New password" aria-describedby="newPassordDesc" name="password" autocomplete="new-password" value="<?php $this->value('password'); ?>" >
                        <small id="newPassordDesc" class="form-text text-muted">We do not know your current password, it is encrypted and hashed. Fill the box if you want to change your password.</small>
                    </div>
                    <div class="form-group">
                        <label for="newPasswordRepeat">Repeat new password</label>
                        <input type="password" class="form-control" id="newPasswordRepeat" placeholder="Repeat new password" name="password_check" autocomplete="new-password" value="<?php $this->value('password_check'); ?>" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->render('foot'); ?>