<?php

require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    
    $queryAdd = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname);';
    $statementAdd = $pdo->prepare($queryAdd);
    $statementAdd->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $statementAdd->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $statementAdd->execute();

    header("Location: index.php");
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();
foreach($friends as $friend) {
    
    echo $friend['firstname'] . ' ' . $friend['lastname'] . "<br>";
    
}
?>

<form action="" method="post"> 
    <label for="firstname"> Prénom : </label>
    <input type="text" id="firstname" name="firstname" required maxlenght=45> 
    <label for="lastname"> Nom : </label>
    <input type="text" id="lastname" name="lastname" required maxlenght=45>
    <button type="submit" value="sumbit"> Sumbit </button>
</form>