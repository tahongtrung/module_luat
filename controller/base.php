<?php
    class BaseController{
        
        private $_controller;
        protected $_param;
        
        public function __construct(){
            $this->parseURL();
            $this->load();
        } 
        public function parseURL(){
            $url = isset($_GET["url"]) ? $_GET["url"] : "";
            if($url != ""){
                $ar_url = explode("/",$url);
                $this->_controller = $ar_url[0];
                array_shift($ar_url);
                if(count($ar_url) > 0){
                    $this->_param = array();
                    foreach($ar_url as $tmp){
                        if(trim($tmp) != ""){
                            array_push($this->_param , $tmp);
                        }
                        
                    }
                }
            }else{
                $this->_controller = "home";
            }
        }
        public function load(){
            $cName = ucfirst($this->_controller)."Controller";
            $path = "controller/".$this->_controller.".php";
            
            if(file_exists($path)){
                include $path;
                new $cName($this->_param);
            }
            else{
                include "controller/home.php";
                new HomeController();
            }
        } 
    }
