<?

    try 
    {
        $conn = new PDO("mysql:host=localhost;dbname=users", "root", "root");
    } catch (PDOException $e) {
        echo "connection failed: ".$e->message;
    }

?>
