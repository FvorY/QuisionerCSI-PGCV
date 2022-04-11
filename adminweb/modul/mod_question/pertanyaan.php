<script language="javascript">
	function validasiPertanyaan(form){
		if (form.variabelId.value == 0){
			alert("Anda belum mengisikan nama variabel.");
			form.variabelId.focus();
			return (false);
		}
		if (form.pertanyaan.value == ""){
			alert("Anda belum mengisikan pertanyaan.");
			form.pertanyaan.focus();
			return (false);
		}
	}
</script>
<?php
$aksi = "modul/mod_question/aksi_pertanyaan.php";
switch($_GET[act]){
	// Tampil deskripsi
	default:
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-book"></i> Manajemen Pertanyaan
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=pertanyaan">Manajemen Pertanyaan</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">

			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Manajemen Pertanyaan <i style="margin-left:710px;"><?php if($_SESSION['level']=="Super"){?><button class="btn btn-success btn-sm " onclick="window.location.href='?module=question&act=tambahpertanyaan'"><span class="glyphicon glyphicon-plus"></span> Tambah Pertanyaan </button></i><?php }?></div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<th width="1%"><div id="konten">No</div></th>
					<th width="1%"><div id="konten">Kategory Id</div></th>
					<th width="1%"><div id="konten">Variabel</div></th>
					<th width="10%"><div id="konten">Pertanyaan</div></th>

					<th width="10%"><div id="konten">Aksi</div></th>

				</thead>
				<tbody>
					<?php

						$p      = new PagingSoal();
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
					    $tampil = mysqli_query($db, "SELECT * FROM tquestion q INNER JOIN tvariabel v ON q.variabelId=v.variabelId ORDER BY q.variabelId ASC LIMIT $posisi,$batas ");
					    $no = $posisi+1;
						while ($data = mysqli_fetch_array($tampil)){
							?>
							<tr>
								<td><div id="kontentd"><?php echo $no; ?></div></td>
								<td><div id="kontentd"><?php echo $data['categoryId'];?></div></td>
								<td><div id="kontentd"><?php echo $data['variabelName'];?></div></td>
								<td><div id="kontentd"><?php echo $data['question'];?></div></td>
								<td><?php if($_SESSION['level']=="Super"){?><div id="kontentd"><a href="?module=question&act=editquestion&id=<?php echo $data['questionId'];?>"><button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-wrench"></span> Edit</button></a> | <a href="<?php echo $aksi;?>?module=question&act=hapus&id=<?php echo $data['questionId'];?>"><button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Pertanyaan?')" ><span class="glyphicon glyphicon-trash"></span> Hapus</button></a></div><?php } ?>
								</td>
							</tr>

							<?php
							$no++;
						}
						$jmldata = mysqli_num_rows(mysqli_query($db, "SELECT * FROM tquestion"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);


					?>
				</tbody>
			</table>

			<ul class="pagination">
					<?php echo "$linkHalaman"; ?>
				</ul>
		</div>
	</div>


	<?php
	break;

	// Form Tambah Deskripsi
	case "tambahpertanyaan":
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Pertanyaan
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=question">Manajemen Pertanyaan</a> / <a href="master.php?module=question&act=tambahpertanyaan">Tambah Pertanyaan</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah Pertanyaan <i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=question'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi;?>?module=question&act=input" onSubmit="return validasi(this)" class="form-horizontal" >
			<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Kategori </label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<select name="categoryId" id="" class="form-control">
								<?php
								$sql = mysqli_query($db, "SELECT * FROM tcategory ORDER BY categoryId");
								while ($data = mysqli_fetch_array($sql)){
									echo "<option value='$data[categoryId]'> $data[nama]</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Variabel </label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<select name="variabelId" id="" class="form-control">
								<?php
								$sql = mysqli_query($db, "SELECT * FROM tvariabel ORDER BY variabelId");
								while ($data = mysqli_fetch_array($sql)){
									echo "<option value='$data[variabelId]'> $data[variabelName]</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Pertanyaan </label>
					<div class="col-sm-5">
						<textarea class="form-control" rows="4" name="pertanyaan" class="form-control"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
					</div>

				</div>
			</form>
		</div>
    </div>
	<?php
     break;

  // Form Edit deskripsi
  case "editquestion":
    $edit = mysqli_query($db, "SELECT * FROM tquestion WHERE questionId='$_GET[id]'");
    $r = mysqli_fetch_array($edit);
    ?>

	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Pertanyaan
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=question">Manajemen Pertanyaan</a> / <a href="master.php?module=question&act=editquestion&id=<?php echo $r['questionId'];?>">Edit Pertanyaan</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">
				<i class="glyphicon glyphicon-wrench"></i> Edit Pertanyaan
			</div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi ?>?module=question&act=update"  class="form-horizontal" >
				<input type="hidden" name="id" value="<?php echo $r[questionId]; ?>">
				<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Kategori </label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<select name="categoryId" id="" class="form-control">
									<?php
									$sql = mysqli_query($db, "SELECT * FROM tcategory");
									  while($data = mysqli_fetch_array($sql)){
										if($r[categoryId] == $data[categoryId]){
											echo "<option value='$data[categoryId]' SELECTED>$data[nama]</option>";
										}
										else{
											echo "<option value='$data[categoryId]'>$data[nama]</option>";
										}
									  }
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Variabel </label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<select name="variabelId" id="" class="form-control">
									<?php
									$sql = mysqli_query($db, "SELECT * FROM tvariabel ORDER BY variabelId");
									while($data = mysqli_fetch_array($sql)){
									if($r[variabelId] == $data[variabelId]){
										echo "<option value='$data[variabelId]' SELECTED>$data[variabelName]</option>";
									}
									else{
										echo "<option value='$data[variabelId]'>$data[variabelName]</option>";
									}
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="question" class="col-sm-2 control-label">Pertanyaan </label>
						<div class="col-sm-5">
							<textarea name="question" id="" class="form-control">
								<?php echo $r[question]; ?>
							</textarea>
						</div>
					</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
					</div>

				</div>

			</form>
		</div>
	</div>

    <?php
    break;
}
?>
