<?php
    class MenuController extends Controller{
        
        public function __construct($param = null){
            parent::__construct();
            include "model/category.php";
            include "model/menu.php";
            $action = isset($_POST["action"]) ? $_POST["action"] : "";
            
            if($action == ""){
                if($param != null){
                    if($param[0]== "feed"){
                        $this->writeRSS();
                    }
                    else{
                        $this->detail($param[0]);
                    }
                
                }else{
                $this->index();
                }
            }
            else{
                if($action = "rating"){
                    $this->rating();
                }
            }
        }
        public function index(){
            $menuModel = new MenuModel();//tao bien truy xuat vao menuModel.
            $categoryModel = new CategoryModel();//tao bien truy xuat vao categoryModel
            $listCat = $categoryModel->getAllCategory();//tao bien listcat de luu du lieu lay ra tu categoryModel.
            //duyet qa cac gia tri.listcat as cat.
            foreach($listCat as $cat){
                //lay danh sach cac dong theo id. $cat->listcat = menumodel ->getmenubycategoryid(cat->id).
                $cat->listMenu = $menuModel->getMenuByCategoryId($cat->id);
                $rate = 0;//bien tong diem da dc rate.
                $score = 0;// bien luu diem rating 
                $count = 0;// bien so luong ng rating
               
                foreach($cat->listMenu as $menu){//duyet trong mang con cua category id nay.
                    if($menu->rate > 0){//neu co nhiu ng rate o id do.
                        $rate += $menu->rate;
                        $score += number_format((float)$menu->score/$menu->rate , 1);
                        $count++;
                    }
                }
                if($count > 1){
                    $score = number_format((float)$score/$count ,1);
                }
                $cat->rate = $rate;
                $cat->score = $score;
                $cat->more = ($rate > 1) ? "s" : "";
                }
                $this->view->listCat = $listCat;
                $this->view->class = "menu";
                $this->view->title = "Menus";
                $this->view->render("menu/index");
         }
         public function detail($alias){
            $menuModel = new MenuModel();
            $menuList = $menuModel->getMenuByalias($alias);
            $menu = $menuList[0];
            if(count($menu) > 0){
                if($menu->rate > 1){
                    $menu->score = number_format((float)$menu->score/$menu->rate, 1);   
                    $menu->more = "s";
                }
                $this->view->title = $menu->title ." - &pound;" .$menu->price;
                $this->view->menu = $menu;
                $this->view->render("menu/menu");
            }else{
                $this->index();//tranh truong hop hacking website.
            }
         }
         public function writeRSS(){
            $menuModel = new MenuModel();
            $listMenu = $menuModel->getAllMenu();
            foreach($listMenu as $menu){
                if($menu->rate > 0){
                    $menu->score = number_format((float)$menu->score/$menu->rate,1);
                    $menu->more = ($menu->rate >1) ? "s" : "";  
                    
                }
            }
            $this->view->listMenu = $listMenu;
            $this->view->render("menu/rss",false);
         }
         public function rating(){
            $menuModel = new MenuModel();
            $idMenu = isset($_POST["idMenu"]) ? $_POST["idMenu"] : "";
            $score = isset($_POST["rating"]) ? $_POST["rating"] : "";
            $captcha = isset($_POST["captcha_input"]) ? $_POST["captcha_input"] : "";
            $menu = $menuModel->getMenuById($idMenu);
            if($captcha == $_SESSION["captcha"]){
                $menuModel->ratingMenu($idMenu , $score);
                unset($_SESSION["captcha"]);
                if(isset($_SESSION["voted"])){
                    $_SESSION["voted"] = array();
                }
                array_push($_SESSION["voted"], $idMenu);
                $this->view->message = "1";//rate success;
                
            }else{
                $this->view->message = "2"; //captcha input invalid.
            }
            $this->detail($menu[0]->alias);
         }
    }
