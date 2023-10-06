<?php

function template_sidebar(){
echo <<<EOT
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Sider Menu Bar CSS</title>
    <link rel="stylesheet" href="styleSidebar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  </head>
  <body>
    <input type="checkbox" id="check" />
    <label for="check">
      <i class="fa fa-bars" id="btn"></i>
      <i class="fa fa-remove" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Perpustakaan Pusat</header>
      <ul>
        <li>
          <a href="dashboard.php"><i class="fa fa-th-large"></i>Dashboard</a>
        </li>
        <li>
          <a href="book.php"><i class="fa fa-file-text-o"></i>Buku</a>
        </li>
        <li>
          <a href="read.php"><i class="fa fa-group"></i>Mahasiswa</a>
        </li>
        <li>
          <a href="datapinjam.php"><i class="fa fa-edit"></i>Peminjaman</a>
        </li>
        <li>
          <a href="#"><i class="fa fa-refresh"></i>Pengembalian</a>
        </li>
      </ul>
    </div>
    <section></section>
  </body>
</html>
EOT;
}
?>