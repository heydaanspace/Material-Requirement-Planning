<section class="section">
  <div class="section-header">
    <h1>Laporan</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
      <div class="breadcrumb-item">Laporan</div>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-6" onclick="location.href='<?php echo base_url('production/report/moreport'); ?>';" style="cursor: pointer;">
        <div class="card card-large-icons">
          <div class="card-icon bg-primary text-white">
            <i class="fas fa-file"></i>
          </div>
          <div class="card-body">
            <h4>Laporan Manufacturing Orders</h4>
            <p>Lihat Rekap Manufacturing Orders.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6" onclick="location.href='<?php echo base_url('production/report/stokreport'); ?>';" style="cursor: pointer;">
        <div class="card card-large-icons">
          <div class="card-icon bg-primary text-white">
            <i class="fas fa-cubes"></i>
          </div>
          <div class="card-body">
            <h4>Laporan Stok</h4>
            <p>Lihat Rekap Pergerakan Stok.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6" onclick="location.href='<?php echo base_url('production/report/mrpreport'); ?>';" style="cursor: pointer;">
        <div class="card card-large-icons">
          <div class="card-icon bg-primary text-white">
            <i class="fas fa-calculator"></i>
          </div>
          <div class="card-body">
            <h4>Laporan MRP</h4>
            <p>Lihat Rincian Rekap Draft MRP.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>