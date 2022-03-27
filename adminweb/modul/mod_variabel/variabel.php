<script language="javascript">
	function validasiVariabel(form){
		if (form.variabel.value == ""){
			alert("Anda belum mengisikan nama variabel.");
			form.variabel.focus();
			return (false);
		}
	}
</script>

<?php
$aksi = "modul/mod_variabel/aksi_variabel.php";
switch($_GET[act]){
	// Tampil variabel
	default:

	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen variabel
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=variabel">Manajemen variabel</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">

			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> List variabel Kuisioner <i style="margin-left:750px;"><?php if($_SESSION['level']=="Super"){?><button class="btn btn-success btn-sm " onclick="window.location.href='?module=variabel&act=tambahvariabel'"><span class="glyphicon glyphicon-plus"></span> Tambah variabel</button></i><?php } ?></div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<th width="1%"><div id="konten">No</div></th>
					<th width="1%"><div id="konten">Variabel ID</div></th>
					<th width="10%"><div id="konten">Nama Variabel</div></th>
					<th width="10%"><div id="konten">Aksi</div></th>

				</thead>
				<tbody>
					<?php

						$p      = new PagingGroup();
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
					    $tampil = mysqli_query($db,"SELECT * FROM  tvariabel order by variabelName asc limit $posisi,$batas");
					    $no =$posisi+1;
						while ($data = mysqli_fetch_array($tampil)){
							?>
							<tr>
								<td><div id="kontentd"><?php echo $no; ?></div></td>
								<td><div id="kontentd"><?php echo $data['variabelId'];?></div></td>
								<td><div id="kontentd"><?php echo $data['variabelName'];?></div></td>
								<td><?php if($_SESSION['level']=="Super"){?><div id="kontentd"><a href="?module=variabel&act=editvariabel&id=<?php echo $data['variabelId'];?>"><button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-wrench"></span> Edit</button></a> | <a href="<?php echo $aksi;?>?module=variabel&act=hapus&id=<?php echo $data['variabelId'];?>"><button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Variabel?')" ><span class="glyphicon glyphicon-trash"></span> Hapus</button></a></div><?php } ?>
								</td>
							</tr>

							<?php
							$no++;
						}


						$jmldata = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tvariabel"));
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

	// Form Tambah variabel
	case "tambahvariabel":
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen variabel
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=variabel">Manajemen variabel</a> / <a href="master.php?module=variabel&act=tambahvariabel">Tambah variabel</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah variabel Kuisioner <i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=variabel'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi;?>?module=variabel&act=input" onSubmit="return validasiVariabel(this)" class="form-horizontal" >
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Nama variabel</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<input type="text" name="variabel" class="form-control" placeholder="Nama variabel">
						</div>
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

  // Form Edit group
  case "editvariabel":
    $edit=mysqli_query($db,"SELECT * FROM tvariabel WHERE variabelId='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
    ?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen variabel
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=variabel">Manajemen variabel</a> / <a href="?module=variabel&act=editvariabel&id=<?php echo $r['variabelId'];?>">Edit variabel</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">
				<i class="glyphicon glyphicon-wrench"></i> Edit variabel
			</div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi ?>?module=variabel&act=update"  class="form-horizontal" >
				<input type="hidden" name="id" value="<?php echo $r[variabelId]; ?>">
				<div class="form-group">
					<label for="group" class="col-sm-2 control-label">Nama Variabel</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-user"></span>
							</div>
							<input type="text" name="variabel" class="form-control" placeholder="Nama variabel" value="<?php echo $r['variabelName'];?>">
						</div>
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
