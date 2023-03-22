<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url("assets/vendors/feather/feather.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/mdi/css/materialdesignicons.min.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/ti-icons/css/themify-icons.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/typicons/typicons.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/simple-line-icons/css/simple-line-icons.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/vendors/css/vendor.bundle.base.css"); ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/vertical-layout-light/style.css"); ?>">
    <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.png"); ?>" />
    <!-- require for datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <?= $this->renderSection("style"); ?>
</head>

<body>
    <div class="container-scroller">
        <?= $this->include("layouts/parts/_topbar");; ?>
        <div class="container-fluid page-body-wrapper">
            <?= $this->include("layouts/parts/_sidebar");; ?>
            <div class="main-panel">

                <?= $this->renderSection("content"); ?>

                <?= $this->include("layouts/parts/_footer"); ?>
            </div>
        </div>
    </div>
    <script src="<?= base_url("assets/vendors/js/vendor.bundle.base.js"); ?>"></script>
    <script src="<?= base_url("assets/vendors/chart.js/Chart.min.js"); ?>"></script>
    <script src="<?= base_url("assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
    <script src="<?= base_url("assets/vendors/progressbar.js/progressbar.min.js"); ?>"></script>
    <script src="<?= base_url("assets/js/off-canvas.js"); ?>"></script>
    <script src="<?= base_url("assets/js/hoverable-collapse.js"); ?>"></script>
    <script src="<?= base_url("assets/js/template.js"); ?>"></script>
    <script src="<?= base_url("assets/js/settings.js"); ?>"></script>
    <script src="<?= base_url("assets/js/todolist.js"); ?>"></script>
    <script src="<?= base_url("assets/js/dashboard.js"); ?>"></script>
    <script src="<?= base_url("assets/js/Chart.roundedBarCharts.js"); ?>"></script>
    <!-- require for datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable();
        });
    </script>
    <?= $this->renderSection("script"); ?>
</body>

</html>