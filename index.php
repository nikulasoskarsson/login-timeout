<?php
if($_POST){

    if(!isset($_POST['username'])){
        $usernameError = 'Username needs to be set';
    }
    else if(strlen($_POST['username']) < 3){
        $usernameError = 'Username needs to be at least 3 characters';
    }
    else if(strlen($_POST['username']) > 20){
        $usernameError = 'Username cannot be longer then 20 characters';
    }
    else{
        $usernameError = null;
    }
    if(!isset($_POST['password'])){
        $passwordError = 'password needs to be set';
    }
    else if(strlen($_POST['password']) < 3){
        $passwordError = 'password needs to be at least 3 characters';
    }
    else if(strlen($_POST['password']) > 20){
        $passwordError = 'password cannot be longer then 20 characters';
    }
    else{
        $passwordError = null;
    }

    // No errors 
    if(!$usernameError && !$passwordError){
        require('./conn.php');
        var_dump($db);
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<div class="container">
    <form action="" class="login" method="POST">
        <div class="input-group">
            <label for="username" class="label">Username</label>
            <input name="username" type="text" class="input">
            <?php if(isset($usernameError)) {echo "<p class='error'>$usernameError</p>"; }?>
        </div>
        <div class="input-group">
            <label for="password" class="label">password</label>
            <input name="password" type="password" class="input">
            <?php if(isset($passwordError)) {echo "<p class='error'>$passwordError</p>"; }?>
        </div>
        <button class="button">Login</button>
    </form>
</div>
    
</body>
</html>