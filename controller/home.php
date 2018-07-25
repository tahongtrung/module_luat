<?php
    class HomeController extends Controller{
        
        public function __construct($param = null){
            parent::__construct();
            $this->index();
        }
        public function index(){
            $this->view->class = "menu";
            $this->view->title = "Dedicate Delicius to British Food";
            $this->view->render("home/index");
        } 
    }


