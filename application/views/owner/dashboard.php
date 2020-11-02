<section class="section">
  <div class="section-header">
    <h1>Dasbor</h1>
  </div>
  <h2 class="section-title">Selamat Bekerja <strong style="color: #6777ef;"><?= $userdata->fullname; ?></strong>, Have a Good One!</h2>
  <p class="section-lead">
    <strong>Pimpinan.</strong>
   <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Memo Produksi</h4>
        <!-- <div class="card-header-action">
          <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
        </div> -->
      </div>
      <div class="card-body p-0">
        <div class="table-responsive table-invoice">
          <table class="table table-striped">
            <tr>
              <th>Nomor Produksi</th>
              <th>Konsumen</th>
              <th>Status</th>
              <th>Deadline</th>
              <th>Action</th>
            </tr>
            <?php foreach ($manufacturing as $data):?>
              <tr>
                <td><a href="#"><?= $data->mo_code ?></a></td>
                <td class="font-weight-600"><?= $data->customer_name ?></td>
                <td><div class="badge badge-warning"><?= $data->status; ?></div></td>
                <td><?= tgl_indo($data->prod_deadline); ?></td>
                <td>
                  <a href="#" class="btn btn-primary">Detail</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</section>
