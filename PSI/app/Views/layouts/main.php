<!DOCTYPE html>
<html lang="en">

<head>
    <!-- @autor Andreja Djokic 2020/0274 -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $meta_title ?></title>

    <link href="/assets/css/style.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


  <link href="<?php echo base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet">
  <!-- JavaScript Libraries 
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>-->
    

</head>

<body>
    <?php if($role == "gost"): ?>
    <?php include '../app/Views/templates/header.php'; ?>
    
    <?php else: ?>
        <?php include '../app/Views/templates/header_ulogovan.php'; ?>
    <?php endif; ?>
    
    <?= $this->renderSection('content') ?>

    <?php include '../app/Views/templates/footer.php'; ?>
</body>

</html>