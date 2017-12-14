<?php

    // start session
    session_start();

    if (isset($_SESSION['auth'])) { // if connected close and disconnect

        // Supress session's values
        $_SESSION = array();
        session_destroy();
        session_unset ();

        // Supress cookie
        //setcookie('login');

        header('Location: identification.php?deco=1');

    }else{ 

        header('Location: identification.php');

    }
?>
