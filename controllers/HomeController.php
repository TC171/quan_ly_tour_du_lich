<?php
class HomeController {
   public function home(){
        require_once './views/home.php';
    }

    public function about() {
        include "views/about.php";
    }
}
