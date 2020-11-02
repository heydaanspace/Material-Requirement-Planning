 <div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html" style="font-weight: bold;" ><img src="<?php echo base_url();?>assets/img/main-logo.png" alt="Logo"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">MRP</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header"></li>
      <li <?php if($this->uri->segment(2) === 'home'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>owner/home"><i class="fas fa-fire"></i> <span>Dasbor</span></a></li>
      <li class="menu-header">Master Data</li>
      <li <?php if($this->uri->segment(2) === 'kontak'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>owner/kontak"><i class="fas fa-address-book"></i> <span>Kontak</span></a></li>
      <li <?php if($this->uri->segment(2) === 'users'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>owner/users"><i class="fas fa-user"></i> <span>Manajemen Pengguna</span></a></li>
      
      <li class="menu-header">Produksi</li>
      <li <?php if($this->uri->segment(2) === 'inventory'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>owner/inventory"><i class="fas fa-cubes"></i> <span>Persediaan</span></a></li>
      <li <?php if($this->uri->segment(2) === 'mrp'){echo 'class="active"';}?>><a class="nav-link"  href="<?php echo base_url(); ?>owner/mrp"><i class="fas fa-calculator"></i> <span>MRP</span></a></li>
      <li <?php if($this->uri->segment(2) === 'purchase_order'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>owner/purchase_order"><i class="fas fa-shopping-basket"></i> <span>Pesanan Pembelian</span></a></li>
      
      <li class="menu-header"></li>
      <li <?php if($this->uri->segment(2) === 'report'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>owner/report"><i class="fas fa-book"></i> <span>Laporan</span></a></li>
    </ul>

  </aside>
</div>

