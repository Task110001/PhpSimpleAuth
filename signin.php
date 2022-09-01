<?
    session_start();
    if(isset($_SESSION['id']))
    {
        header("Location: /index.php");
        exit;
    }


    require_once ("config.php");
    
    if(isset($_POST['submit']))
    {
        $error = "";
        $username = $_POST["username"];
        $password = $_POST["password"];


        $query = "select * from users where username = ?";
        $select = $conn->prepare($query);
        $select->execute([$username]);
        $result = $select->fetch(PDO::FETCH_LAZY);

        if(!$result)
        {
            $error = "User not found.";
        } else 
        {
            if ($result['passwd'] == md5($password) && !$error)
            {
                $_SESSION['id'] = $result['id'];
                header("Location: /index.php");
                exit;
            }
            else 
            {
                $error = "Wrong password.";
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignIn</title>
    <script src="./js/jQuery.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
    <body>
        

        <div class="login__menu border">

            <form method="post">

                <label for="name">Login:</label>
                <input type="text" name="username"/><br>
                <label for="password">Password:</label>
                <input type="password" name="password"/><br>
                <input type="submit" name="submit" value="Sign In"/>

                <p><?echo $error;?></p>
            </form>
        </div>
        
        

    </body>
</html>