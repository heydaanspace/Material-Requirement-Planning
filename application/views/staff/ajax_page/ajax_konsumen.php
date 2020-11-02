<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th><div style="width: 100px;">Nama Lengkap</div></th>
      <th><div style="width: 100px;">Merk / Perusahaan</div></th>
      <th><div style="width: 100px;">No Telp.</div></th>
      <th><div style="width: 100px;">Email</div></th>
      <th><div style="width: 100px;">Alamat</div></th>
      <th><div style="width: 100px;">Keterangan</div></th>
      <th></th>
    </tr>
    <?php if(!empty($customer)): foreach($customer as $post): ?>
      <tr>
        <td><i class="fa fa-address-book"></i></td>
        <td><strong><?php echo $post['customer_name']; ?></strong></td>
        <td><?php echo $post['brand_name']; ?></td>
        <td><?php echo $post['customer_telp']; ?></td>
        <td><?php echo $post['customer_email']; ?></td>
        <td><?php echo $post['customer_address']; ?></td>
        <td><?php echo $post['keterangan']; ?></td>
        <td>
          <div class="dropdown d-inline">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tindakan
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon" href="<?php echo base_url() ?>staff/kontak/editkonsumen/<?php echo $post['customer_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
              <a onclick="deleteConfirm('<?php echo base_url() ?>staff/kontak/delkonsumen/<?php echo $post['customer_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
            </div>
          </div>
        </td>
      </tr>
    <?php endforeach; else: ?>
    <tr>
      <td>Not Found</td>
    </tr>
  <?php endif; ?>
</table>
</div>
<?php echo $this->ajax_pagination->create_links(); ?>