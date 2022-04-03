<?php
	function pearson($x,$y){

    if(count($x)!==count($y)){return -1;}
    $x=array_values($x);
    $y=array_values($y);
    $xs=array_sum($x)/count($x);
    $ys=array_sum($y)/count($y);
    $a=0;$bx=0;$by=0;
    for($i=0;$i<count($x);$i++){
        $xr=$x[$i]-$xs;
        $yr=$y[$i]-$ys;
        $a+=($xr*$yr);
        $bx+=pow($xr,2);
        $by+=pow($yr,2);
    }
    $b = sqrt($bx*$by);
    return $a/$b;

	}

	function variance($a)
	{
	  $the_variance = 0.0;
	  $the_mean = array_sum($a) / count($a);


	  for ($i = 0; $i < count($a); $i++)
	  {
	    $the_variance = $the_variance + ($a[$i] - $the_mean) * ($a[$i] - $the_mean);
	  }

	  $the_variance = $the_variance / (count($a) - 1.0);

	  return $the_variance;
	}

	function perkalian_matriks($matriks_a, $matriks_b) {
		$hasil = array();
		for ($i=0; $i<sizeof($matriks_a); $i++) {
			for ($j=0; $j<sizeof($matriks_b[0]); $j++) {
				$temp = 0;
				for ($k=0; $k<sizeof($matriks_b); $k++) {
					$temp += $matriks_a[$i][$k] * $matriks_b[$k][$j];
				}
				$hasil[$i][$j] = $temp;
			}
		}
		return $hasil;
	}

	function invert($A, $debug = FALSE)
	{
		/// @todo check rows = columns

		$n = count($A);

		// get and append identity matrix
		$I = identity_matrix($n);
		for ($i = 0; $i < $n; ++ $i) {
			$A[$i] = array_merge($A[$i], $I[$i]);
		}

		if ($debug) {
			echo "\nStarting matrix: ";
			print_matrix($A);
		}

		// forward run
		for ($j = 0; $j < $n-1; ++ $j) {
			// for all remaining rows (diagonally)
			for ($i = $j+1; $i < $n; ++ $i) {
				// if the value is not already 0
				if ($A[$i][$j] !== 0) {
					// adjust scale to pivot row
					// subtract pivot row from current
					$scalar = $A[$j][$j] / $A[$i][$j];
					for ($jj = $j; $jj < $n*2; ++ $jj) {
						$A[$i][$jj] *= $scalar;
						$A[$i][$jj] -= $A[$j][$jj];
					}
				}
			}
			if ($debug) {
				echo "\nForward iteration $j: ";
				print_matrix($A);
			}
		}

		// reverse run
		for ($j = $n-1; $j > 0; -- $j) {
			for ($i = $j-1; $i >= 0; -- $i) {
				if ($A[$i][$j] !== 0) {
					$scalar = $A[$j][$j] / $A[$i][$j];
					for ($jj = $i; $jj < $n*2; ++ $jj) {
						$A[$i][$jj] *= $scalar;
						$A[$i][$jj] -= $A[$j][$jj];
					}
				}
			}
			if ($debug) {
				echo "\nReverse iteration $j: ";
				print_matrix($A);
			}
		}

		// last run to make all diagonal 1s
		/// @note this can be done in last iteration (i.e. reverse run) too!
		for ($j = 0; $j < $n; ++ $j) {
			if ($A[$j][$j] !== 1) {
				$scalar = 1 / $A[$j][$j];
				for ($jj = $j; $jj < $n*2; ++ $jj) {
					$A[$j][$jj] *= $scalar;
				}
			}
			if ($debug) {
				echo "\n1-out iteration $j: ";
				print_matrix($A);
			}
		}

		// take out the matrix inverse to return
		$Inv = array();
		for ($i = 0; $i < $n; ++ $i) {
			$Inv[$i] = array_slice($A[$i], $n);
		}

		return $Inv;
	}

	function identity_matrix($n)
	{
		$I = array();
		for ($i = 0; $i < $n; ++ $i) {
			for ($j = 0; $j < $n; ++ $j) {
				$I[$i][$j] = ($i == $j) ? 1 : 0;
			}
		}
		return $I;
	}
