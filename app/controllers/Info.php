<?php

class Info extends Controller
{
    public function __construct()
    {
        $this->plantModel = $this->model('Plant');
//        $this->publicFunc = new PublicFunc;
    }

    public function index()
    {
        if (!$this->isLoggedIn()) {
            redirect('Plants/login');
        }
        if (isset($_SESSION['user_id'])) {
            $Plants = $this->plantModel->getPlants();

            $data = [
                'Plants' => $Plants,
            ];

//            $this->publicFunc->styling("user-nav");

            $this->view('info/index', $data);
        } else {
            redirect('info');
        }

    }

    public function replaceImage()
    {
        if (isset($_SESSION['addUser']) || isset($_SESSION['editUser'])) {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if (isset($_FILES['img']) != '') {

                    $filename = $_FILES['img']['tmp_name'];
                    $size = getimagesize($filename);
                    if ($size === false) {
                        $Post_error = "50";
                        echo json_encode(array($Post_error));
                        die();
                    }
                    if ($size[0] > 6000 || $size[1] > 6000) {
                        $Post_error = "50";
                        echo json_encode(array($Post_error));
                        die();
                    }
                    if (!$img = @imagecreatefromstring(file_get_contents($filename))) {
                        $Post_error = "50";
                        echo json_encode(array($Post_error));
                        die();
                    }
                    $this->plantModel->setImgName($_FILES['img']['tmp_name'], $_FILES['img']['name']);
                }

                $data = [
                    'id' => trim($_POST['id'])
                ];

                if ($this->plantModel->replaceImg($data)) {
                    $Post_error = "succ";
                    echo json_encode(array($Post_error));
                    die();

                } else {
                    $Post_error = "err";
                    echo json_encode(array($Post_error));
                    die();

                }


            } else {
                // IF NOT A POST REQUEST

                $Plants = $this->plantModel->getPlants();

                $cities = $this->cityModel->getJsonCities();

                $data = [
                    'Plants' => $Plants,

                    'cities' => $cities
                ];


                // Load View
                $this->view('Plants', $data);
            }
        } else {
            redirect("Plants");
        }
    }

    public function add()
    {

        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if (isset($_FILES['imgs']) == '') {
                    $Post_error = "50";
                    echo json_encode(array($Post_error));
                    die();
                }
                $this->plantModel->setImgName($_FILES['imgs']['tmp_name'], $_FILES['imgs']['name']);
                $data = [
                    'name' => trim($_POST['name']),
                    'ename' => trim($_POST['ename']),
                    'det' => trim($_POST['det']),
                    'type' => trim($_POST['type']),
                ];

                if ($this->plantModel->addPlant($data)) {

                } else {
                    die();
                }

                $Post_error = "200";
                echo json_encode(array($Post_error));
                die();

            } else {
                // IF NOT A POST REQUEST
                $Plants = $this->plantModel->getPlants();
                $data = [
                    'Plants' => $Plants,
                ];
//                $this->publicFunc->styling("user-nav");
                // Load View
                $this->view('Info/add', $data);
            }
        } else {
            redirect('users/login');
        }

    }

    public function update($pId = 0)
    {

        if (isset($_SESSION['user_id'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if (isset($_FILES['imgs']) == '') {
                    $Post_error = "50";
                    echo json_encode(array($Post_error));
                    die();
                }
                $this->plantModel->setImgName($_FILES['imgs']['tmp_name'], $_FILES['imgs']['name']);
                $data = [
                    'name' => trim($_POST['name']),
                    'ename' => trim($_POST['ename']),
                    'det' => trim($_POST['det']),
                    'type' => trim($_POST['type']),
                ];

                if ($this->plantModel->addPlant($data)) {

                } else {
                    die();
                }

                $Post_error = "200";
                echo json_encode(array($Post_error));
                die();

            } else {
                // IF NOT A POST REQUEST
                $Plant = $this->plantModel->getPlantById($pId);
//                $data = [
//                    'Plants' => $Plants,
//                ];
//                $this->publicFunc->styling("user-nav");
                // Load View
                $this->view('Info/update', $Plant);
            }
        } else {
            redirect('users/login');
        }

    }


    // Check Logged In
    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }



    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            if (isset($_SESSION['editUser'])) {

                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

                $params = $_POST;
                if (isset($params['name']) && isset($params['value']) && isset($params['pk'])) {

                    if ($params['name'] == 'name' || $params['name'] == 'userName' || $params['name'] == 'password'
                        || $params['name'] == 'centerId' || $params['name'] == 'phoneNo' || $params['name'] == 'city'
                        || $params['name'] == 'age' || $params['name'] == 'identifierName' || $params['name'] == 'identifierPhone'
                        || $params['name'] == 'isActive' || $params['name'] == 'isDeleted'
                        || $params['name'] == 'uImgDeleted') {

                        $data = [
                            'name' => trim($params["name"]),
                            'value' => trim($params["value"]),
                            'pk' => trim($params["pk"])
                        ];

                        if (trim($params["name"]) != 'isActive') {
                            if (empty($data['name']) || empty($data['value']) || empty($data['pk'])) {
                                $Post_error = "err";
                                echo json_encode(array($Post_error));
                                die();
                            }
                        }
                    }

//                } else {
//                    $Post_error = "err";
//                    echo json_encode(array($Post_error));
//                    die();
//                }


                if ($this->plantModel->updatePlant($data)) {
                    $Post_error = "succ";
                    echo json_encode(array($Post_error));
                } else {
                    die('');
                }
            } else {
                //Not Authorized to Edit User
                $Post_error = "err";
                echo json_encode(array($Post_error));
                die();
            }
        } else {

            $this->index();
        }
    }

}