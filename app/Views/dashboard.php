<!-- Content Wrapper -->
<div class="content-wrapper">

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
<div class="container-fluid">

<!-- STAT CARDS -->
<div class="row">

  <!-- Today Revenue -->
  <div class="col-lg-4 col-12">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <p class="text-muted mb-1">Today's Revenue</p>
          <h3 class="font-weight-bold">
            Rp <?= number_format($todayRevenue ?? 0, 0, ',', '.') ?>
          </h3>
          <small class="text-muted">Today</small>
        </div>
        <i class="fas fa-dollar-sign fa-2x text-warning"></i>
      </div>
    </div>
  </div>

  <!-- Monthly Revenue -->
  <div class="col-lg-4 col-12">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <p class="text-muted mb-1">Monthly Revenue</p>
          <h3 class="font-weight-bold">
            Rp <?= number_format($monthlyRevenue ?? 0, 0, ',', '.') ?>
          </h3>
          <small class="text-muted">This Month</small>
        </div>
        <i class="fas fa-chart-line fa-2x text-success"></i>
      </div>
    </div>
  </div>

  <!-- Total Orders -->
  <div class="col-lg-4 col-12">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <div>
          <p class="text-muted mb-1">Total Orders</p>
          <h3 class="font-weight-bold"><?= $totalOrders ?? 0 ?></h3>
          <small class="text-muted">All Time</small>
        </div>
        <i class="fas fa-shopping-cart fa-2x text-primary"></i>
      </div>
    </div>
  </div>

</div> <!-- END ROW -->

<!-- CHARTS -->
<div class="row mt-4">

  <!-- Revenue Trend -->
  <div class="col-lg-8 col-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5>Revenue Trend</h5>
        <p class="text-muted">Last 7 days of revenue</p>
        <canvas id="revenueChart"></canvas>
      </div>
    </div>
  </div>

  <!-- Sales by Category -->
  <div class="col-lg-4 col-12">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5>Sales by Category</h5>
        <p class="text-muted">Item distribution</p>
        <canvas id="categoryChart"></canvas>
      </div>
    </div>
  </div>

</div>

</div>
</section>
</div>
<!-- /.content-wrapper -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
<?php
$trendDates = [];
$trendTotals = [];

if (!empty($trend)) {
  foreach ($trend as $t) {
    $trendDates[] = $t['tanggal'];
    $trendTotals[] = $t['total'];
  }
}

$catNames = [];
$catTotals = [];

if (!empty($category)) {
  foreach ($category as $c) {
    $catNames[] = $c['nama_kategori'];
    $catTotals[] = $c['total'];
  }
}
?>

// Revenue Line Chart
const revenueCtx = document.getElementById('revenueChart');
new Chart(revenueCtx, {
  type: 'line',
  data: {
    labels: <?= json_encode($trendDates) ?>,
    datasets: [{
      label: 'Revenue',
      data: <?= json_encode($trendTotals) ?>,
      borderColor: '#ff6b00',
      backgroundColor: 'rgba(255,107,0,0.2)',
      borderWidth: 2,
      tension: 0.3,
      fill: true
    }]
  }
});

// Category Pie Chart
const categoryCtx = document.getElementById('categoryChart');
new Chart(categoryCtx, {
  type: 'pie',
  data: {
    labels: <?= json_encode($catNames) ?>,
    datasets: [{
      data: <?= json_encode($catTotals) ?>,
      backgroundColor: ['#ff6b00','#ff9f40','#ffc107','#4caf50','#2196f3','#9c27b0'],
      borderWidth: 1
    }]
  }
});
</script>