<?php

include 'koneksi.php';

$email = $_GET['email'];
$kode = $_GET['code'];

$sql_cek = mysqli_query($conn, "SELECT * FROM tb_account WHERE email='$email' AND code='$kode'");
while ($d = mysqli_fetch_array($sql_cek)) {

    if ($d['is_active'] == '0') {

        $sql = "UPDATE tb_account SET is_active='1', active_at = current_timestamp() WHERE email='$email'";

        if ($conn->query($sql) === TRUE) {
            $sql = "INSERT INTO tb_users (id_acc) SELECT id_acc FROM tb_account WHERE email = '$email';";
            if ($conn->query($sql) === TRUE) {
                $sql = mysqli_query($conn, "SELECT * FROM tb_users INNER JOIN tb_account ON tb_users.id_acc = tb_account.id_acc WHERE tb_account.email = '$email'");
                while ($d = mysqli_fetch_array($sql)) {
                    $idusers = $d['id_users'];
                    $idacc = $d['id_acc'];
                    $sql = "INSERT INTO tb_users_address (id_users) SELECT id_users FROM tb_users WHERE id_users = '$idusers';";
                    if ($conn->query($sql) === TRUE) {
                        $sql2 = "INSERT INTO tb_users_utility (id_users) SELECT id_users FROM tb_users WHERE id_users = '$idusers';";
                        if ($conn->query($sql2) === TRUE) {
                            $sql3 = "INSERT INTO tb_users_status (id_users) SELECT id_users FROM tb_users WHERE id_users = '$idusers';";
                            if ($conn->query($sql3) === TRUE) {
                                $sql4 = "INSERT INTO tb_users_cbt (id_users) SELECT id_users FROM tb_users WHERE id_users = '$idusers';";
                                if ($conn->query($sql4) === TRUE) {
                                    $sql5 = "INSERT INTO tb_level (id_acc) SELECT id_acc FROM tb_account WHERE id_acc = '$idacc';";
                                    if ($conn->query($sql5) === TRUE) {
                                        header('location: ../pages/auth/login?pesan=berhasil');
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                header('location: ../pages/auth/login?pesan=gagal1');
            }
        } else {
            header('location: ../pages/auth/regis?pesan=gagal2');
        }
    } else {
        header('location: ../pages/auth/login?pesan=sudah_aktif');
    }
}