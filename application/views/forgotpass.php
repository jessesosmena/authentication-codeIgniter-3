<?php require_once 'members.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Forgot Password</title>

</head>
<body>

    <?php if ($this->session->flashdata('password_reset')) { ?>

    <div class="col-lg-12 alert alert-success text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>Reset Password link has been sent to your email</div>

    <?php } ?>


    <?php if ($this->session->flashdata('forgot_pass_error')) { ?>

    <div class="col-lg-12 alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>There was an Error! please try again</div>

    <?php } ?>
    <br /><br />

    <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
            <div class="well bs-component">
              <?php echo form_open('main/forgotpass_validation'); ?>
                <fieldset>
                  <legend class="text-center">Enter a valid email to reset password</legend>
                  <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <div>
                      <input name="email" type="email" class="form-control" placeholder="Enter Email">
                      <?php echo form_error('email', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div>
                      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </fieldset>
              <?php echo form_close(); ?>
            </div>
          </div>

</body>
</html>