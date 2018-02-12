<?php require_once 'members.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Profile page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="container">

  <h3>Profile</h3>           

  <table class="table table-bordered">

    <thead>

      <tr>

        <th>User_ID</th>

        <th>Username</th>

        <th>Email</th>

        <th>Created</th>

      </tr>

    </thead>

    <tbody>

      <tr>

        <td><?php  print_r($this->session->userdata('id')); ?></td>

        <td><?php  print_r($this->session->userdata('username')); ?></td>

        <td><?php  print_r($this->session->userdata('email')); ?></td>

        <td><?php  print_r($this->session->userdata('created_at')); ?></td>

      </tr>

    </tbody>

  </table>

</div>

</body>
</html>