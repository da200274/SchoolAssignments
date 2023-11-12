<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<link href="/assets/css/login.css" rel="stylesheet">

    <!-- @autor Pavle Smakic 2019/0347
        @autor Andreja Djokic 2020/0274
    -->
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center text-dark mt-5">Login Form</h2>
      
      <div class="card my-5">

        <form name="login_form" action="<?= site_url("Gost/login_check") ?>" method="post" class="card-body cardbody-color p-lg-5">

          <div class="text-center">
            <img src="/assets/img/logo-removebg-preview.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
              width="200px" alt="profile">
          </div>

          <div class="mb-3">
            <input type="text" class="form-control" id="Username" name="username" value="<?= set_value('username') ?>" placeholder="Username">
            <p>
                <font color="red">
                    <?php if(!empty($errors['username'])) 
                        echo $errors['username'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password') ?>" placeholder="Password">
            <p>
                <font color='red'>
                    <?php
                    if(!empty($errors['password'])) 
                        echo $errors['password'];
                    ?>
                </font>
            </p>
          </div>
          <div>
                <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
          </div>
          <div class="text-center">
                <button type="submit" class="btn btn-color btn-lg btn-success">
                    Login
                </button>
          </div>
          <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not Registered? 
              <a href="<?= site_url("Gost/register")?>" class="text-dark fw-bold">
                  <u>Create an account</u>
              </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

