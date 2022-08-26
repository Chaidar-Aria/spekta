<?php
session_start();
require_once '../../app/helper/base_url.php';
require_once '../../app/helper/tgl_indo.php';
require_once '../../config/koneksi.php';
require '../../vendor/autoload.php';
$email = $_SESSION['email'];
$c_email = "SELECT * FROM tb_account WHERE email = '$email'";
$r_email = mysqli_query($conn, $c_email) or die(mysqli_error($conn));
while ($r = mysqli_fetch_array($r_email)) {
    $id_acc = $r['id_acc'];
    if ($r['is_active'] == '0') { ?>
<script>
window.location.href = "pending";
</script>
<?php }
}
$sql = "SELECT * FROM db_spekta_3.tb_users
        INNER JOIN db_spekta_3.tb_users_address ON db_spekta_3.tb_users.id_users = db_spekta_3.tb_users_address.id_users
        INNER JOIN db_spekta_3.tb_users_utility ON db_spekta_3.tb_users.id_users = db_spekta_3.tb_users_utility.id_users
        INNER JOIN db_spekta_3.tb_users_status ON db_spekta_3.tb_users.id_users = db_spekta_3.tb_users_status.id_users
        INNER JOIN db_spekta_3.tb_religion ON db_spekta_3.tb_users.id_religion = db_spekta_3.tb_religion.id_religion
        INNER JOIN db_spekta_3.tb_class ON db_spekta_3.tb_users.id_class = db_spekta_3.tb_class.id_class
        INNER JOIN db_spekta_3.tb_account ON db_spekta_3.tb_users.id_acc = db_spekta_3.tb_account.id_acc
        INNER JOIN db_cbt_spekta.tb_users_cbt ON db_spekta_3.tb_users.id_users = db_cbt_spekta.tb_users_cbt.id_users
        INNER JOIN db_cbt_spekta.tb_users_cbt_date ON db_cbt_spekta.tb_users_cbt.id_users_cbt = db_cbt_spekta.tb_users_cbt_date.id_users_cbt
        INNER JOIN db_cbt_spekta.tb_users_cbt_choice ON db_cbt_spekta.tb_users_cbt.id_users_cbt = db_cbt_spekta.tb_users_cbt_choice.id_users_cbt
        INNER JOIN db_cbt_spekta.tb_test ON db_cbt_spekta.tb_users_cbt_choice.test_id = db_cbt_spekta.tb_test.test_id
        WHERE tb_account.id_acc = '$id_acc'
        ";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
