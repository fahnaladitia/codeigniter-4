<?= $this->extend("layout/template") ?>
<?= $this->section("content") ?>

<div class="container">
 <div class="row">
  <div class="col-8">
   <h2 class="my-3">Form Tambah Data Komik</h2>

   <form action="/komik/save" method="POST">
    <?= csrf_field() ?>
    <div class="form-group row">
     <label for="judul" class="col-sm-2 col-form-label">Judul</label>
     <div class="col-sm-10">
      <input type="text" class="form-control <?= $validation->hasError("judul")
        ? "is-invalid"
        : "" ?>" name="judul" id="judul" autofocus value="<?= old("judul") ?>">
      <div id="validationServer03Feedback" class="invalid-feedback">
       <?= $validation->getError("judul") ?>
      </div>
     </div>
    </div>
    <div class="form-group row">
     <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" name="penulis" id="penulis" value="<?= old(
        "penulis"
      ) ?>">
     </div>
    </div>
    <div class="form-group row">
     <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= old(
        "penerbit"
      ) ?>">
     </div>
    </div>
    <div class="form-group row">
     <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
     <div class="col-sm-10">
      <input type="text" class="form-control" name="sampul" id="sampul" value="<?= old(
        "sampul"
      ) ?>">
     </div>
    </div>
    <div class="form-group row">
     <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Tanbah Data</button>
     </div>
    </div>
   </form>
  </div>
 </div>
</div>

<?= $this->endSection() ?>