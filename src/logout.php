<?php

/**
 * Single blank line
 */

session_start();
session_destroy();
header("Location: login.php");
exit;
