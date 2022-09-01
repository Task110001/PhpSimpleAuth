<?

    session_start();
    if (isset($_SESSION['id']))
    {
        header("Location: /index.php");
        exit;
    }

    require_once ("config.php");

    if (isset($_POST['submit']))
    {
        $error = "";

        if (strlen($_POST['email']) > 32)
        {
            $error = "Lenght mail > 32!";
        } else { $email = @htmlspecialchars($_POST['email']); }

        if (strlen($_POST['username']) < 4)
        {
            $error = "<b>Username</b> length must be greater than 4!";    
        }
        else { $username = @htmlspecialchars($_POST['username']); }

        if (strlen($_POST['password']) < 8)
        {
            $error = "Lenght <b>password</b> must be greater than 8!";
        } else { $password = @htmlspecialchars($_POST['password']); }


        if (!$error) 
        {
            if(strlen($_POST['username']) > 32) {
                $error = "Size of <b>login</b> must be less then 32 symbols";
            } 
    
            if(strlen($_POST['password']) > 32) {
                $error = "Size of <b>Пароль</b> must be less then 32 symbols";
            } 
        }

        if (!$error)
        {
            try {
                $sql = "insert into users (username, email, passwd) values (:username, :email, :passwd)";
                $stmt = $conn->prepare($sql);

                $stmt->bindValue(":username", $_POST["username"]);
                $stmt->bindValue(":email", $_POST["email"]);
                $stmt->bindValue(":passwd", md5($_POST["password"]));


                $complete = $stmt->execute();
                $error = "You authorized!";
            } catch (PDOException $e) {
                $error = "User already exist.";
            }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="./js/jQuery.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
    <body>
        

        <div class="login__menu border">

            <form method="post">

                <label for="username">Login:</label>
                <input type="text" name="username"/><br>
                <label for="email">Email:</label>
                <input type="email" name="email">
                <label for="password">Password:</label>
                <input type="password" name="password"/><br>
                <label for="Repassword">Repeat password:</label>
                <input type="password" name="Repassword"/><br>
                <!-- <button type="submit">Sign Up</button> -->
                <input type="submit" name="submit" value="Sign Up"/>

                <p><?echo $error;?></p>
            </form>

        </div>
        
        

    </body>
</html>