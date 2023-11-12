<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

    <!-- @autor Pavle Smakic 2019/0347 -->
<link href="<?php echo base_url();?>/assets/css/dodajpredeo.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">ADD PICTURE FORM</h2>
            <hr class="w-25 mx-auto bg-primary">
            <h4 class="text-center text-dark mt-5">Here you can add a new picture you took of this animal.</h4>

            <div class="card my-5">

                <?= form_open_multipart('Editor/posaljizahtevslika','class="card-body cardbody-color p-lg-5"') ?>


                <div class="mb-3 form-floating">
                    <input type="file"  size="20" name="zimg">
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

<BR><BR><BR><BR><BR>
<?= $this->endSection() ?>