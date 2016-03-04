<?php

session_start();

$_SESSION = array();

session_destroy();

print 1;