?>
<script type="text/javascript" src="fusion/JS/jquery-1.4.js"></script>
<script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>

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
			<?php if ($_GET['sub']=='pervariabel'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=pervariabel">Grafik Per variabel</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan">Responden</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='validitas-kinerja'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=validitas-kinerja">Uji Validitas Kinerja</a>
            </li>

            <?php } ?>
			<?php if ($_GET['sub']=='validitas-kepentingan'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=validitas-kepentingan">Uji Validitas Kepentingan</a>
            </li>

            <?php } ?>
            <?php if ($_GET['sub']=='reabilitas-kinerja'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=reabilitas-kinerja">Uji Reabilitas Kinerja</a>
            </li>

            <?php } ?>
			<?php if ($_GET['sub']=='reabilitas-kepentingan'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=reabilitas-kepentingan">Uji Reabilitas Kepentingan</a>
            </li>

            <?php } ?>

            <?php if ($_GET['sub']=='csi_pgcv'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=csi_pgcv">CSI & PGCV</a>
            </li>

            <?php } ?>

        </ol>
    </div>
</div>
<nav class="navbar navbar-inverse" >
	<ul class="nav navbar-nav">
		<li class="<?php if($_GET['sub']=='all'){echo'active';} ?>"><a href="?module=hasil&sub=all">Grafik Keseluruhan</a></li>
		<li class="<?php if($_GET['sub']=='pervariabel'){echo'active';} ?>"><a href="?module=hasil&sub=pervariabel"> Grafik Per variabel</a></li>
		<li class="<?php if($_GET['sub']=='laporan'){echo'active';} ?>"><a href="?module=hasil&sub=laporan">Responden</a></li>
		<li class="<?php if($_GET['sub']=='validitas-kinerja'){echo'active';} ?>"><a href="?module=hasil&sub=validitas-kinerja">Uji Validitas Kinerja</a></li>
		<li class="<?php if($_GET['sub']=='validitas-kepentingan'){echo'active';} ?>"><a href="?module=hasil&sub=validitas-kepentingan">Uji Validitas Kepentingan</a></li>
		<li class="<?php if($_GET['sub']=='reabilitas-kinerja'){echo'active';} ?>"><a href="?module=hasil&sub=reabilitas-kinerja">Uji Reabilitas Kinerja</a></li>
		<li class="<?php if($_GET['sub']=='reabilitas-kepentingan'){echo'active';} ?>"><a href="?module=hasil&sub=reabilitas-kepentingan">Uji Reabilitas Kepentingan</a></li>
		<li class="<?php if($_GET['sub']=='csi_pgcv'){echo'active';} ?>"><a href="?module=hasil&sub=csi_pgcv">CSI & PGCV</a></li>

	</ul>
