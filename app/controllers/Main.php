<?php

class Main extends Controller
{
    public function __construct()
    {
        $this->plantModel = $this->model('Plant');
    }

    public function index()
    {

        //        if (!$this->isLoggedIn()) {
//            redirect('Plants/login');
//        }
//        if (isset($_SESSION['editCenter'])
//            || isset($_SESSION['deleteCenter'])) {
        $Plants = $this->plantModel->getPlants();
        $data = ['Plants' => $Plants,];
        $this->view('main/index', $data);
//        } else {
//
//            redirect('Info');
//        }


    }



    public function details($pId = 0)
    {

        $Plants = $this->plantModel->getPlantById($pId);
        $data =  $Plants;
        $this->view('main/details',$data);
    }

}
