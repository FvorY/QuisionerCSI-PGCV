<script type="text/javascript" src="fusion/JS/jquery-1.4.js"></script>
<script type="text/javascript" src="fusion/JS/jquery.fusioncharts.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="glyphicon glyphicon-new-window"></i> Hasil Kuisioner
        </h1>
        <ol class="breadcrumb">
        	<li class="active">
                 <a href="master.php?module=hasil&sub=all">Hasil Kuisioner</a>
            </li>
        	<?php if ($_GET['sub']=='all'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=all">Grafik Keseluruhan</a>
            </li>
            <?php } ?>
			<?php if ($_GET['sub']=='pergroup'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=pergroup">Grafik Per Group</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan">Laporan</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='validitas'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=validitas">Uji Validitas</a>
            </li>
            <?php } ?>
        </ol>
    </div>
</div>
<nav class="navbar navbar-inverse" >
	<ul class="nav navbar-nav">
		<li class="<?php if($_GET['sub']=='all'){echo'active';} ?>"><a href="?module=hasil&sub=all">Grafik Keseluruhan</a></li>
		<li class="<?php if($_GET['sub']=='pergroup'){echo'active';} ?>"><a href="?module=hasil&sub=pergroup">Grafik Per Group</a></li>
		<li class="<?php if($_GET['sub']=='laporan'){echo'active';} ?>"><a href="?module=hasil&sub=laporan">Laporan</a></li>
		<li class="<?php if($_GET['sub']=='validitas'){echo'active';} ?>"><a href="?module=hasil&sub=validitas">Uji Validitas</a></li>
	</ul>
</nav>
 <?php if ($_GET['sub']=='validitas')
 { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Daftar Responden</b><button style="margin-left:710px;"  class='btn btn-sm btn-success' value='Print All to Excel' onclick=location.href='modul/mod_report/all_responden.php'><span class="glyphicon glyphicon-zoom-in"></span> Rekap Semua Kuisioner</button>
					</div>
				</div>

					<?php if($_GET['tampilkan']=='pertanggal'){ 
							$tgl_awal= $_POST['thn_mulai']."-".$_POST['bln_mulai']."-".$_POST['tgl_mulai'];
							$tgl_akhir= $_POST['thn_selesai']."-".$_POST['bln_selesai']."-".$_POST['tgl_selesai'];
							$awalindo=tgl_indo($tgl_awal);
							$akhirindo=tgl_indo($tgl_akhir);

						?>
							<div class="alert alert-info" role="alert">
 								 Menampilkan data dari tanggal <b><?php echo $awalindo." Sampai dengan ".$akhirindo ?><b/> 
							</div>
							<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>id pertanyaan</div></th>
						         <th>Tanggal Isi Surve</th>
						         <th><div id='kontentd'>Aksi</div></th></tr>
									<?php
									include "../../koneksi.php";
									include "../../fungsi/fungsi_indotgl.php";
									error_reporting(1);
										$jumlahdata = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tresponden WHERE dateSurvey BETWEEN '$tgl_awal' AND '$tgl_akhir'"));
										$sql = mysqli_query($db,"SELECT * FROM tresponden WHERE dateSurvey BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER by name ");
										$no =1;
									while ($data = mysqli_fetch_array($sql)){
										$dateIndo = tgl_indo($data['dateSurvey']);
										?>
										<tr><td><div id='kontentd'><?php echo $no;?></div></td>
												 <td><div id='kontentd'><?php echo $data['name'] ?></div></td>
												 <td><?php echo $dateIndo ?></td>
												 <td><div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data[respondenId];?>' >
												 <button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
												 <?php if($_SESSION['level']=="Super"){?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[respondenId]?>'>
												 <button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
												 </div>
									   </td></tr>
											<?php
										$no++;
									}
									?>
									
							</table>
							<div class="col-md-12">
								<div class="well">
									<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
								</div>
							</div>
							<?php	
							}
							else
							{ ?>
							<div class="alert alert-info" role="alert">
 								 <strong>Menampilkan semua hasil survey</strong> 
							</div>
									<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>Variabel Id</div></th>
						         <th><div id='kontentd'>jawaban</div>
						         </th>
						         <th><div id='kontentd'>R-hitung</div>
						         </th>
		   
									<?php
											include "../../koneksi.php";
											include "../../fungsi/fungsi_indotgl.php";
											error_reporting(1);
											
											
												$jumlahdata = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tanswer "));
												$p      = new Pagingvalidasi;
												$batas  = 20;
												$posisi = $p->cariPosisi($batas);
												$sql = mysqli_query($db,"SELECT * FROM tanswer  ORDER by jawaban ASC LIMIT $posisi,$batas");
												$no = $posisi+1;
											while ($data = mysqli_fetch_array($sql)){
												$dateIndo = tgl_indo($data['dateSurvey']);
												?>
												<tr><td><div id='kontentd'><?php echo $no;?></div></td>
														 <td><div id='kontentd'><?php echo $data['variabelId'] ?></div></td>
														 <td><div id='kontentd'><?php echo $data['jawaban'] ?></div></td>
														 <td><?php echo $dateIndo ?></td>
														 
											   		</td>
											   </tr>
													<?php
												$no++;
											}
											?>
									</table>
									<div class="col-md-12">
										<div class="well">
											<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
										</div>
									</div>
							<?php

								$jmldata = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tanswer "));
								$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
								$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
							
								echo "<ul class='pagination'>$linkHalaman</ul> ";
							
							}
						?>
				</div>
			</div>
 <?php 
 } ?>



	