</nav>
<?php if ($_GET['sub']=='all'){ ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
			<div class="panel-title">Grafik Kuisioner Kepentingan</div>
		</div>
	</div>

		<div class="panel-body">

			<div id="chartmyHTMLTable">

			</div>

			<table id="myHTMLTable" border="0" cellpadding="5" class="table table-striped">
				<tr>
				<th width="15%"><font size=2 face=tahoma>Data</font></th>
				<th width="18%"><font size=2 face=tahoma>Sangat Puas</font></th>
				<th width="18%"><font size=2 face=tahoma>Puas</font></th>
				<th width="18%"><font size=2 face=tahoma>Cukup Puas</font></th>
				<th width="18%"><font size=2 face=tahoma>Kurang Puas</font></th>
				<th><font size=2 face=tahoma>Tidak Puas</font></th>
				</tr>
        <?php
  			$sql = mysqli_query($db,"SELECT SUM(jawabanA) As TotalA,
  									SUM(jawabanB) As TotalB,
  									SUM(jawabanC) As TotalC,
  									SUM(jawabanD) As TotalD,
  									SUM(jawabanE) As TotalE,
  									SUM(jawabanA+jawabanB+jawabanC+jawabanD+jawabanE) As jumlahtotal
  				 					FROM tanswer where categoryId = 1");

  			$noo=1;
  			$oke = mysqli_fetch_array($sql);
  				$a = $oke[TotalA];
  				$b = $oke[TotalB];
  				$c = $oke[TotalC];
  				$d = $oke[TotalD];
  				$e = $oke[TotalE];
  				$tot = $a+$b+$c+$d+$e;

  				$pa = ROUND(($a / $tot) * 100);
  				$pb = ROUND(($b / $tot) * 100);
  				$pc = ROUND(($c / $tot) * 100);
  				$pd = ROUND(($d / $tot) * 100);
  				$pe = ROUND(($e / $tot) * 100);
  					echo "<tr>
  						<td><font size=3 face=tahoma>Jumlah Jawaban</font></td>
  						<td><font size=2 face=tahoma>$a</font></td>
  						<td><font size=2 face=tahoma>$b</font></td>
  						<td><font size=2 face=tahoma>$c</font></td>
  						<td><font size=2 face=tahoma>$d</font></td>
  						<td><font size=2 face=tahoma>$e</font></td>


  					  </tr>
  					  <tr >
  						<td><font size=3 face=tahoma>Prosentase</font></td>
  						<td><font size=2 face=tahoma>$pa%</font></td>
  						<td><font size=2 face=tahoma>$pb%</font></td>
  						<td><font size=2 face=tahoma>$pc%</font></td>
  						<td><font size=2 face=tahoma>$pd%</font></td>
  						<td><font size=2 face=tahoma>$pe%</font></td>
  					  </tr>
  					  ";
  			?>
		</table>
    <script type="text/javascript">


    </script>
		</div>
	</div>

  <div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">Grafik Kuisioner Kinerja</div>
		</div>
	</div>

		<div class="panel-body">

			<div id="chartmyHTMLTable1">

			</div>

			<table id="myHTMLTable" border="0" cellpadding="5" class="table table-striped">
				<tr>
				<th width="15%"><font size=2 face=tahoma>Data</font></th>
				<th width="18%"><font size=2 face=tahoma>Sangat Puas</font></th>
				<th width="18%"><font size=2 face=tahoma>Puas</font></th>
				<th width="18%"><font size=2 face=tahoma>Cukup Puas</font></th>
				<th width="18%"><font size=2 face=tahoma>Kurang Puas</font></th>
				<th><font size=2 face=tahoma>Tidak Puas</font></th>
				</tr>
        <?php
  			$sql1 = mysqli_query($db,"SELECT SUM(jawabanA) As TotalA,
  									SUM(jawabanB) As TotalB,
  									SUM(jawabanC) As TotalC,
  									SUM(jawabanD) As TotalD,
  									SUM(jawabanE) As TotalE,
  									SUM(jawabanA+jawabanB+jawabanC+jawabanD+jawabanE) As jumlahtotal
  				 					FROM tanswer where categoryId = 2");

  			$noo1=1;
  			$oke1 = mysqli_fetch_array($sql1);
  				$a1 = $oke1[TotalA];
  				$b1 = $oke1[TotalB];
  				$c1 = $oke1[TotalC];
  				$d1 = $oke1[TotalD];
  				$e1 = $oke1[TotalE];
  				$tot1 = $a1+$b1+$c1+$d1+$e1;

  				$pa1 = ROUND(($a1 / $tot1) * 100);
  				$pb1 = ROUND(($b1 / $tot1) * 100);
  				$pc1 = ROUND(($c1 / $tot1) * 100);
  				$pd1 = ROUND(($d1 / $tot1) * 100);
  				$pe1 = ROUND(($e1 / $tot1) * 100);
  					echo "<tr>
  						<td><font size=3 face=tahoma>Jumlah Jawaban</font></td>
  						<td><font size=2 face=tahoma>$a1</font></td>
  						<td><font size=2 face=tahoma>$b1</font></td>
  						<td><font size=2 face=tahoma>$c1</font></td>
  						<td><font size=2 face=tahoma>$d1</font></td>
  						<td><font size=2 face=tahoma>$e1</font></td>


  					  </tr>
  					  <tr >
  						<td><font size=3 face=tahoma>Prosentase</font></td>
  						<td><font size=2 face=tahoma>$pa1%</font></td>
  						<td><font size=2 face=tahoma>$pb1%</font></td>
  						<td><font size=2 face=tahoma>$pc1%</font></td>
  						<td><font size=2 face=tahoma>$pd1%</font></td>
  						<td><font size=2 face=tahoma>$pe1%</font></td>
  					  </tr>
  					  ";
  			?>
		</table>
    <script type="text/javascript">
      var chartmyHTMLTable = new FusionCharts({
      swfPath: "fusion/Charts/",
      renderAt: "chartmyHTMLTable",
      type: "column3d",
      dataSource: {
          // chart configuration
          chart: {
              caption: "Grafik Kuisioner Keseluruhan",
              subcaption: ""
          },
          // chart data
          data: [
              { label: "Sangat Puas", value: "<?php echo "$a" ?>" },
              { label: "Puas", value: "<?php echo "$b" ?>" },
              { label: "Cukup Puas", value: "<?php echo "$c" ?>" },
              { label: "Kurang Puas", value: "<?php echo "$d" ?>" },
              { label: "Tidak Puas", value: "<?php echo "$e" ?>" },
          ]
      },
      dataFormat: "json",
      width:"1000",
      height:"500",
    });

    chartmyHTMLTable.render();

    var chartmyHTMLTable1 = new FusionCharts({
      swfPath: "fusion/Charts/",
      renderAt: "chartmyHTMLTable1",
      type: "column3d",
      dataSource: {
          // chart configuration
          chart: {
              caption: "Grafik Kuisioner Keseluruhan",
              subcaption: ""
          },
          // chart data
          data: [
              { label: "Sangat Puas", value: "<?php echo "$a1" ?>" },
              { label: "Puas", value: "<?php echo "$b1" ?>" },
              { label: "Cukup Puas", value: "<?php echo "$c1" ?>" },
              { label: "Kurang Puas", value: "<?php echo "$d1" ?>" },
              { label: "Tidak Puas", value: "<?php echo "$e1" ?>" },
          ]
      },
      dataFormat: "json",
      width:"1000",
      height:"500",
    });

    chartmyHTMLTable1.render();

    </script>
		</div>
	</div>
<?php } ?>
<?php if ($_GET['sub']=='pervariabel'){ ?>

  <?php
  error_reporting(1);
  $result=mysqli_query($db,"SELECT variabelId from tvariabel group by variabelId ");
  $kolom= 2;
  $array=array();
  while ($sql=mysqli_fetch_array($result))
  {
    array_push($array, $sql);
  }
  $chunks=array_chunk($array, $kolom);

    foreach ($chunks as $chunk) {
        foreach ($chunk as $data) {
            echo "<div class='col-md-6'style='padding-left:0px;padding-right:0px;'>";
            $data2=mysqli_fetch_array(mysqli_query($db,"SELECT *from tvariabel where variabelId='$data[variabelId]' group by variabelId "));
            ?>
        <div class="panel panel-primary" style='margin-left:10px'>
          <div class="panel-heading">
            <div class="panel-title"><?php echo $data2['variabelName']; ?></div>
          </div>
          <div class="panel-body">
            <div id="chartmyHTMLTable<?php echo $data2['variabelId']; ?>">

            </div>
            <table id="myHTMLTable<?php echo $data2['variabelId']; ?>" border="0" cellpadding="5" class="table table-striped">
              <tr>
              <th><font size=2 face=tahoma>Data</font></th>
              <th><font size=2 face=tahoma>Sangat Puas</font></th>
              <th><font size=2 face=tahoma>Puas</font></th>
              <th><font size=2 face=tahoma>Cukup Puas</font></th>
              <th><font size=2 face=tahoma>Kurang Puas</font></th>
              <th><font size=2 face=tahoma>Tidak Puas</font></th>
              </tr>
            <?php
            $sql = mysqli_query($db,"SELECT SUM(jawabanA) As TotalA,
                        SUM(jawabanB) As TotalB,
                        SUM(jawabanC) As TotalC,
                        SUM(jawabanD) As TotalD,
                        SUM(jawabanE) As TotalE,
                        SUM(jawabanA+jawabanB+jawabanC+jawabanD+jawabanE) As jumlah FROM tanswer where variabelId='$data2[variabelId]' ");
            $nom = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tanswer where variabelId='$data2[variabelId]'"));

            $noo=1;
            while ($row = mysqli_fetch_array($sql)) {
              $a = $row[TotalA];
              $b = $row[TotalB];
              $c = $row[TotalC];
              $d = $row[TotalD];
              $e = $row[TotalE];
              $tot =$a+$b+$c+$d+$e;
            }

              $pa = ROUND(($a / $tot) * 100);
              $pb = ROUND(($b / $tot) * 100);
              $pc = ROUND(($c / $tot) * 100);
              $pd = ROUND(($d / $tot) * 100);
              $pe = ROUND(($e / $tot) * 100);


                echo "<tr >
                  <td><font size=3 face=tahoma>Jumlah Jawaban</font></td>
                  <td><font size=2 face=tahoma>$a</font></td>
                  <td><font size=2 face=tahoma>$b</font></td>
                  <td><font size=2 face=tahoma>$c</font></td>
                  <td><font size=2 face=tahoma>$d</font></td>
                  <td><font size=2 face=tahoma>$e</font></td>

                  </tr>
                  <tr >
                  <td><font size=3 face=tahoma>Prosentase</font></td>
                  <td><font size=2 face=tahoma>$pa%</font></td>
                  <td><font size=2 face=tahoma>$pb%</font></td>
                  <td><font size=2 face=tahoma>$pc%</font></td>
                  <td><font size=2 face=tahoma>$pd%</font></td>
                  <td><font size=2 face=tahoma>$pe%</font></td>
                  </tr>
                  ";
            ?>
            </table>

          <script type="text/javascript">

            var chartmyHTMLTable2 = new FusionCharts({
              swfPath: "fusion/Charts/",
              renderAt: "chartmyHTMLTable<?php echo $data2[variabelId]; ?>",
              type: "column3d",
              dataSource: {
                  // chart configuration
                  chart: {
                      caption: "Grafik Kuisioner Keseluruhan",
                      subcaption: ""
                  },
                  // chart data
                  data: [
                      { label: "Sangat Puas", value: "<?php echo "$a" ?>" },
                      { label: "Puas", value: "<?php echo "$b" ?>" },
                      { label: "Cukup Puas", value: "<?php echo "$c" ?>" },
                      { label: "Kurang Puas", value: "<?php echo "$d" ?>" },
                      { label: "Tidak Puas", value: "<?php echo "$e" ?>" },
                  ]
              },
              dataFormat: "json",
              width:"400",
              height:"300",
            });

            chartmyHTMLTable2.render();

            </script>
          </div>
        </div>
            <?php
            echo '</div>';
        }

    }

  ?>

 <?php } ?>
 <?php if ($_GET['sub']=='laporan')
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
                   <th><div id='kontentd'>Nama Responden</div></th>
                   <th>Tanggal isi Survey</th>
                   <th>Prodi</th>
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
                       <td><div id='kontentd'><?php echo $data['prodi'] ?></div></td>
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
                   <th><div id='kontentd'>Nama Responden</div></th>
                    <th><div id='kontentd'>Prodi</div></th>


                   <th><div id='kontentd'>Aksi</div></th></tr>
                <?php
                    include "../../koneksi.php";
                    include "../../fungsi/fungsi_indotgl.php";
                    error_reporting(1);


                      $jumlahdata = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tresponden "));
                      $p      = new PagingHasil;
                      $batas  = 100;
                      $posisi = $p->cariPosisi($batas);
                      $sql = mysqli_query($db,"SELECT * FROM tresponden  ORDER by name ASC LIMIT $posisi,$batas");
                      $no = $posisi+1;
                    while ($data = mysqli_fetch_array($sql)){
                      $dateIndo = tgl_indo($data['dateSurvey']);
                      ?>
                      <tr><td><div id='kontentd'><?php echo $no;?></div></td>
                           <td><div id='kontentd'><?php echo $data['name'] ?></div></td>
                           <td><div id='kontentd'><?php echo $data['prodi'] ?></div></td>

                           <td><div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data[respondenId];?>' >
                           <button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
                           <?php if($_SESSION['level']=="Super"){?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[respondenId]?>'>
                           <button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
                           </div>
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

              $jmldata = mysqli_num_rows(mysqli_query($db,"SELECT * FROM tresponden "));
              $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
              $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

              echo "<ul class='pagination'>$linkHalaman</ul> ";

            }
          ?>
        </div>
 <?php
 } ?>
 <?php if ($_GET['sub']=='validitas-kinerja')
 { ?>
 	<div class="panel panel-primary" style='margin-left:10px'>
		<div class="panel-heading">
			<div class="panel-title">Hasil Perhitungan</div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered">

			<?php
				$dy=array();
				$sql = mysqli_query($db,"SELECT * FROM tresponden order by respondenId");

				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT sum(jawaban) as jawabanjumlah FROM tanswer where respondenId='".$data['respondenId']."' AND categoryId=2");

					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dy,$data1['jawabanjumlah']);
					}
				}

				$sql = mysqli_query($db,"SELECT * FROM tquestion");
				echo "<tr><td></td>";
				$pearson=array();
				$ind=1;
				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT * FROM tanswer where descriptionId='".$data['questionId']."' AND categoryId=2 order by respondenId");
					$dx=array();
					echo "<td style='font-size:8px'>".$ind."</td>";
					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dx,$data1['jawaban']);
					}
					// print_r($dy);
					// echo "<br>";
					// print_r($dx);
					// echo "<br>";

					$nilai = pearson($dx,$dy);
					// echo $nilai;
					// echo "<br>";
					// echo "<br>";
					array_push($pearson,$nilai);
					$ind++;
				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>Korelasi</td>";
				$thitung = array();
				for($x=0;$x<count($pearson);$x++){
					//$pearson[$x] = round($pearson[$x], 4);
					echo "<td style='font-size:8px'>".number_format($pearson[$x],3,',','')."</td>";
					$nilai = (count($dx)-2)**0.5*$pearson[$x];
					$nilai1 = (1-$pearson[$x]**2)**0.5;
					// echo $nilai;
					// echo "<br>";
					// echo $nilai1;
					// echo "<br>";
					// echo "<br>";
					array_push($thitung,$nilai/$nilai1);
				}
				echo "</tr>";

				echo "<tr><td style='font-size:8px'>T-Hitung</td>";
				for($x=0;$x<count($thitung);$x++){
					echo "<td style='font-size:8px'>".number_format($thitung[$x],3,',','')."</td>";

				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>T-Table</td>";
				for($x=0;$x<count($thitung);$x++){
					echo "<td style='font-size:8px'>1,6472</td>";

				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>Ket</td>";
				for($x=0;$x<count($pearson);$x++){
					$ket = "TV";
					if($pearson[$x]<1.6472){
						$ket="V";
					}
					echo "<td style='font-size:8px'>".$ket."</td>";
				}
				echo "</tr>";



			?>


			</table>
			<p>Keterangan</p>
			<p>V = Valid</p>
			<p>TV = Tidak Valid</p>
		</div>
	</div>
 <?php
 } ?>

<?php if ($_GET['sub']=='validitas-kepentingan')
 { ?>
 	<div class="panel panel-primary" style='margin-left:10px'>
		<div class="panel-heading">
			<div class="panel-title">Hasil Perhitungan</div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered">

			<?php
				$dy=array();
				$sql = mysqli_query($db,"SELECT * FROM tresponden order by respondenId");

				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT sum(jawaban) as jawabanjumlah FROM tanswer where respondenId='".$data['respondenId']."' AND categoryId=1");

					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dy,$data1['jawabanjumlah']);
					}
				}

				$sql = mysqli_query($db,"SELECT * FROM tquestion");
				echo "<tr><td></td>";
				$pearson=array();
				$ind=1;
				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT * FROM tanswer where descriptionId='".$data['questionId']."' AND categoryId=1 order by respondenId");
					$dx=array();
					echo "<td style='font-size:8px'>".$ind."</td>";
					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dx,$data1['jawaban']);
					}
					// print_r($dy);
					// echo "<br>";
					// print_r($dx);
					// echo "<br>";

					$nilai = pearson($dx,$dy);
					// echo $nilai;
					// echo "<br>";
					// echo "<br>";
					array_push($pearson,$nilai);
					$ind++;
				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>Korelasi</td>";
				$thitung = array();
				for($x=0;$x<count($pearson);$x++){
					//$pearson[$x] = round($pearson[$x], 4);
					echo "<td style='font-size:8px'>".number_format($pearson[$x],3,',','')."</td>";
					$nilai = (count($dx)-2)**0.5*$pearson[$x];
					$nilai1 = (1-$pearson[$x]**2)**0.5;
					// echo $nilai;
					// echo "<br>";
					// echo $nilai1;
					// echo "<br>";
					// echo "<br>";
					array_push($thitung,$nilai/$nilai1);
				}
				echo "</tr>";

				echo "<tr><td style='font-size:8px'>T-Hitung</td>";
				for($x=0;$x<count($thitung);$x++){
					echo "<td style='font-size:8px'>".number_format($thitung[$x],3,',','')."</td>";

				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>T-Table</td>";
				for($x=0;$x<count($thitung);$x++){
					echo "<td style='font-size:8px'>1,6472</td>";

				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>Ket</td>";
				for($x=0;$x<count($pearson);$x++){
					$ket = "TV";
					if($pearson[$x]<1.6472){
						$ket="V";
					}
					echo "<td style='font-size:8px'>".$ket."</td>";
				}
				echo "</tr>";



			?>


			</table>
			<p>Keterangan</p>
			<p>V = Valid</p>
			<p>TV = Tidak Valid</p>
		</div>
	</div>
 <?php
 } ?>

<?php if ($_GET['sub']=='reabilitas-kinerja')
{ ?>
 	<div class="panel panel-primary" style='margin-left:10px'>
		<div class="panel-heading">
			<div class="panel-title">Hasil Perhitungan</div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered">

			<?php
				$dy=array();
				$sql = mysqli_query($db,"SELECT * FROM tresponden");
				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT sum(jawaban) as jawabanjumlah FROM tanswer where respondenId='".$data['respondenId']."' AND categoryId=2");

					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dy,$data1['jawabanjumlah']);
					}
				}

				$sql = mysqli_query($db,"SELECT * FROM tquestion");
				echo "<tr><td></td>";
				$varx=array();
				$ind=1;
				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT * FROM tanswer where descriptionId='".$data['questionId']."' AND categoryId=2");
					$dx=array();
					echo "<td style='font-size:8px'>".$ind."</td>";
					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dx,$data1['jawaban']);
					}
					$nilai = variance($dx);

					array_push($varx,$nilai);
					$ind++;
				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>Varian</td>";

				for($x=0;$x<count($varx);$x++){
					echo "<td style='font-size:8px'>".number_format($varx[$x],3,',','')."</td>";

				}
				echo "</tr>";

				$vary = variance($dy);

				$reab = (count($dx)/(count($dx)-1)) * (1-(array_sum($varx)/$vary));
				echo "<tr style='font-size:8px'><td>Ket</td>";
				for($x=0;$x<count($varx);$x++){
					$ket = "NR";
					if($varx[$x]>0.60){
						$ket="R";
					}
					echo "<td style='font-size:8px'>".$ket."</td>";

				}
				echo "</tr>";

			?><p>Reabilitas : <?php echo $reab?></p>
			<p>Jumlah Varian Item : <?php echo array_sum($varx)?></p>
			<p>Total skor Varian : <?php echo $vary?></p>
			</table>
			<p>Keterangan</p>
			<p>R = Realibel</p>
			<p>NR = Tidak Realibel</p>
		</div>
	</div>
 <?php
 } ?>

