<?php include("koneksi.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Survey SIAKAD</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/blog-post.css" rel="stylesheet">


</head>

<body style="background-color:#ffffff">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:#f6dbc6; border: 0">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color: black;" href="#">E-SURVEY</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-toggle="modal" data-target="#login"><button class="btn btn-primary btn-sm" style="background-color: #ac9c8b; border: 0"><span class="glyphicon glyphicon-log-in"></span> Login</button></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#survey" data-toggle="tab">Survey</a></li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="panel panel-default" style="border: 0;">
            <div class="panel-body" style="background-color:#fff9f3; border: 0">
                <div class="col-lg-12">
                    <img class="img-responsive" src="./images/UTM.jpg" alt="" style="height:300px;width:1290px">
                    <hr>
                </div>
                <div class="col-lg-12">
                    <p align="center" style="background-color: #fff3e6; color: #ac9c8b;">
                        <font size="5">SURVEY SIAKAD</font>
                    </p>
                </div>
                <div class="row">
                    <div class="panel-body">
                        <form method='POST' action='aksi_kuisioner.php' onSubmit=\"return validasisurvey(this)\">
                            <script language="javascript">
                                function validasisurvey(form) {
                                    if (form.name.value == "") {
                                        alert("Anda belum mengisikan nama Anda.");
                                        form.name.focus();
                                        return (false);
                                    }
                                    if (form.prodi.value == "") {
                                        alert("Anda belum mengisikan prodi Anda.");
                                        form.prodi.focus();
                                        return (false);
                                    }
                                }
                            </script>
                            <table class="table">
                                <tr>
                                    <td>
                                        <div class="form-horizontal" style="margin-top:20px;background-color:#fff;padding-top:20px;padding-bottom:20px;">
                                            <div class="page-header" style="margin-left:30px;">
                                                <h3>Informasi Data Diri Responden</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_pelanggan" class="control-label col-sm-2">Nama </label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-user"></span>
                                                        </div>
                                                        <input type="text" id="nama_pelanggan" class="form-control" name="name" placeholder="Nama Pelanggan">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat_pelanggan" class="control-label col-sm-2">Jenis Kelamin</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-bookmark"></span>
                                                        </div>
                                                        <!-- <input type="text" id="alamat_pelanggan" class="form-control" name="prodi" placeholder="Prodi"> -->
                                                        <select name="gender" id="pekerjaan" class="form-control">
                                                            <option value="Laki - Laki">Laki - Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label for="produk" class="control-label col-sm-2">Fakultas</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-tags"></span>
                                                        </div>
                                                        <select name="fakultas" id="fakultas" class="form-control">
                                                            <option value="Ekonomi+dan+Bisnis">Ekonomi dan Bisnis</option>
                                                            <option value="Teknik">Teknik</option>
                                                            <option value="Hukum">Hukum</option>
                                                            <option value="Pertanian">Pertanian</option>
                                                            <option value="Ilmu+Sosial+dan+IlmuBudaya">Ilmu Sosial dan Ilmu Budaya</option>
                                                            <option value="Keislaman">Keislaman</option>
                                                            <option value="Ilmu+Pendidikan">Ilmu Pendidikan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="studi" class="control-label col-sm-2">Program Studi</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-bookmark"></span>
                                                        </div>
                                                        <!-- <input type="text" id="prodi" class="form-control" name="prodi" placeholder="Prodi"> -->
                                                        <select name="prodi" id="prodi" class="form-control">
                                                            <option data-chained="Ekonomi+dan+Bisnis" value="Akuntansi">Akuntansi</option>
                                                            <option data-chained="Ekonomi+dan+Bisnis" value="Manajemen">Manajemen</option>
                                                            <option data-chained="Ekonomi+dan+Bisnis" value="Ekonomi Pembangunan">Ekonomi Pembangunan</option>
                                                            <option data-chained="Ekonomi+dan+Bisnis" value="Akuntansi Sektor Publik">Akuntansi Sektor Publik</option>
                                                            <option data-chained="Ekonomi+dan+Bisnis" value="Akuntansi Sektor Publik">Akuntansi Sektor Publik</option>
                                                            <option data-chained="Teknik" value="Teknik Industri">Teknik Industri</option>
                                                            <option data-chained="Teknik" value="Teknik Informatika">Teknik Informatika</option>
                                                            <option data-chained="Teknik" value="Teknik Elektro">Teknik Elektro</option>
                                                            <option data-chained="Teknik" value="Teknik Mesin">Teknik Mesin</option>
                                                            <option data-chained="Teknik" value="Teknik Mekatronika">Teknik Mekatronika</option>
                                                            <option data-chained="Teknik" value="Sistem Informasi">Sistem Informasi</option>
                                                            <option data-chained="Hukum" value="Ilmu Hukum">Ilmu Hukum</option>
                                                            <option data-chained="Pertanian" value="Teknologi Industri Pertanian">Teknologi Industri Pertanian</option>
                                                            <option data-chained="Pertanian" value="Agroteknologi">Agroteknologi</option>
                                                            <option data-chained="Pertanian" value="Agribisnis">Agribisnis</option>
                                                            <option data-chained="Pertanian" value="Ilmu Kelautan">Ilmu Kelautan</option>
                                                            <option data-chained="Pertanian" value="Manajemen Sumber Daya Perairan">Manajemen Sumber Daya Perairan</option>
                                                            <option data-chained="Ilmu+Sosial+dan+Ilmu+Budaya" value="Ilmu Sosiologi">Ilmu Sosiologi</option>
                                                            <option data-chained="Ilmu+Sosial+dan+Ilmu+Budaya" value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                                                            <option data-chained="Ilmu+Sosial+dan+Ilmu+Budaya" value="Sastra Inggris">Sastra Inggris</option>
                                                            <option data-chained="Ilmu+Sosial+dan+Ilmu+Budaya" value="Psikologi">Psikologi</option>
                                                            <option data-chained="Keislaman" value="Ekonomi Syariah">Ekonomi Syariah</option>
                                                            <option data-chained="Keislaman" value="Hukum Bisnis Syariah">Hukum Bisnis Syariah</option>

                                                            <option data-chained="Ilmu+Pendidikan" value="Pendidikan Guru Sekolah Dasar">Pendidikan Guru Sekolah Dasar</option>
                                                            <option data-chained="Ilmu+Pendidikan" value="Pendidikan Guru Anak Usia Dini">Pendidikan Guru Anak Usia Dini</option>
                                                            <option data-chained="Ilmu+Pendidikan" value="Pendidikan IPA">Pendidikan IPA</option>
                                                            <option data-chained="Ilmu+Pendidikan" value="Pendidikan Informatika">Pendidikan Informatika</option>
                                                            <option data-chained="Ilmu+Pendidikan" value="Pendidikan Bahasa dan Sastra">Pendidikan Bahasa dan Sastra</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nim" class="control-label col-sm-2">NIM</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-bookmark"></span>
                                                        </div>
                                                        <input type="text" id="nim" class="form-control" name="nim" placeholder="NIM">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl" class="control-label col-sm-2">Tanggal</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-calender"></span>
                                                        </div>
                                                        <?php
                                                        include "fungsi/fungsi_indotgl.php";
                                                        $tanggal = date('Y-m-d');
                                                        $tglFinal = tgl_indo($tanggal);
                                                        ?>
                                                        <input type="text" id="tgl" class="form-control" disabled="" name="tanggal" value="<?php echo $tglFinal; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <th width='3%'><b>
                                                        <font face='Tahoma' size='2'>No</font>
                                                    </b></th>
                                                <th colspan='2'>
                                                    <p align='center'><b>
                                                            <font face='Tahoma' size='2'>DESKRIPSI</font>
                                                        </b>
                                                </th>
                                                <th colspan="5" bgcolor=''>
                                                    <p align='center'>
                                                        <font face='Tahoma' size='2'>PENILAIAN RESPONDEN</font>
                                                </th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                error_reporting(0);
                                                $no = 1;
                                                $sql = mysqli_query($db, "SELECT * FROM tvariabel");

                                                while ($data = mysqli_fetch_array($sql)) {
                                                    $id = $data["variabelId"];


                                                    $cekcount = mysqli_query($db, "SELECT * FROM tquestion WHERE tquestion.variabelId = '$id' group BY tquestion.questionId");
                                                    if (count(mysqli_fetch_array($cekcount)) != 0) {
                                                        echo "<tr valign='top'>
                                                            <td><font face='Tahoma' size='2' colspan='1'><b> $no</b></font></td>
                                                            <td colspan='2'><font face='Tahoma' size='2'><b>$data[variabelName]</b></font></td>

                                                            <td height='25' width='9%' bgcolor='#AD8B73'><p align='center'><font face='Tahoma' size='1' color='white'>5</font></td>
                                                            <td height='25' width='8%' bgcolor='#AD8B73'><p align='center'><font face='Tahoma' size='1' color='white'>4</font></td>
                                                            <td height='25' width='8%' bgcolor='#AD8B73'><p align='center'><font face='Tahoma' size='1' color='white'>3</font></td>
                                                            <td height='25' width='8%' bgcolor='#AD8B73'><p align='center'><font face='Tahoma' size='1' color='white'>2</font></td>
                                                            <td height='25' width='11%' bgcolor='#AD8B73'><p align='center'><font face='Tahoma' size='1' color='white'>1</font></td>
                                                        </tr>";
                                                    }

                                                    $i = 1;
                                                    $category = 0;
                                                    $hasil = mysqli_query($db, "SELECT * FROM tquestion WHERE tquestion.variabelId = '$id' group BY tquestion.questionId");
                                                    while ($e = mysqli_fetch_array($hasil)) {
                                                        if ($category != $e['categoryId']) {
                                                            $category = $e['categoryId'];

                                                            $label = "";
                                                            $color = "";
                                                            if ($category == 1) {
                                                                $label = "Kepentingan";
                                                                $color = "#CEAB93";
                                                            } else {
                                                                $label = "Kinerja";
                                                                $color = "#E3CAA5";
                                                            }

                                                            echo "<tr valign='top'>
                                                                    <td bgcolor=$color><font face='Tahoma' size='2' color='white' colspan='1'><b></b></font></td>
                                                                    <td colspan='2' bgcolor=$color><font face='Tahoma' color='white' size='2'><b>$label</b></font></td>

                                                                    <td height='25' width='9%' bgcolor=$color></td>
                                                                    <td height='25' width='9%' bgcolor=$color></td>
                                                                    <td height='25' width='9%' bgcolor=$color></td>
                                                                    <td height='25' width='9%' bgcolor=$color></td>
                                                                    <td height='25' width='9%' bgcolor=$color></td>
                                                                </tr>";
                                                        }

                                                        echo "<tr>
                                                                  <td colspan='1'></td>
                                                                  <td colspan='2'><font face='Tahoma' size='2'> $e[question]</font></td>
                                                                  <td align='center'> <input type='radio' name='asfa$i$data[variabelId]' value='5'> </td>
                                                                  <td align='center'> <input type='radio' name='asfa$i$data[variabelId]' value='4'> </td>
                                                                  <td align='center'> <input type='radio' name='asfa$i$data[variabelId]' value='3'> </td>
                                                                  <td align='center'> <input type='radio' name='asfa$i$data[variabelId]' value='2'> </td>
                                                                  <td align='center'> <input type='radio' name='asfa$i$data[variabelId]' value='1'> </td>
                                                                  </tr>";
                                                        $i++;
                                                    }
                                                    $no++;
                                                }
                                                echo "<br>";

                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="8">
                                        <center><button type="submit" style="background-color: #ac9c8b; border: 0" class="btn btn-primary btn-lg">Submit</button></center>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                        <center class="well">
                                            <font face="Arial" size="1"><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan </b> </i></font>
                                            <font face="Arial" size="1"><b>akan kami terima sebagai sarana bagi kami untuk meningkatkan kualitas pelayanan kami</b> </i></font>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="login">
        <form name="login" action="./adminweb/cek_login.php" method="POST" onSubmit="return validasi(this)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" bgcolor="black">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <div class="modal-title">
                            <center>
                                <h4>Login Admin</h4>
                            </center>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-lock"></span>

                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class=" control-label col-sm-3"></label>
                                <div class="col-sm-1">
                                    <button class="btn btn-primary" style="background-color: #ac9c8b; border: 0" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <center>Survey SIAKAD<br> All rights reserved.</center>
                        <center> <a href="https://Aspiya.com" target="_blank" rel="noopener noreferrer">survey</a></center>

                    </div>
                </div>
            </div>
        </form>
    </div>


    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
        (function($, window, document, undefined) {
            "use strict";

            $.fn.chained = function(parentSelector) {
                return this.each(function() {

                    /* Save this to child because this changes when scope changes. */
                    var child = this;
                    var backup = $(child).clone();

                    /* Handles maximum two parents now. */
                    $(parentSelector).each(function() {
                        $(this).bind("change", function() {
                            updateChildren();
                        });

                        /* Force IE to see something selected on first page load, */
                        /* unless something is already selected */
                        if (!$("option:selected", this).length) {
                            $("option", this).first().attr("selected", "selected");
                        }

                        /* Force updating the children. */
                        updateChildren();
                    });

                    function updateChildren() {
                        var triggerChange = true;
                        var currentlySelectedValue = $("option:selected", child).val();

                        $(child).html(backup.html());

                        /* If multiple parents build value like foo+bar. */
                        var selected = "";
                        $(parentSelector).each(function() {
                            var selectedValue = $("option:selected", this).val();
                            if (selectedValue) {
                                if (selected.length > 0) {
                                    selected += "+";
                                }
                                selected += selectedValue;
                            }
                        });

                        /* Also check for first parent without subclassing. */
                        /* TODO: This should be dynamic and check for each parent */
                        /*       without subclassing. */
                        var first;
                        if ($.isArray(parentSelector)) {
                            first = $(parentSelector[0]).first();
                        } else {
                            first = $(parentSelector).first();
                        }
                        var selectedFirst = $("option:selected", first).val();

                        $("option", child).each(function() {
                            /* Always leave the default value in place. */
                            if ($(this).val() === "") {
                                return;
                            }
                            var matches = [];
                            var data = $(this).data("chained");
                            if (data) {
                                matches = data.split(" ");
                            }
                            if ((matches.indexOf(selected) > -1) || (matches.indexOf(selectedFirst) > -1)) {
                                if ($(this).val() === currentlySelectedValue) {
                                    $(this).prop("selected", true);
                                    triggerChange = false;
                                }
                            } else {
                                $(this).remove();
                            }
                        });

                        /* If we have only the default value disable select. */
                        if (1 === $("option", child).length && $(child).val() === "") {
                            $(child).prop("disabled", true);
                        } else {
                            $(child).prop("disabled", false);
                        }
                        if (triggerChange) {
                            $(child).trigger("change");
                        }
                    }
                });
            };

            /* Alias for those who like to use more English like syntax. */
            $.fn.chainedTo = $.fn.chained;

            /* Default settings for plugin. */
            $.fn.chained.defaults = {};

        })(window.jQuery || window.Zepto, window, document);


        $("#prodi").chained("#fakultas");
    </script>

</body>

</html>