<?php require_once 'members.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reset Password</title>

</head>
<body>

    <?php if ($this->session->flashdata('reset_error')) { ?>

    <div style="width: 450px;" class="col-lg-4 col-lg-offset-4 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>There was an error! please try again</div>

    <?php } ?>

    </div>
    <br /><br />

    <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
            <div class="well bs-component">
              <?php echo form_open('main/reset_validation'); ?>
                <fieldset>
                  <legend class="text-center">Reset Password</legend>
                  <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <div>
                      <input name="email" type="email" class="form-control" placeholder="Enter Email">
                      <?php echo form_error('email', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="inputNewPassword" class="control-label">New Password</label>
                    <div>
                      <input name="npassword" type="password" class="form-control" placeholder="Enter New Password">
                      <?php echo form_error('npassword', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputConfirmNewPassword" class="control-label">Confirm Password</label>
                    <div>
                      <input name="cpassword" type="password" class="form-control" placeholder="Confirm New Password">
                      <?php echo form_error('cpassword', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div>
                      <button name="submit" type="submit" class="btn btn-primary">Reset</button>
                    </div>
                  </div>
                </fieldset>
              <?php echo form_close(); ?>
            </div>
          </div>

</body>
</html>