<?php if ($_GET['sub']=='reabilitas-kepentingan')
{ ?>
 	<div class="panel panel-primary" style='margin-left:10px'>
		<div class="panel-heading">
			<div class="panel-title">Hasil Perhitungan</div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered">

			<?php
				$dy=array();
				$sql = mysqli_query($db,"SELECT * FROM tresponden");
				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT sum(jawaban) as jawabanjumlah FROM tanswer where respondenId='".$data['respondenId']."' AND categoryId=1");

					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dy,$data1['jawabanjumlah']);
					}
				}

				$sql = mysqli_query($db,"SELECT * FROM tquestion");
				echo "<tr><td></td>";
				$varx=array();
				$ind=1;
				while ($data = mysqli_fetch_array($sql)){
					$sql1 = mysqli_query($db,"SELECT * FROM tanswer where descriptionId='".$data['questionId']."' AND categoryId=1");
					$dx=array();
					echo "<td style='font-size:8px'>".$ind."</td>";
					while ($data1 = mysqli_fetch_array($sql1)){
						array_push($dx,$data1['jawaban']);
					}
					$nilai = variance($dx);

					array_push($varx,$nilai);
					$ind++;
				}
				echo "</tr>";
				echo "<tr><td style='font-size:8px'>Varian</td>";

				for($x=0;$x<count($varx);$x++){
					echo "<td style='font-size:8px'>".number_format($varx[$x],3,',','')."</td>";

				}
				echo "</tr>";

				$vary = variance($dy);

				$reab = (count($dx)/(count($dx)-1)) * (1-(array_sum($varx)/$vary));
				echo "<tr style='font-size:8px'><td>Ket</td>";
				for($x=0;$x<count($varx);$x++){
					$ket = "NR";
					if($varx[$x]>0.60){
						$ket="R";
					}
					echo "<td style='font-size:8px'>".$ket."</td>";

				}
				echo "</tr>";

			?><p>Reabilitas : <?php echo $reab?></p>
			<p>Jumlah Varian Item : <?php echo array_sum($varx)?></p>
			<p>Total skor Varian : <?php echo $vary?></p>
			</table>
			<p>Keterangan</p>
			<p>R = Realibel</p>
			<p>NR = Tidak Realibel</p>
		</div>
	</div>
 <?php
 } ?>

 <?php if ($_GET['sub']=='csi_pgcv')
{ ?>
 	<div class="panel panel-primary" style='margin-left:10px'>
		<div class="panel-heading">
			<div class="panel-title">Hasil Perhitungan</div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered">

			</table>

		</div>
	</div>
 <?php
 } ?>
