<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<?php require_once 'nav.php' ?>  
 
<main class="container mt-3" style="text-align: right!important;">
<form method="POST">

<p class="font-weight-bold"> Email </p>
<input class="form-control" type="email" name="email" required/>


<p class="font-weight-bold">Password  </p>
<input class="form-control" type="password" name="password" required/>
<a href="reset.php"> Je wachtwoord vergeten  </a>
<br>
<a class="btn btn-outline-dark mt-3" href="register.php">login </a>
<button class="btn btn-warning mt-3" type="submit" name="login"> aanmelden</button>

</form>

<?php
if(isset($_POST['login'])){
    require_once 'connectToDatabase.php';
$login = $database->prepare("SELECT * FROM users WHERE EMAIL = :email AND PASSWORD = :password");
$login->bindParam("email",$_POST['email']);
$passwordUser = sha1($_POST['password']);
$login->bindParam("password",$passwordUser);
$login->execute();
if($login->rowCount()===1){
$user = $login->fetchObject();
if($user->ACTIVATED === "1"){
    session_start();
$_SESSION['user'] = $user;

if($user->ROLE ==="USER"){
header("location:user/index.php",true);
}else if($user->ROLE ==="ADMIN"){
    header("location:admin/index.php",true);
}else if($user->ROLE ==="SUPER-ADMIN"){
    header("location:super-admin/index.php",true);
}

}else{
    echo '
    <div class="alert alert-warning">  
    Activeer eerst uw account, we hebben uw accountverificatiecode naar uw e-mail gestuurd
    </div>
    ';
}
}else{
 echo '
 <div class="alert alert-danger">
 Het wachtwoord of e-mailadres is onjuist       
 </div>
 ';   
}
}
?>
</main>


</body>
</html>