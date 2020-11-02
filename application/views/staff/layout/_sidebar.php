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
      <li <?php if($this->uri->segment(2) === 'home'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>staff/home"><i class="fas fa-fire"></i> <span>Dasbor</span></a></li>
      <li class="menu-header">Master Data</li>
      <li <?php if($this->uri->segment(2) === 'kontak'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>staff/kontak"><i class="fas fa-address-book"></i> <span>Kontak</span></a></li>
      <li <?php if($this->uri->segment(2) === 'product_card'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>staff/product_card"><i class="fas fa-credit-card"></i> <span>Kartu Produk</span></a></li>
      <li <?php if($this->uri->segment(2) === 'item_material'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>staff/item_material"><i class="fas fa-cube"></i> <span>Item Bahan Baku</span></a></li>
      
      <li class="menu-header">Produksi</li>
      <li <?php if($this->uri->segment(2) === 'manufacturing'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>staff/manufacturing"><i class="fas fa-sticky-note"></i> <span>Pesanan Produksi</span></a></li>
      <li <?php if($this->uri->segment(2) === 'inventory'){echo 'class="active"';}?>><a class="nav-link" href="<?php echo base_url(); ?>staff/inventory"><i class="fas fa-cubes"></i> <span>Persediaan</span></a></li>
      
    </ul>

  </aside>
</div>

