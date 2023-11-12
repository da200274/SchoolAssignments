<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- @autor Pavle Smakic 2019/0347 -->
<link href="<?php echo base_url();?>/assets/css/dodajzivotinju.css" rel="stylesheet">
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center text-dark mt-5">ADD ANIMAL FORM</h2>
        <hr class="w-25 mx-auto bg-primary">
        <h4 class="text-center text-dark mt-5">This form is meant for you to add a completely new animal in the landscape you previously entered.</h4>

      <div class="card my-5">

        <?= form_open_multipart('Editor/posaljizahtevzivotinja','class="card-body cardbody-color p-lg-5"') ?>
        <div class="mb-3">
          <input type="text" class="form-control" id="naziv" aria-describedby="emailHelp"
                 placeholder="Animal name" name="zime">
        </div>
        <div class="mb-3">
          <input type="text" class="form-control" id="latinskinaziv" placeholder="Latin name" name="zlime">
        </div>
        <div class="mb-3 form-floating">
          <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="zopis"></textarea>
          <label for="floatingTextarea">Description</label>
        </div>
        <div class="mb-3 form-floating">
          <input type="file" name='zimg' size="20">
        </div>
        <div class="mb-3 form-floating">
          <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="zkom"></textarea>
          <label for="floatingTextarea">Comment</label>
        </div>
        <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Add</button></div>
        <div class="er">
          <?php if(isset($errors)) echo "<font color='red'>$errors</font><br>"; ?>
        </div>

        </form>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>