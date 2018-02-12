<?php require_once 'members.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>

</head>
<body>


    <?php if ($this->session->flashdata('signup_failed')) { ?>

    <div class="col-lg-12 alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>Sign Up failed! please try again</div>

    <?php } ?>


    <?php if ($this->session->flashdata('signup_error')) { ?>

    <div class="col-lg-12 alert alert-danger text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>Signup failed! Please try again </div>

    <?php } ?>


    <?php if ($this->session->flashdata('signup_success')) { ?>

    <div class="col-lg-12 alert alert-success text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>Confirmation Link was sent to your email</div>

    <?php } ?>
    <br /><br />

    <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
            <div class="well bs-component">
              <?php echo form_open('main/signup_validation'); ?>
                <fieldset>
                  <legend class="text-center">Sign Up</legend>
                  <div class="form-group">
                    <label for="inputUsername" class="control-label">Username</label>
                    <div>
                      <input name="username" type="text" class="form-control" placeholder="Enter Username">
                      <?php echo form_error('username', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="control-label">Email</label>
                    <div>
                      <input name="email" type="email" class="form-control" placeholder="Enter Email">
                      <?php echo form_error('email', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="control-label">Password</label>
                    <div>
                      <input name="password" type="password" class="form-control" placeholder="Enter Password">
                      <?php echo form_error('password', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputConfirmPassword" class="control-label">Confirm Password</label>
                    <div>
                      <input name="cpassword" type="password" class="form-control" placeholder="Confirm Password">
                      <?php echo form_error('cpassword', '<p class="text-danger error">', '</p>'); ?>
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