<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '17082003';
    $DATABASE_NAME = 'perpustakaan';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="newStyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
  <div class="logo"><img src="ulm.png" style="width:55px;height:55px;"></div>
    <nav class="navtop">
    	<div>
    		<h1>Perpustakaan ULM</h1>
            <a href="awal.php"><i class="fas fa-home"></i>Home</a>
            <a href="dashboard.php"><i class="fas fa-book"></i>Dashboard</a>
    		<a href="logout.php"><i class="fas fa-power-off"></i>Logout</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}

function template_sidebar(){
echo <<<EOT
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Sider Menu Bar CSS</title>
    <link rel="stylesheet" href="styleSidebar.css" />
	<link rel="stylesheet" href="newStyle.css" />
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
          <a href="pengembalian.php"><i class="fa fa-refresh"></i>Pengembalian</a>
        </li>
        <li>
          <a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
        </li>
      </ul>
    </div>
    <section></section>
  </body>
</html>
EOT;
}
?>