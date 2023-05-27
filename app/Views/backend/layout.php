<!DOCTYPE html>
<html lang="en" data-skin="">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="Themepixels">

    <!-- Favicon -->
    <?php echo link_tag('backend/assets/img/favicon.png', 'shortcut icon', 'image/x-icon') ?>

    <title><?php echo $title ?></title>

    <!-- Vendor CSS -->
    <?php echo link_tag('backend/lib/remixicon/fonts/remixicon.css') ?>
    <?php echo link_tag('backend/lib/jqvmap/jqvmap.min.css') ?>
    <?php echo link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') ?>
    <!-- Template CSS -->
    <?php echo link_tag('backend/assets/css/style.css') ?>
    <?php echo $this->renderSection('extraCSS') ?>
    <script type="text/javascript">
        var BASE_URL = "<?php echo base_url(); ?>",
            CURRENT_URL = "<?php echo current_url(); ?>";
    </script>
</head>

<body>
    <?php echo $this->include('backend/partials/sidebar') ?>
    <?php echo $this->include('backend/partials/header') ?>

    <div class="main main-app p-3 p-lg-4">
        <?php echo $this->renderSection('homeHeader') ?>

        <?php echo $this->renderSection('content') ?>

        <?php echo $this->include('backend/partials/footer') ?>
    </div>
    <!-- main -->

    <?php echo script_tag('backend/lib/jquery/jquery.min.js'); ?>
    <?php echo script_tag('backend/lib/bootstrap/js/bootstrap.bundle.min.js'); ?>
    <?php echo script_tag('backend/lib/perfect-scrollbar/perfect-scrollbar.min.js'); ?>
    <?php echo script_tag('backend/assets/js/script.js'); ?>
    <?php $this->renderSection('extraJS') ?>
</body>

</html>