<?php require_once 'members.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <style type="text/css">

  </style>

</head>
<body>


    <?php if ($this->session->flashdata('reset_success')) { ?>

    <div class="col-lg-12 alert alert-success text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>Your Password has been updated</div>

    <?php } ?>

    <?php if ($this->session->flashdata('login_failed')) { ?>

    <div style="width: 450px;" class="col-lg-4 col-lg-offset-4 alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button>Your login is not valid</div>
    
    <?php } ?>
    
    <?php if ($this->session->flashdata('logout_success')) { ?>
    <div class="col-lg-12 alert alert-success text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>You are now Logged Out  <?php  print_r($this->session->userdata('username')); ?></div>
    <?php } ?>
    </div>
    <br /><br />

    <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
            <div class="well bs-component">
              <?php echo form_open('main/login_validation'); ?>
                <fieldset>
                  <legend class="text-center">Login</legend>
                  <div class="form-group">
                    <label for="inputUser_mail" class="control-label">Email or Username</label>
                    <div>
                      <input name="user_mail" type="text" class="form-control" placeholder="Enter Email or Username">
                      <?php echo form_error('user_mail', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="control-label">Password</label>
                    <div>
                      <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Enter Password">
                      <?php echo form_error('password', '<p class="text-danger error">', '</p>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div>
                      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                      <a class="btn btn-block btn-xs" href='<?php echo base_url("main/forgotpass") ?>'>Forgot Password ?</a>
                    </div>
                  </div>
                </fieldset>
              <?php echo form_close(); ?>
            </div>
          </div>

</body>
</html>