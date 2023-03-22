<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/vendors/feather/feather.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/mdi/css/materialdesignicons.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/ti-icons/css/themify-icons.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/typicons/typicons.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/simple-line-icons/css/simple-line-icons.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/css/vendor.bundle.base.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/vertical-layout-light/style.css") ?>">
    <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.png") ?>" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <?= $this->renderSection("content"); ?>
        </div>
    </div>
    <script src="<?= base_url("assets/vendors/js/vendor.bundle.base.js") ?>"></script>
    <script src="<?= base_url("assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/off-canvas.js") ?>"></script>
    <script src="<?= base_url("assets/js/hoverable-collapse.js") ?>"></script>
    <script src="<?= base_url("assets/js/template.js") ?>"></script>
    <script src="<?= base_url("assets/js/settings.js") ?>"></script>
    <script src="<?= base_url("assets/js/todolist.js") ?>"></script>
</body>

</html>