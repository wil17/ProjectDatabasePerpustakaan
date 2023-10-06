<?php
include "connectDatabase.php";

if(isset($_POST['idp']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }

    $idp = validate($_POST['idp']);
    $password = validate($_POST['password']);

    if(empty($idp)) {
        header("Location: index.php?error=masukkan ID Petugas anda");
        exit();
    } else if(empty($password)){
        header("Location: index.php?error=masukkan password anda");
        exit();
    } else{
        $sql = "SELECT * FROM petugas WHERE id_petugas = '$idp' AND password= '$password'";

        $result =  mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)) {
            echo "login berhasil";
            header("Location: dashboard.php");
        }
        else{
            header("Location : index.php?error=ID Petugas atau Password salah");
            exit();
        }
    }
}

else{
    header("Location: index.php");
    exit();
}

?>