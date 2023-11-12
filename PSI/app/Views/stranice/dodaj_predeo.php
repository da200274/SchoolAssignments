<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- @autor Pavle Smakic 2019/0347 -->
<link href="<?php echo base_url();?>/assets/css/dodajpredeo.css" rel="stylesheet">
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center text-dark mt-5">ADD LAND FORM</h2>
        <hr class="w-25 mx-auto bg-primary">
        <h4 class="text-center text-dark mt-5">This is the most interesting form because you can add a whole new landscape. Be careful
        to fill in all the needed form fields.</h4>

      <div class="card my-5">

        <?= form_open_multipart('Editor/posaljizahtevpredeo','class="card-body cardbody-color p-lg-5"') ?>
        <div class="mb-3 form-floating">
          <input type="text" class="form-control" id="naziv" aria-describedby="emailHelp"
                 placeholder="Naziv predela" name="pime">
          <label for="floatingTextarea">Landscape name</label>
        </div>

        <div class="mb-3 form-floating">
          <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="popis"></textarea>
          <label for="floatingTextarea">Description</label>

        </div>

        <div class="mb-3 form-floating">
          <input type="file"  size="20" name="pimg">
        </div>

        <h3 class="text-center">Add Animal</h3>

        <div class="mb-3 form-floating">
          <input type="text" class="form-control" id="naziv" aria-describedby="emailHelp"
                 placeholder="Naziv Zivotinje" name="zime">
          <label for="floatingTextarea">Animal name</label>
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