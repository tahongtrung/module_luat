<?php
    class View{
        
        public function __construct(){
            
        }
        public function render($path , $include = true){
            if($include){
                include "view/header.php";
                include "view/$path.php";
                include "view/footer.php";
                
            }else{
                include "view/$path.php";
            }
        } 
    }
   