<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = $_POST['password'];
    $pkey = $_POST['pkey'];
    $usertext = $_POST['usertext'];

    $crypt_method = 'aes-128-cbc';

    $key = hash('sha256', $password);

    $iv = substr(hash('sha256', $pkey), 0, 16);
    

    if ($_POST['action'] == 'enkripsi') {
        $output = openssl_encrypt($usertext, $crypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if ($_POST['action'] == 'dekripsi') {
        $output = base64_decode($usertext);
        $output = openssl_decrypt($output, $crypt_method, $key, 0, $iv);
    }
    else {
        header('Location: ./webenkripsi/encdec.php');
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encrypt & Decrypt Your Text!</title>
    <link rel="stylesheet" href="./assets/style.css"> 
</head>
<body>
    <div class="background">
        <div class="container">
            <div class="text">
                <h1> TUGAS IT SECURITY </h1>
                <h3> Nama Kelompok </h3>
                <p>Chevko Ronaldi Savino</p>
                <p>Lathifa Aini</p>
                <p>Divanca Salma Fadhillah</p>
            </div>

            <form action="./encdec.php" method="POST">
                <div class="top-form">
                    <div class="form-1">
                        <label for="password" class="form-label1">Password</label>
                        <input type="text" id="password" name="password" value="<?php echo $password ?? null ?>">
                    </div>
                    <div class="form-1">
                        <label for="pkey" class="form-label1">Key</label>
                        <input type="text" id="pkey" name="pkey" value="<?php echo $pkey ?? null ?>">
                    </div>
                </div>
                <div class="bot-form">
                    <div class="form-2">
                        <label for="usertext">Text</label>
                        <input type="text" id="usertext" name="usertext" value="<?php echo $output ?? null ?>">
                    </div>
                </div>
                <div class="button">
                    <button type="submit" name="action" value="enkripsi">Enkripsi</button>
                    <button type="submit" name="action" value="dekripsi">Dekripsi</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>