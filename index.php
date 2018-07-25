<?php 
    session_start();
    include "config/config.php";
    include "lib/database.php";
    include "lib/controller.php";
    include "lib/model.php";
    include "lib/view.php";
    include "controller/base.php";
    
    new BaseController();