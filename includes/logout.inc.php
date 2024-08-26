<?php
require_once 'includes/config_session.inc.php';
session_destroy();
header('Location: index.php');
exit;