<?php
class AdminTourController
{
    public $tour;

    public function __construct()
    {
        $this->tour = new Tour();
    }

    // Hiển thị danh sách tour
    public function danhSachTour()
    {
        $tours = $this->tour->getAll();
        require_once './views/tour/list.php';
    }
}
