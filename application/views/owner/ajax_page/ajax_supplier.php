<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th><div style="width: 100px;">Nama Lengkap</div></th>
      <th><div style="width: 100px;">No Telp.</div></th>
      <th><div style="width: 100px;">Email</div></th>
      <th><div style="width: 100px;">Pemilik</div></th>
      <th><div style="width: 100px;">Alamat</div></th>
      <th></th>
    </tr>
    <?php if(!empty($supplier)): foreach($supplier as $supplier): ?>
      <tr>
        <td><i class="fa fa-address-book"></i></td>
        <td><strong><?php echo $supplier['supplier_name']; ?></strong></td>
        <td><?php echo $supplier['supplier_telp']; ?></td>
        <td><?php echo $supplier['supplier_email']; ?></td>
        <td><?php echo $supplier['owner_name']; ?></td>
        <td><?php echo $supplier['supplier_address']; ?></td>
        <td>
          <div class="dropdown d-inline">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Tindakan
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon" href="<?php echo base_url() ?>owner/kontak/editsupplier/<?php echo $supplier['supplier_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
              <a onclick="supdeleteConfirm('<?php echo base_url() ?>owner/kontak/delsupplier/<?php echo $supplier['supplier_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
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
<?php echo $this->supajax_pagination->create_links(); ?>