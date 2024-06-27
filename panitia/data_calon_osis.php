<?php include'templet/header.php' ?>
<?php include'templet/topbar.php' ?>

<?php

if(!isset($_SESSION['username'])){
 echo "<script> document.location.href='../index.php'</script>";
}else{

  ?>
  <style>
    table .aksi{
      display: flex;
      justify-content: center;
    }
    form{
      margin: 10px;
    }
    #tombol-tambah-pelatih{
      width: 140px;
    }
    .modal-footer{
      justify-content: space-around;
    }
    .tombol-reset{
      width: 140px;
    }
    .tombol-close{
      width: 140px;
    }
  </style>


  <div class="container-fluid">
    <div class="card">
     <div class="card-header">
      <h3 style="float:left">Data Kandidat</h3>
   <!--    <a style="float: right" type="button" class="btn btn-outline-warning mb-4" data-toggle="modal" data-target="#modal-tambah-kandidat" ><i class="fas fa-user-plus"></i>Tambah Kandidat</a> -->
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" id="datatable" style="width:100%">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th class="text-center">ID Kandidat</th>
              <th class="text-center">Nama</th>
              <th class="text-center">Suara</th>
              <th class="text-center">Periode</th>
              <th class="text-center">Foto</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include '../koneksi.php';
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM tb_kandidat");
            while ($data = mysqli_fetch_array($query)) {
             ?>
             <tr>
               <td><?php echo $no++ ?></td>
               <td><?php echo $data['id_kandidat'] ?></td>
               <td><?php echo $data['nama_calon'] ?></td>
               <td><?php echo $data['suara'] ?></td>
               <td><?php echo $data['periode'] ?></td>
               <td><img width="100" src="../foto_kandidat/<?php echo $data['foto'] ?>" alt=""></td>
               <td class="text-center">
                <button class="btn btn-info btn-sm" id="tombol-detailcalon" data-id="<?php echo $data['id_kandidat'] ?>"><i class="fa fa-info"></i></button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<?php include'templet/footer.php' ?>

<script>
  $(document).ready(function(){
    $('#datatable').on('click','#tombol-editkandidat', function(){
      let id = $(this).data('id');
      
      $.ajax({
        url : 'mendapat_data_edit.php?dapat=data_kandidat',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
          $('#modal-edit-kandidat').modal('show');
          $('.penampung-edit-kandidat').html(`
           <form action="aksi_edit.php?edit=data_kandidat" method="post" enctype="multipart/form-data">
           <div class="form-group">
           <label for="nama">Nama Kandidat</label>
           <input  required="" type="text"  name="id" hidden value="${hasil.id_kandidat}">
           <input required="" type="text" id="nama" name="nama" class="form-control" value="${hasil.nama_calon}">
           </div>
           <div class="form-group">
           <label for="visi">Visi</label>
           <textarea required="" name="visi" class="form-control" rows="3">${hasil.visi}</textarea>
           </div>
           <div class="form-group">
           <label for="misi">Misi</label>
           <textarea required="" name="misi" class="form-control" rows="3">${hasil.misi}</textarea> 
           </div>
           <div class="form-group">
           <label for="priode">Periode</label>
           <input  required="" type="text" id="priode" name="priode" class="form-control" value="${hasil.periode}">
           </div>
           <div class="form-group">
           <label for="foto_baru">Foto</label>
           <input  type="file" id="foto_baru" name="foto_baru" class="form-control">
           <input  required="" type="text"  name="foto_lama" hidden value="${hasil.foto}">
           </div>
           <img width="100" src="foto_kandidat/${hasil.foto}">
           <div class="modal-footer">
           <button style="width:140px" type="submit" class="btn btn-primary" name="edit_kandidat" id="tombol-edit-kandidat">Edit</button>
           <button style="width:140px" type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
           <button style="width:140px" type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
           </div>
           </form>
           `);
        }

      })
    })

    $('#datatable').on('click','#tombol-detailcalon', function(){
      let id = $(this).data('id');
      $.ajax({
        url : 'mendapat_data_edit.php?dapat=data_kandidat',
        data : {'id': id},
        type : 'post',
        dataType : 'json',
        success: function(hasil){
          $('#modal-detail-kandidat').modal('show');
          $('.penampung-detail-kandidat').html(`
           <form action="aksi_edit.php?edit=data_kandidat" method="post" enctype="multipart/form-data">
           <div class="form-group">
           <label for="nama">Nama Kandidat</label>
           <input readonly  required="" type="text" class="form-control" value="${hasil.id_kandidat}">
           </div>
           <div class="form-group">
           <label for="nama">Nama Kandidat</label>
           <input readonly required="" type="text" id="nama" name="nama" class="form-control" value="${hasil.nama_calon}">
           </div>
           <div class="form-group">
           <label for="visi">Visi</label>
           <textarea readonly required="" name="visi" class="form-control" rows="3">${hasil.visi}</textarea>
           </div>
           <div class="form-group">
           <label for="misi">Misi</label>
           <textarea readonly required="" name="misi" class="form-control" rows="3">${hasil.misi}</textarea> 
           </div>
           <div class="form-group">
           <label for="priode">Periode</label>
           <input readonly required="" type="text" id="priode" name="priode" class="form-control" value="${hasil.periode}">
           </div>
           <img width="100" src="foto_kandidat/${hasil.foto}">
           <div class="modal-footer">
           <button style="width:100%" type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
           </div>
           </form>
           `);
        }

      })
    })

    })
  </script>


  <!-- Modal tambah-->
  <div class="modal fade" id="modal-tambah-kandidat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kandidat</h5>
     </div>
     <div class="modal-body">
       <form action="aksi_insert.php?tambah=data_kandidat" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nama">Nama Kandidat</label>
          <input required="" type="text" id="nama" autocomplete="off" name="nama" class="form-control">
        </div>
        <div class="form-group">
          <label for="visi">Visi</label>
          <textarea required="" name="visi" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="misi">Misi</label>
          <textarea required="" name="misi" class="form-control" rows="3"></textarea> 
        </div>
        <div class="form-group">
          <label for="priode">Periode</label>
          <input  required="" type="text" id="priode" name="priode" class="form-control">
        </div>
        <div class="form-group">
          <label for="foto">Foto</label>
          <input  required="" type="file" id="foto" name="foto" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="tambah_kandidat" id="tombol-tambah-kandidat">Tambah</button>
          <button type="reset" class="btn btn-danger tombol-reset ml-2">Reset</button>
          <button type="button" class="btn btn-secondary tombol-close" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>



<!-- Modal edit-->
<div class="modal fade" id="modal-edit-kandidat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Data Kandidat</h5>
    </div>
    <div class="penampung-edit-kandidat">

    </div>
  </div>
</div>
</div>

<!-- Modal edit-->
<div class="modal fade" id="modal-detail-kandidat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Detail Data Kandidat</h5>
    </div>
    <div class="penampung-detail-kandidat">

    </div>
  </div>
</div>
</div>

<?php } ?>
