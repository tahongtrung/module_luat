<?php
    class MenuModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        public function getAllMenu(){
            $sql = "select a.*,b.title as category_title from menu a inner join category b on a.idcategory = b.id";
            return $this->db->executeQuery($sql);
        } 
        public function getMenuByalias($alias){
            $sql = "select a.*,b.title as category_title from menu a inner join category b on a.idcategory = b.id where a.alias ='$alias'";
            return $this->db->executeQuery($sql);
        }
        public function getMenuById($id){
            $sql = "select a.*,b.title as category_title from menu a inner join category b on a.idcategory = b.id where a.id ='$id'";
            return $this->db->executeQuery($sql);
        }
        public function getMenuByCategoryId($category_id){
            $sql = "select a.*,b.title as category_title from menu a inner join category b on a.idcategory = b.id where a.idcategory = $category_id order by a.title";
            return $this->db->executeQuery($sql);
        }
        public function ratingMenu($idMenu, $score){
            $sql = "update menu set rate = rate + 1,score = score + $score where id=$idMenu";
            $this->db->executeNonQuery($sql);
        }
    }