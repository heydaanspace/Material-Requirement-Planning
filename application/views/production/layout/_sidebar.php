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
      <li <?php if($this->uri->segment(2) === 'home'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/home"><i class="fas fa-fire"></i> <span>Dasbor</span></a></li>
      <li class="menu-header">Master Data</li>
      <li <?php if($this->uri->segment(2) === 'kontak'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/kontak"><i class="fas fa-address-book"></i> <span>Kontak</span></a></li>
      <li <?php if($this->uri->segment(2) === 'product_card'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/product_card"><i class="fas fa-credit-card"></i> <span>Kartu Produk</span></a></li>
      <li <?php if($this->uri->segment(2) === 'item_material'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/item_material"><i class="fas fa-cube"></i> <span>Item Bahan Baku</span></a></li>
      
      <li class="menu-header">Produksi</li>
      <li <?php if($this->uri->segment(2) === 'manufacturing'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/manufacturing"><i class="fas fa-sticky-note"></i> <span>Pesanan Produksi</span></a></li>
      <li <?php if($this->uri->segment(2) === 'inventory'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/inventory"><i class="fas fa-cubes"></i> <span>Persediaan</span></a></li>
      <li <?php if($this->uri->segment(2) === 'mrp'){echo 'class="active"';}?>><a class="nav-link"  href="<?php echo base_url(); ?>production/mrp"><i class="fas fa-calculator"></i> <span>MRP</span></a></li>
      <li <?php if($this->uri->segment(2) === 'purchase_order'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/purchase_order"><i class="fas fa-shopping-basket"></i> <span>Pesanan Pembelian</span></a></li>
      
      <li class="menu-header"></li>
      <li <?php if($this->uri->segment(2) === 'report'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/report"><i class="fas fa-book"></i> <span>Laporan</span></a></li>
      <li <?php if($this->uri->segment(2) === 'setting'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>production/setting"><i class="fas fa-cogs"></i> <span>Pengaturan</span></a></li>
    </ul>

  </aside>
</div>

