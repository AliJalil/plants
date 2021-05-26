<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->publicFunc = new PublicFunc;

    }

    public function index()
    {
        if (!$this->isLoggedIn()) {
            redirect('Plants/login');
        }
        if (isset($_SESSION['editCenter'])
            || isset($_SESSION['deleteCenter'])) {
            $Plants = $this->userModel->getPlants();

            $cities = $this->cityModel->getJsonCities();

            $data = [
                'Plants' => $Plants,
                'cities' => $cities
            ];

            $this->publicFunc->styling("user-nav");

            $this->view('Plants/index', $data);
        } else {

            redirect('Science');
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
                    $this->userModel->setImgName($_FILES['img']['tmp_name'], $_FILES['img']['name']);
                }

                $data = [
                    'id' => trim($_POST['id'])
                ];

                if ($this->userModel->replaceImg($data)) {
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

                $Plants = $this->userModel->getPlants();

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
        if (!$this->isLoggedIn()) {
            redirect('users/loginWeb');
        }

        if (isset($_SESSION['addUser'])) {

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
                    if ($size[0] > 5000 || $size[1] > 5000) {
                        $Post_error = "50";
                        echo json_encode(array($Post_error));
                        die();
                    }
                    if (!$img = @imagecreatefromstring(file_get_contents($filename))) {
                        $Post_error = "50";
                        echo json_encode(array($Post_error));
                        die();
                    }

                    $this->userModel->setImgName($_FILES['img']['tmp_name'], $_FILES['img']['name']);
                }

                $data = [
                    'name' => trim($_POST['name']),
                    'userName' => trim($_POST['userName']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'uPoint' => trim($_POST['uPoint']),
                    'phoneNo' => trim($_POST['phoneNo']),
                    'isActive' => trim($_POST['isActive']),
                    'isAdmin' => "1",
                    'addedBy' => $_SESSION['user_id'],

                    'addUser' =>  isset($_POST['addUser']) != '' ? trim($_POST['addUser'] ): '0',
                    'editUser' =>  isset($_POST['editUser']) != '' ? trim($_POST['editUser'] ): '0',
                    'deleteUser' =>  isset($_POST['deleteUser']) != '' ? trim($_POST['deleteUser'] ): '0',

                    'addUserPoint' =>  isset($_POST['addUserPoint']) != '' ? trim($_POST['addUserPoint'] ): '0',
                    'editUserPoint' =>  isset($_POST['editUserPoint']) != '' ? trim($_POST['editUserPoint'] ): '0',
                    'deleteUserPoint' =>  isset($_POST['deleteUserPoint']) != '' ? trim($_POST['deleteUserPoint'] ): '0',

                    'addPoint' =>  isset($_POST['addPoint']) != '' ? trim($_POST['addPoint'] ): '0',
                    'editPoint' =>  isset($_POST['editPoint']) != '' ? trim($_POST['editPoint'] ): '0',
                    'deletePoint' =>  isset($_POST['deletePoint']) != '' ? trim($_POST['deletePoint'] ): '0',

                    'addReport' =>  isset($_POST['addReport']) != '' ? trim($_POST['addReport'] ): '0',
                    'editReport' =>  isset($_POST['editReport']) != '' ? trim($_POST['editReport'] ): '0',
                    'deleteReport' =>  isset($_POST['deleteReport']) != '' ? trim($_POST['deleteReport'] ): '0',

                    'addCar' =>  isset($_POST['addCar']) != '' ? trim($_POST['addCar'] ): '0',
                    'editCar' =>  isset($_POST['editCar']) != '' ? trim($_POST['editCar'] ): '0',
                    'deleteCar' =>  isset($_POST['deleteCar']) != '' ? trim($_POST['deleteCar'] ): '0'
                ];

                // Validate userName
                if (empty($data['userName'])) {
                    $Post_error = "10";
                    echo json_encode(array($Post_error));
                    die();
                } else if (preg_match("/[^a-zA-Z0-9]+/", $data['userName'])) {
                    $Post_error = "11";
                    echo json_encode(array($Post_error));
                    die();
                } else {
                    // Check userName
                    if ($this->userModel->findUserByUserName($data['userName'])) {
                        $Post_error = "12";
                        echo json_encode(array($Post_error));
                        die();
                    }
                }

                if (empty($data['name'])) {
                    $Post_error = "20";
                    echo json_encode(array($Post_error));
                    die();
                }


                // Validate password
                if (empty($data['password'])) {
                    $Post_error = "30";
                    echo json_encode(array($Post_error));
                    die();

                } elseif (strlen($data['password']) < 8) {
                    $Post_error = "31";
                    echo json_encode(array($Post_error));
                    die();
                }

                // Validate confirm password
                if (empty($data['confirm_password'])) {
                    $Post_error = "40";
                    echo json_encode(array($Post_error));
                    die();
                } else {
                    if ($data['password'] != $data['confirm_password']) {
                        $Post_error = "41";
                        echo json_encode(array($Post_error));
                        die();
                    }
                }

                // Make sure errors are empty
                // SUCCESS - Proceed to insert

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //Execute
                if ($this->userModel->add($data)) {

                } else {
                    die();
                }

                $Post_error = "200";
                echo json_encode(array($Post_error));
                die();

            } else {
                // IF NOT A POST REQUEST
                $points = $this->pointModel->getJsonPoints(-1);
                $data = [
                    'points' => $points
                ];

                $this->publicFunc->styling("user-nav");
                // Load View
                $this->view('users/add', $data);
            }
        } else {
            redirect('users');
        }
        // Check if POST

    }

    public function login()
    {

        // Check if logged in
//        if ($this->isLoggedIn()) {
//            redirect('Science');
//        }
        if ($this->isLoggedIn()) {
            redirect('info/add');
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
                echo json_encode(Array($Post_error));
                die();
            }

            // Check for name
            if (empty($data['password'])) {
                $Post_error = "11";
                echo json_encode(Array($Post_error));
                die();
            }

            // Check for user
            if ($this->userModel->findUserByUserName($data['userName'])) {
                // User Found

            } else {
                // No User
                $Post_error = "12";
                echo json_encode(Array($Post_error));
                die();
            }

            // Check and set logged in user
            $loggedInUser = $this->userModel->login($data['userName'], $data['password']);

            if ($loggedInUser) {
                // User Authenticated!
                $this->createUserSession($loggedInUser);

            } else {
                $Post_error = "12";
                echo json_encode(Array($Post_error));
                die();
            }
        } else {

            $data = [
                'userName' => '',
                'password' => ''
            ];
            //Load View
            $this->view('users/login', $data);
        }
    }

    // Create Session With User Info
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->userId;
        $_SESSION['user_name'] = $user->userName;
        $_SESSION['Uname'] = $user->name;
        $_SESSION['center_name'] = "جامعة الكفيل";
        $_SESSION['cPhone'] = "0";
        $_SESSION['uCenterId'] = "0";

        $_SESSION['UImg'] = $user->UImg;

//        if ($user->uImgD == 0) {
//            $_SESSION['uImgD'] = $user->img;
//        }

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


//                $loggedInUser = $this->userModel->login($data['userName'], $data['prePassword']);

                // Check for user
                if ($this->userModel->findUserNameToChangePassword($data['userName'])) {
                    // User Found
                    $dataU['password'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                    $dataU['id'] = $data['id'];

                    if ($this->userModel->updatePassword($dataU)) {
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


                if ($this->userModel->changePermission($data)) {
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


                if ($this->userModel->updateUser($data)) {
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