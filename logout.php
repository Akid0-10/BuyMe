<?php

// Start the session and destroy it, then head to the index page
session_start();
session_destroy();
header("Location: index.php");

?>