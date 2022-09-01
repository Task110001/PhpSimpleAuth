<?
    session_start();
    if(!isset($_SESSION['id']))
    {
        header('Location: /signin.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
    <body>
        
    </body>
</html>