<?php

class Plant
{
    private $db;
    public $tempImgName = [];
    public $imgName = [];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPlants()
    {
        $query = "SELECT *,planttb.isActive as 'pIsActive' FROM planttb";
        $this->db->query($query);
        $results = $this->db->resultset();
        return $results;
    }

    public function getJsonPlants()
    {
        $query = "SELECT pId,name,det,mainImg,mainImg,type,url,isActive,createdAt,createdBy FROM planttb";
        $this->db->query($query);
        $results = $this->db->resultset();
        return $results;
    }

    public function getMaxId()
    {
        $this->db->query("SELECT MAX(pId) AS max_id  FROM planttb");
        $row = $this->db->single();
        return $row->max_id;
    }

    public function addPlant($data)
    {
        $newNames = [];

        foreach ($this->imgName as $img) {
            $path_parts = pathinfo($img);
            $ext = $path_parts['extension'];
            $newNames[] = basename(rand() . "_" . time() . "." . $ext);
        }
//
//        $path_parts = pathinfo($this->imgName[0]);
//        $ext = $path_parts['extension'];
//        $newName = "";
//
//        if ($this->tempImgName != "") {
//            $newName = basename(rand() . "_" . time() . "." . $ext);
//        } else {
//            $newName = URLROOT . "/images/statics/noimageicon.png";
//        }


        $this->db->query('INSERT INTO
              `planttb`( `name`,eName, `det`, `mainImg`,imgs,`type`)
               VALUES (:name, :eName, :det,:mainImg,:imgs,:type)');

        // Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':eName', $data['ename']);
        $this->db->bind(':det', $data['det']);
        $this->db->bind(':imgs', json_encode(array_slice($newNames, 1, count($newNames))));
        $this->db->bind(':mainImg', $newNames[0]);
        $this->db->bind(':type', $data['type']);


        $x = 0;
        //Execute
        if ($this->db->execute()) {

            $upOne = realpath(dirname(__FILE__) . '/../..');
            $target = $upOne . "/public/images/";
            for ($i = 0; $i <= count($this->tempImgName); $i++) {

                $finalPathName = $target . $newNames[$i];

                // Writes the photo to the server
                if ($this->tempImgName != "") {
                    if (move_uploaded_file($this->tempImgName[$i], $finalPathName)) {
//                        return true;
                        return ($x == count($this->tempImgName) ? true : false);


                        // Tells you if its all ok
                        // echo "The file " . basename($this->imgName) . " has been uploaded, and your information has been added to the directory";
                    } else {
//                        return false;
                        // Gives and error if its not
                        //  echo "Sorry, there was a problem uploading your file.";
                    }
                }
                return true;
            }
        } else {
            return false;
        }

    }


    // Add User / Register
    public function register($data)
    {
        // Prepare Query
        $this->db->query('INSERT INTO planttb (name, userName,password)
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


    // Find User By ID
    public function getPlantById($id)
    {
        $this->db->query("SELECT * FROM planttb WHERE pId = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }


    public function updatePlant($data)
    {

        $q = "Update `planttb` set " . $data["name"] . " = ?  WHERE pId= ? ";

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

    function setImgName($_tempImgName, $_imgName)
    {
        $this->tempImgName = $_tempImgName;
        $this->imgName = $_imgName;
    }

    public function replaceImg($data)
    {
        $path_parts = pathinfo($this->imgName[0]);
        $ext = $path_parts['extension'];


        $newName = "";

        if ($this->tempImgName != "") {
            $newName = basename(rand() . "_" . time() . "." . $ext);
        } else {
            $newName = URLROOT . "/images/statics/placeHolder.png";
        }

        $q = "Update `planttb` set  mainImg = :img,uImgDeleted=0  WHERE pId= :id ";
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