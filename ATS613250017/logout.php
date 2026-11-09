<?php
session_start();
session_destroy(); // hapus seluruh data session
header('Location: index.php');
exit;
