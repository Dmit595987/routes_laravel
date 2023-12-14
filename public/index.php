<?php

use App\RMVC\App as App;

require "../vendor/autoload.php";
require "../routes/web.php";
session_start();

App::run();
