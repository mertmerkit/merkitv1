<?php require('settings.php'); ?>

<?php include('includes/header.php'); ?>
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php 
$query = "SELECT COUNT(*) AS total_mangas FROM manga";
$result = mysqli_query($connection, $query);
if($result) {
    $row = mysqli_fetch_assoc($result);
    $total_manga = $row['total_mangas'];
} else {
    $total_manga = '0';
}

$queryc = "SELECT COUNT(*) AS total_mangas FROM chapter WHERE status = 'published'";
$resultc = mysqli_query($connection, $queryc);
if($resultc) {
    $rowc = mysqli_fetch_assoc($resultc);
    $total_chapter = $rowc['total_mangas'];
} else {
    $total_chapter = '0';
}

$queryd = "SELECT COUNT(*) AS total_mangas FROM ceviri WHERE durum = '0'";
$resultd = mysqli_query($connection, $queryd);
if($resultd) {
    $rowd = mysqli_fetch_assoc($resultd);
    $total_draft = $rowd['total_mangas'];
} else {
    $total_draft = '0';
}

$queryu = "SELECT COUNT(*) AS total_mangas FROM users";
$resultu = mysqli_query($connection, $queryu);
if($resultu) {
    $rowu = mysqli_fetch_assoc($resultu);
    $total_user = $rowu['total_mangas'];
} else {
    $total_user = '0';
}
    ?>

    <?php include('includes/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                 <?php include('includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <a href="./mangas/" style='text-decoration:none' class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Mangalar </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_manga; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Yayınlanan Bölümler</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_chapter; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-section fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Earnings (Monthly) Card Example -

                        <!-- Pending Requests Card Example -->
                        <a href="./users/" style='text-decoration:none' class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Kayıtlı Kullanıcılar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_user; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-person fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Content Row -->
                    <!-- <div class="row">
                        <div class="col-xl">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>
