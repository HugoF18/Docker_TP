<?php
session_start();
$pdo = new PDO("mysql:host=database;dbname=data", "root", "password");

if(isset($_POST['registration'])){
    if(!empty($_POST['name']) AND !empty($_POST['password'])){
        $name = htmlspecialchars($_POST['name']);
        $password = md5($_POST['password']);

        $insert_users = $pdo->prepare('INSERT INTO users(name, password) VALUES (?, ?)');
        $insert_users->execute(array($name, $password));


        $recover_users= $pdo->prepare('SELECT * FROM users WHERE name = ? AND password = ?');
        $recover_users->execute(array($name, $password));

        if ($recover_users->rowCount() > 0){
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recover_users->fetch()['id'];

        }
    }else{
        echo "Veuillez completer tous les champs";
    }


}

if(isset($_POST['connection'])){
    if(!empty($_POST['name']) AND !empty($_POST['password'])){
        $name = htmlspecialchars($_POST['name']);
        $password = md5($_POST['password']);
        $recover_users = $pdo->prepare('SELECT * FROM users WHERE name = ? AND password = ?');
        $recover_users->execute(array($name, $password));

        if($recover_users->rowCount() > 0){
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $recover_users->fetch()['id'];
            header('Location: post.php');
        } else{
            echo "Votre mot de passe ou nom est inconnu";
        }
    }else{
        echo "Veuillez completer tous les champs";
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <title>Inscription</title>
</head>
<body>
<h1>Inscription</h1>
<form method="POST">
    <input type="text" name="name" placeholder="nom">
    <input type="password" name="password" placeholder="mot de passe">
    <input type="submit" name="registration">
</form>

<h1>Connexion</h1>
<form method="POST">
    <input type="text" name="name" placeholder="nom">
    <input type="password" name="password" placeholder="mot de passe">
    <input type="submit" name="connection">

</form>
</body>
</html>