while ($d = mysqli_fetch_array($result)) {
    if ($d['pilih_jadwal_cbt'] == "0" | $d['pilih_ekstra'] == "0") { ?>
<script>
window.location.href = "exam?mes=ekstra_cbt_null";
</script>
<?php
    }
    ?>

<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>KARTU UJIAN CBT SPEKTA | Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan
    </title>

    <style>
    .txt-center {
        text-align: center;
    }

    .border- {
        border: 1px solid #000 !important;
    }

    .padding {
        padding: 15px;
    }

    .mar-bot {
        margin-bottom: 15px;
    }

    .admit-card {
        border: 2px solid #000;
        padding: 15px;
        margin: 20px 0;
    }

    .BoxA h5,
    .BoxA p {
        margin: 0;
    }

    table img {
        width: 100%;
        margin: 0 auto;
    }

    .table-bordered td,
    .table-bordered th,
    .table thead th {
        border: 1px solid #000000 !important;
    }

    @page {
        size: auto;
        margin: 5px 0px 0px 0px;

    }

    @page {
        size: legal;
        margin: 5px 0px 0px 0px;

    }

    @media print {
        .tombol-aksi {
            display: none;
            overflow: hidden !important
        }

        .toolbar {
            display: none;
        }

        body {
            margin: 0mm;
        }
    }
    </style>

</head>

<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

    <section>
        <div class="container">
            <div class="tombol-aksi text-center">
                <button onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                <a href="exam"><button class="btn btn-info"><i class="fa fa-arrow-left"></i>
                        Kembali</button></a>
            </div>
            <div class="admit-card">
                <div class="BoxA border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5>SMA NEGERI 1 MEJAYAN</h5>
                            <p>Jl.P.Sudirman, No.82, <br>Mejayan, Kab.Madiun 63153</p>
                        </div>
                        <div class="col-sm-4 txt-center">
                            <img src="../../assets/img/logo_smansa.png" width="100px;" />
                        </div>
                        <div class="col-sm-4">
                            <h5>CBT SPEKTA | SPEKTA SMANSA</h5>
                            <p>KARTU UJIAN</p>
                        </div>
                    </div>
                </div>
                <div class="BoxC border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>USERNAME CBT: <?php echo $d['username'] ?></h5>
                            <h5>PASSWORD CBT: <?php echo $d['password'] ?></h5>
                        </div>

                    </div>
                </div>
                <div class="BoxD border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><b>Nomor Peserta : <?php echo $d['username'] ?></b></td>
                                        <td><b>Nama Ujian: </b> <?php echo $d['test_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Nama Peserta: </b><?php echo $d['name'] ?></td>
                                        <td><b>Jenis Kelamin:
                                            </b><?php if ($d['gender'] == "L") {
                                                        echo "LAKI-LAKI";
                                                    } else {
                                                        echo "PEREMPUAN";
                                                    } ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Ujian: </b><?php echo tgl_indo($d['users_cbt_date']) ?> </td>
                                        <td>
                                            <b>Jam Ujian:
                                            </b><?php echo date("h:i", strtotime($d['cbt_start_time'])) . "~" . date("h:i", strtotime($d['cbt_end_time'])) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="    height: 125px;">Saya menyatakan bahwa seluruh
                                            informasi/data yang saya isikan dalam
                                            aplikasi pendaftaran adalah benar. <br><br><br>
                                            <b>
                                                <p style="text-align: right;"> Mejayan,
                                                    <?php echo tgl_indo(date("Y-m-d")) ?>
                                                <p style="text-align: right; margin-top:-15px;"> Yang membuat pernyataan
                                                    <br><br><br>
                                                    <?php echo $d['name'] ?>
                                                </p>
                                            </b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-2 txt-center">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>

                                        <th scope="row txt-center">
                                            <?php if ($d['foto_users'] == NULL) { ?>
                                            <img src="<?php echo $actual_link . '/assets/img/Logo SS.png' ?>"
                                                alt="img user" width="150px">
                                            <?php } else { ?>
                                            <img src="<?php echo $actual_link . '/assets/img/user/' . $d['foto_users']; ?>"
                                                alt="img user" width="150px">
                                            <?php } ?>
                                        </th>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="d-flex justify-content-center">
                                <?php
                                // This will output the barcode as HTML output to display in the browser
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                echo $generator->getBarcode($d['username'], $generator::TYPE_CODE_128, 1, 50);
                                ?>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="BoxE border- padding mar-bot">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Peserta Wajib:</h5>
                            <ol>
                                <li>Mengikuti jadwal ujian sesuai dengan jadwal;</li>
                                <li>Hadir di lokasi ujian 60 menit sebelum ujian dimulai;</li>
                                <li>Membawa Kartu Ujian CBT SPEKTA; </li>
                                <li>Membawa Kartu Identitas Diri (KTP atau KK bagi yg belum memiliki KTP atau SIM atau
                                    Passpor);</li>
                                <li>Membawa:
                                    <ol>
                                        <li>Kartu Verifikasi dan Validasi (verval) SPEKTA;</li>
                                        <li>Kartu Ekstrakurikuler
                                        </li>
                                    </ol>
                                </li>
                                <li>Menaati segala aturan selama pelaksaan CBT SPEKTA
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <footer class="txt-center">
                    <p>PANITIA SELEKSI SPEKTA SMA NEGERI 1 MEJAYAN</p>
                    <p>Sistem Pencatatan Keuangan dan Keanggotaaan Ekstrakurikuler SMA Negeri 1 Mejayan</p>
                </footer>

            </div>
        </div>

    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener('contextmenu', event => event.preventDefault());

    // To disable F12 options
    document.onkeypress = function(event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onmousedown = function(event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onkeydown = function(event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }

    // To To Disable ctrl + c, ctrl + u

    jQuery(document).ready(function($) {
        $(document).keydown(function(event) {
            var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();

            if (event.ctrlKey && (pressedKey == "c" || pressedKey == "u")) {
                //disable key press porcessing
                return false;
            }
        });
    });

    function getkey(e) {
        if (window.event)
            return window.event.keyCode;
        else if (e)
            return e.which;
        else
            return null;
    }

    function goodchars(e, goods, field) {
        var key, keychar;
        key = getkey(e);
        if (key == null) return true;

        keychar = String.fromCharCode(key);
        keychar = keychar.toLowerCase();
        goods = goods.toLowerCase();

        // check goodkeys
        if (goods.indexOf(keychar) != -1)
            return true;
        // control keys
        if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
            return true;

        if (key == 13) {
            var i;
            for (i = 0; i < field.form.elements.length; i++)
                if (field == field.form.elements[i])
                    break;
            i = (i + 1) % field.form.elements.length;
            field.form.elements[i].focus();
            return false;
        };
        // else return false
        return false;
    }
    </script>

</body>

</html>
<?php } ?>