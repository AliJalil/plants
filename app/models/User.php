<?php

class User
{
    private $db;

    public $tempImgName = "";
    public $imgName = "uploads/placeHolder.png";


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPlants()
    {
        $query = "SELECT *,Plants.isActive as 'uIsActive' FROM Plants";
        $this->db->query($query);
        $results = $this->db->resultset();
        return $results;
    }

    public function getJsonPlants()
    {
        $query = "SELECT userId,name,userName,phoneNo,img,isActive,createdAt,centerName FROM Plants INNER JOIN faculties  ON Plants.centerId = faculties.fId";
        $this->db->query($query);
        $results = $this->db->resultset();
        return $results;
    }

    public function getMaxId()
    {
        $this->db->query("SELECT MAX(userId) AS max_id  FROM Plants");
        $row = $this->db->single();
        return $row->max_id;
    }

    public function addUser($data)
    {
        $path_parts = pathinfo($this->imgName);
        $ext = $path_parts['extension'];
        $newName = "";

        if ($this->tempImgName != "") {
            $newName = basename(rand() . "_" . time() . "." . $ext);
        } else {
            $newName = URLROOT . "/images/statics/noimageicon.png";
        }


        $this->db->query('INSERT INTO
`stafftb`( `name`, `ename`, `title`,`cert`, `uniar`, `unien`, `colg`,email,email1,phoneNo,phoneNo1,orcid,scopus,gScholar,rGate,publons,linkedIn,researchInAr,researchInEn,researches,pExperience,file)
 VALUES (:name, :ename, :title,:cert,:uniar,:unien,:colg,:email,:email1,:phoneNo,:phoneNo1,:orcid,:scopus,:gScholar,:rGate,:publons,:linkedIn,:researchInAr,:researchInEn,:researches,:pExperience,:file)');

        // Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':ename', $data['ename']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':cert', $data['cert']);
        $this->db->bind(':uniar', $data['uniar']);
        $this->db->bind(':unien', $data['unien']);
        $this->db->bind(':colg', $data['colg']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':email1', $data['email1']);
        $this->db->bind(':phoneNo', $data['phoneNo']);
        $this->db->bind(':phoneNo1', $data['phoneNo1']);
        $this->db->bind(':orcid', $data['orcid']);
        $this->db->bind(':scopus', $data['scopus']);
        $this->db->bind(':gScholar', $data['gScholar']);
        $this->db->bind(':rGate', $data['rGate']);
        $this->db->bind(':publons', $data['publons']);
        $this->db->bind(':linkedIn', $data['linkedIn']);
        $this->db->bind(':researchInAr', $data['researchInAr']);
        $this->db->bind(':researchInEn', $data['researchInEn']);
        $this->db->bind(':researches', $data['researches']);
        $this->db->bind(':pExperience', $data['pExperience']);
        $this->db->bind(':file', $newName);


        //Execute
        if ($this->db->execute()) {

            $upOne = realpath(dirname(__FILE__) . '/../..');
            $target = $upOne . "/public/images/";
            $finalPathName = $target . $newName;

            // Writes the photo to the server
            if ($this->tempImgName != "") {
                if (move_uploaded_file($this->tempImgName, $finalPathName)) {

                    // Tells you if its all ok
                    // echo "The file " . basename($this->imgName) . " has been uploaded, and your information has been added to the directory";
                } else {
                    // Gives and error if its not
                    //  echo "Sorry, there was a problem uploading your file.";
                }
            }

            return true;
        } else {
            return false;
        }
    }


    // Add User / Register
    public function register($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO Plants (name, userName,password)
      VALUES (:name, :userName, :password)');

        // Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':userName', $data['userName']);
        $this->db->bind(':password', $data['password']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findUserNameToChangePassword($userName)
    {
        $this->db->query("SELECT * FROM Plants
                                 WHERE (Plants.userName LIKE :userName)");

        $this->db->bind(':userName', $userName);

        $row = $this->db->single();

        //Check Rows
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Find USer BY userName
    public function findUserByUserName($userName)
    {
        $this->db->query("SELECT * FROM Plants
                                WHERE (Plants.userName LIKE :userName)
                                 and (Plants.isActive = 1)
                                 and (Plants.isDeleted = 0)");

        $this->db->bind(':userName', $userName);

        $row = $this->db->single();

        //Check Rows
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Login / Authenticate User
    public function login($userName, $password)
    {

        $this->db->query("SELECT *, Plants.uImgDeleted as 'uImgD',Plants.img as 'UImg'
                                 FROM Plants
                                 WHERE (Plants.userName LIKE :userName)
                                 and (Plants.isActive = 1)
                                 and (Plants.isDeleted = 0)");
        $this->db->bind(':userName', $userName);

        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Find User By ID
    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM Plants WHERE id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function updatePassword($data)
    {

        $q = "Update `Plants` set password = :password  WHERE userId= :id ";

        // Prepare Query
        $this->db->query($q);

        // Bind Values
        $this->db->bind(':password', $data["password"]);
        $this->db->bind(':id', $data["id"]);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($data)
    {

        $q = "Update `Plants` set " . $data["name"] . " = ?  WHERE userId= ? ";

        // Prepare Query
        $this->db->query($q);

        // Bind Values
        $this->db->bind(1, $data["value"], PDO::PARAM_STR);
        $this->db->bind(2, $data["pk"], PDO::PARAM_STR);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changePermission($data)
    {

        $q = "Update permssions set 
addUser = :addUser,
editUser = :editUser,
deleteUser = :deleteUser,

addCenter = :addCenter ,
editCenter = :editCenter,
deleteCenter = :deleteCenter,

addVolu = :addVolu ,
editVolu = :editLost,
deleteVolu = :deleteLost
WHERE user_id = :user_Id";


        // Prepare Query
        $this->db->query($q);

        // Bind Values
        $this->db->bind(':addUser', $data["addUser"]);
        $this->db->bind(':editUser', $data["editUser"]);
        $this->db->bind(':deleteUser', $data["deleteUser"]);

        $this->db->bind(':addCenter', $data["addCenter"]);
        $this->db->bind(':editCenter', $data["editCenter"]);
        $this->db->bind(':deleteCenter', $data["deleteCenter"]);

        $this->db->bind(':addVolu', $data["addVolu"]);
        $this->db->bind(':editLost', $data["editLost"]);
        $this->db->bind(':deleteLost', $data["deleteLost"]);

        $this->db->bind(':user_Id', $data["user_Id"]);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function setImgName($_tempImgName, $_imgName)
    {
        $this->tempImgName = $_tempImgName;
        $this->imgName = $_imgName;
    }

    public function replaceImg($data)
    {
        $path_parts = pathinfo($this->imgName);
        $ext = $path_parts['extension'];


        $newName = "";

        if ($this->tempImgName != "") {
            $newName = basename(rand() . "_" . time() . "." . $ext);
        } else {
            $newName = URLROOT . "/images/statics/placeHolder.png";
        }

        $q = "Update `Plants` set  img = :img,uImgDeleted=0  WHERE userId= :id ";
        $this->db->query($q);

// Bind Values
        $this->db->bind(':img', $newName);
        $this->db->bind(':id', $data['id']);


        // Writes the photo to the server
        if ($this->tempImgName != "") {

            $upOne = realpath(dirname(__FILE__) . '/../..');
            $target = $upOne . "/public/images/Plants/";
            $finalPathName = $target . $newName;

            $files = glob($target . '/' . $data['id'] . '*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    @unlink($file); // delete file
            }

            if (move_uploaded_file($this->tempImgName, $finalPathName)) {
                if ($this->db->execute()) {
                    //  echo "The file " . basename($this->imgName) . " has been uploaded, and your information has been added to the directory";
                    return true;
                } else {
                    return false;
                }
                // Tells you if its all ok
            } else {
                // Gives and error if its not
                //  echo "Sorry, there was a problem uploading your file.";
                return false;
            }
        }

    }
}