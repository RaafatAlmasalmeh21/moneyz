<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<?php require_once 'nav.php' ?>  

<div class="container" dir="rtl" style="text-align: right !important;">


<form method="POST" >
Naam: <input class="form-control" type="text" name="name" required/>
<br>
Leeftijd: <input class="form-control" type="date" name="age" required/>
<br>
Email: <input class="form-control" type="email" name="email" required/>
<br>
Password: <input class="form-control" type="text" name="password" required />
<br>
<button class="btn btn-dark" type="submit" name="register">Register</button>

<a class="btn btn-warning" href="login.php">login </a>

</form>

</div>


<?php 
   require_once 'connectToDatabase.php';

if(isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
    $email = $_POST['email'];
    $checkEmail->bindParam("EMAIL",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger" role="alert">
        Dit account is eerder gebruikt   
      </div>';
    }else{
        $name =$_POST['name'] ;
        $password = sha1($_POST['password']) ;
        $email = $_POST['email'];
        $age = $_POST['age'];

        $addUser = $database->prepare("INSERT INTO 
        users(NAME,AGE,PASSWORD,EMAIL,SECURITY_CODE,ROLE)
         VALUES(:NAME,:AGE,:PASSWORD,:EMAIL,:SECURITY_CODE,'USER')");


        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("AGE",$age);
        $addUser->bindParam("PASSWORD",$password);
        $addUser->bindParam("EMAIL",$email);
        $securityCode = md5(date("h:i:s"));
     
       
    }

}
?>
</body>
</html>
