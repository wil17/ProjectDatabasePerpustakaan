<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="logo"><img src="ulm.png" width="70px"></div>
    <div><h3 id="t1"> UPT PERPUSTAKAAN</h3></div>
    <div><h3 id="t2"> UNIVERSITAS LAMBUNG MANGKURAT</h3><div>
    <div class="main">
        <div class="log-side">
            <div></div>
            <div class="input-box">
                <h2>LOGIN PETUGAS PERPUSTAKAAN ULM</h2>
                <form action="login.php" method="post">
                    <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <label>ID Petugas :</label>
                    <input type="text" name="idp" id="idp"><br>

                    <label>Password :</label>
                    <input type="password" name="password" id="pass"><br>

                    <button type="submit" id="btn">Login</button>
                </form>
            </div>
        </div>
        <div class="right-side">
            <div class="pic"><img src="log.PNG" width="450px"></div>
        </div>
    </div>
</body>
</html>
