<?php
    class CategoryModel extends Model{
        public function __construct(){
            parent::__construct();
            
        }
        public function getAllCategory(){
            $sql = "select * from category";
            return $this->db->executeQuery($sql);
        }
    }