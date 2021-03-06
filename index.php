<?php
    session_start();
    // session_destroy();exit;
    if(isset($_SESSION['loggedIn'])){
        echo 'working';
        header('Location: admin.php');
    }

    if (!isset($_SESSION['loginBlocked'])) {
        // delete the session if the timeout has finished
        if ($_POST) {
        if (!isset($_POST['username'])) {
            $usernameError = 'Username needs to be set';
        } else if (strlen($_POST['username']) < 3) {
            $usernameError = 'Username needs to be at least 3 characters';
        } else if (strlen($_POST['username']) > 20) {
            $usernameError = 'Username cannot be longer then 20 characters';
        } else {
            $usernameError = null;
        }
        if (!isset($_POST['password'])) {
            $passwordError = 'password needs to be set';
        } else if (strlen($_POST['password']) < 3) {
            $passwordError = 'password needs to be at least 3 characters';
        } else if (strlen($_POST['password']) > 20) {
            $passwordError = 'password cannot be longer then 20 characters';
        } else {
            $passwordError = null;
        }
        if (!$usernameError && !$passwordError) {
            require('./conn.php');
            // var_dump($db);
            try {
                $q = $db->prepare('SELECT * FROM users ');
                $q->execute();
                $row = $q->fetch();
                // var_dump($row->username);

                if ($_POST['username'] == $row->username && $_POST['password'] == $row->password) {
                    $_SESSION['loggedIn'] = true;
                    header('Location: admin.php');
                    die();
                } else {
                    echo 'Failed.. ';
                    // get the current counter
                    if (isset($_SESSION['counter'])) {
                        $counter = $_SESSION['counter'];
                    } else {
                        $counter = 3;
                    }
                    // de-increment the counter by one
                    if ($counter !== 1) {
                        $counter--;
                        $_SESSION['counter'] = $counter;
                        echo 'Tries left: ' . $counter;
                    } else {
                        $_SESSION['loginBlocked'] = true;
                        $timeout = time() + 300;
                        $_SESSION['timeout'] = $timeout;
                        $minutes = floor(300 / 60);
                        $seconds = $minutes / 1000;
                    }
                }

                http_response_code(401);
            } catch (Exception $ex) {
                echo $ex;
            }
        }
        // No errors
        else {
        }
    }
}
// login blocked
else {

    if (isset($_SESSION['timeout'])) {
        if (time() > $_SESSION['timeout']) {
            session_destroy();
        } else {
            $timeout = $_SESSION['timeout'];
            $diff = $timeout- time();
            $minutes = floor($diff / 60);
            $seconds = $minutes / 1000;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Login</title>
</head>

<body>

    <div class="container">
  
        <form action="" class="login" method="POST" <?php if (isset($_SESSION['loginBlocked'])) {
                                                        echo 'onsubmit="return false;"';
                                                    } ?>>
            <h3 class="heading">Login</h3>
            <div class="input-group">
                <label for="username" class="label">Username</label>
                <input name="username" type="text" class="input">
                <?php if (isset($usernameError)) {
                    echo "<p class='error'>$usernameError</p>";
                } ?>
            </div>
            <div class="input-group">
                <label for="password" class="label">Password</label>
                <input name="password" type="password" class="input">
                <?php if (isset($passwordError)) {
                    echo "<p class='error'>$passwordError</p>";
                } ?>
            </div>
            <button class="button">Login</button>

            <?php if (isset($_SESSION['timeout'])) {

                echo "<p class='error'>You have been blocked for 5 minutes after 3 failed attempts. $minutes minutes and $seconds seconds remaining</p>";
            } ?>
            <p id=demo></p>
        </form>
    </div>


    <script>
        var secsLeft = "<?php print($timeout); ?>";
        console.log("MIN: ", secsLeft);
        var d = new Date().getTime() / 1000;
        var s = Math.floor(secsLeft - d);

        setInterval(function() {
            console.log(s);

            var minutes = s / 60;

            document.getElementById("demo").innerHTML = "Javascrup: " + minutes + "m ";
            s--;

            if (minutes < 0) {
                clearInterval();
                document.getElementById("demo").innerHTML = "";
            }
            console.log("min");
        }, 1000);
    </script>
</body>

</html>