<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- @autor Pavle Smakic 2019/0347
     @autor Andreja Djokic 2020/0274
-->
<link href="/assets/css/register.css" rel="stylesheet">

<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center text-dark mt-5">Sign In Form</h2>
      
      <div class="card my-5">

        <form name="register_form" action="<?= site_url("Gost/register_check") ?>" method="post"  class="card-body cardbody-color p-lg-5">


          <div class="mb-3">
            <input type="text" class="form-control" id="Name" name="name" value="<?= set_value('name') ?>" placeholder="Name*"><p>
                <font color="red">
                    <?php if(!empty($errors['name'])) 
                        echo $errors['name'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
              <input type="text" class="form-control" id="Surname" name="surname" value="<?= set_value('surname') ?>" placeholder="Surname*"><p>
                <font color="red">
                    <?php if(!empty($errors['surname'])) 
                        echo $errors['surname'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="korime" name="korime" value="<?= set_value('korime') ?>" placeholder="Username*"><p>
                <font color="red">
                    <?php if(!empty($errors['korime'])) 
                        echo $errors['korime'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
              <input type="text" class="form-control" id="Country" name="country" value="<?= set_value('country') ?>" placeholder="Country*"><p>
                <font color="red">
                    <?php if(!empty($errors['country'])) 
                        echo $errors['country'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="Email" name="email" value="<?= set_value('email') ?>" aria-describedby="emailHelp" placeholder="Email*">
            <p>
                <font color="red">
                    <?php if(!empty($errors['email'])) 
                        echo $errors['email'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
              <input type="password" class="form-control" id="password" name="password_" value="<?= set_value('password_') ?>" placeholder="Password*"><p>
                <font color="red">
                    <?php if(!empty($errors['password_'])) 
                        echo $errors['password_'];
                    ?>
                </font>
            </p>
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password" name="repeat_password" placeholder="Repeat Password*"><p>
                <font color="red">
                    <?php if(!empty($errors['repeat_password'])) 
                        echo $errors['repeat_password'];
                    ?>
                </font>
            </p>
          </div>
          <div>
                <?php if(isset($poruka)) echo "<font color='red'>$poruka</font><br>"; ?>
          </div>
          <div class="text-center"><button type="submit" class="btn btn-color btn-success px-5 mb-5 w-100">Sign In</button></div>
          <div id="emailHelp" class="form-text text-center mb-5 text-dark">Already have an Account?
            <a href="<?= site_url("Gost/login")?>" class="text-dark fw-bold "> <u>Log In</u>
              </a>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>
