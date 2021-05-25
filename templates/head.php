<?php $this->render('base-head'); ?>
<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php $this->render('sidebar', ['site_name' => $this->getSiteName()]); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->render('topbar', ['user_display_name' => $this->getUserDisplayName()]); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php $this->render('errors'); ?>