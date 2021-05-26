<?php

class Info extends Controller
{
    public function __construct()
    {
        $this->plantModel = $this->model('Plant');
        $this->publicFunc = new PublicFunc;
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
                $this->publicFunc->styling("user-nav");
                // Load View
                $this->view('Info/add', $data);
            }
        } else {
            redirect('users/login');
        }

    }

    public function login()
    {
//         Check if logged in
        if ($this->isLoggedIn()) {
            redirect('Info/index');
        }

        // Check if POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'userName' => trim($_POST['userName']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Check for email
            if (empty($data['userName'])) {
                $Post_error = "10";
                echo json_encode(array($Post_error));
                die();
            }

            // Check for name
            if (empty($data['password'])) {
                $Post_error = "11";
                echo json_encode(array($Post_error));
                die();
            }

            // Check for user
            if ($this->plantModel->findUserByUserName($data['userName'])) {
                // User Found

            } else {
                // No User
                $Post_error = "12";
                echo json_encode(array($Post_error));
                die();
            }

            // Check and set logged in user
            $loggedInUser = $this->plantModel->login($data['userName'], $data['password']);

            if ($loggedInUser) {
                // User Authenticated!
                $this->createPlantsession($loggedInUser);

            } else {
                $Post_error = "12";
                echo json_encode(array($Post_error));
                die();
            }
        } else {

            $data = [
                'userName' => '',
                'password' => ''
            ];
            //Load View
            $this->view('Plants/login', $data);
        }
    }

    // Create Session With User Info
    public function createPlantsession($user)
    {
        $_SESSION['user_id'] = $user->userId;
        $_SESSION['user_name'] = $user->userName;
        $_SESSION['Uname'] = $user->name;
        $_SESSION['center_name'] = "جامعة الكفيل";
        $_SESSION['cPhone'] = "0";
        $_SESSION['uCenterId'] = "0";

        $_SESSION['UImg'] = $user->UImg;

        if ($user->uImgD == 0) {
            $_SESSION['uImgD'] = $user->addUser;
        }

        $Post_error = "1";
        echo json_encode(array($Post_error));
    }

    // Logout & Destroy Session
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['Uname']);
        unset($_SESSION['center_name']);
        unset($_SESSION['cPhone']);
        unset($_SESSION['uCenterId']);

        unset($_SESSION['UImg']);
        unset($_SESSION['uImgD']);

        unset($_SESSION['addUser']);
        unset($_SESSION['addCenter']);
        unset($_SESSION['addVolu']);

        unset($_SESSION['editUser']);
        unset($_SESSION['editCenter']);
        unset($_SESSION['editVolu']);

        unset($_SESSION['deleteUser']);
        unset($_SESSION['deleteCenter']);
        unset($_SESSION['deleteVolu']);


        session_destroy();
        redirect('science/index');
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


    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_SESSION['editUser'])) {

                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

                $data = [
                    'userName' => trim($_POST['userName']),
                    'newPassword' => trim($_POST['newPassword']),
                    'newPasswordConfiorm' => trim($_POST['newPasswordConfiorm']),
                    'id' => trim($_POST['lId'])

                ];


                if (empty($data['userName']) || empty($data['newPassword']) || empty($data['newPasswordConfiorm'])) {
                    $Post_error = "40";
                    echo json_encode(array($Post_error));
                    die();
                }

                if ($data['newPassword'] != $data['newPasswordConfiorm']) {
                    $Post_error = "41";
                    echo json_encode(array($Post_error));
                    die();
                }


//                $loggedInUser = $this->plantModel->login($data['userName'], $data['prePassword']);

                // Check for user
                if ($this->plantModel->findUserNameToChangePassword($data['userName'])) {
                    // User Found
                    $dataU['password'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                    $dataU['id'] = $data['id'];

                    if ($this->plantModel->updatePassword($dataU)) {
                        $Post_error = "succ";
                        echo json_encode(array($Post_error));
                    } else {

                        die('error');
                    }

                } else {
                    die('user Not found');
                }
            } else {
                //Not Authorized to Edit User
                die('Not authorized');
            }
        } else {

            $this->index();
        }
    }

    public function changePermission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_SESSION['editUser'])) {

                // Sanitize POST
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


                $data = [
                    'addUser' => trim($_POST['addUser']),
                    'editUser' => trim($_POST['editUser']),
                    'deleteUser' => trim($_POST['deleteUser']),

                    'addCenter' => trim($_POST['addCenter']),
                    'editCenter' => trim($_POST['editCenter']),
                    'deleteCenter' => trim($_POST['deleteCenter']),

                    'addVolu' => trim($_POST['addVolu']),
                    'editVolu' => trim($_POST['editVolu']),
                    'deleteVolu' => trim($_POST['deleteVolu']),
                    'user_Id' => trim($_POST['lId'])

                ];


                if (!isset($data['addUser']) || !isset($data['editUser']) || !isset($data['deleteUser'])
                    || !isset($data['addCenter']) || !isset($data['editCenter']) || !isset($data['deleteCenter'])
                    || !isset($data['addVolu']) || !isset($data['editVolu']) || !isset($data['deleteVolu'])
                    || !isset($data['user_Id'])) {

                    $Post_error = "40";
                    echo json_encode(array($Post_error));
                    die();
                }


                if ($this->plantModel->changePermission($data)) {
                    $Post_error = "succ";
                    echo json_encode(array($Post_error));
                } else {

                    die('error');
                }


            } else {
                //Not Authorized to Edit User
                die();
            }
        } else {

            $this->index();
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['editUser'])) {

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

                } else {
                    $Post_error = "err";
                    echo json_encode(array($Post_error));
                    die();
                }


                if ($this->plantModel->updateUser($data)) {
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