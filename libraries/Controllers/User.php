<?php

namespace Controllers;

class User extends Controller
{

    // public function insert()
    // {
    //     $userClass = new \Models\User();

    //     $lname = null;
    //     $fname = null;
    //     $email = null;
    //     $pwd = null;
    //     $password = null;
    //     $adress = null;
    //     $city = null;
    //     $zip_code = null;

    //     if (!empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['adress']) && !empty($_POST['city']) && !empty($_POST['zip_code'])) {

    //         $lname = $_POST['lname'];
    //         $fname = $_POST['fname'];
    //         $email = $_POST['email'];
    //         $pwd = $_POST['password'];
    //         $password = password_hash($pwd, PASSWORD_DEFAULT);
    //         $adress = $_POST['adress'];
    //         $city = $_POST['city'];
    //         $zip_code = $_POST['zip_code'];
    //         if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //             $userClass->insertUser($lname, $fname, $email, $password, $adress, $city, $zip_code);

    //             $this->redirect('index.php');
    //         } else {
    //             echo json_encode("L'email : $email, n'est pas un email valide.");
    //         }
    //     } else {
    //         echo json_encode("Vous devez remplir toutes les données.");
    //     }
    // }

    public function insert()
    {
        $userClass = new \Models\User();


        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if ($contentType === "application/json") {

            //Receive the RAW post data.
            $content = trim(file_get_contents("php://input"));


            $decoded = json_decode($content, true);


            //If json_decode failed, the JSON is invalid.

            if (!is_array($decoded)) {
                // Send error back to user.
                echo "there was an error";
            } else {

                header('Content-Type: application/json');

                $fname = $decoded['fname'];
                $lname = $decoded['lname'];
                $email = $decoded['email'];
                $pwd = $decoded['pwd'];
                $adress = $decoded['adress'];
                $city = $decoded['city'];
                $zip_code = $decoded['zip_code'];


                if (!empty($fname) && !empty($lname) && !empty($email) && !empty($pwd) && !empty($adress) && !empty($city) && !empty($zip_code)) {

                    $password = password_hash($pwd, PASSWORD_DEFAULT);
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $userClass->insertUser($lname, $fname, $email, $password, $adress, $city, $zip_code);

                        echo json_encode("success");

                        // $this->redirect('index.php');
                    } else {
                        echo json_encode("L'email : $email, n'est pas un email valide.");
                    }
                } else {
                    echo json_encode("Vous devez remplir toutes les données.");
                }
            }
        }
    }

    public function login()
    {
        $userClass = new \Models\User();

        $email = null;
        $password = null;

        if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $userClass->loginUser($email, $password);

                $this->redirect('index.php');
            } else {
                echo "L'email : $email, n'est pas un email valide.";
            }
        } else {
            echo "Vous devez remplir toutes les données.";
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect('index.php');
    }

    public function getInfo()
    {
        $userClass = new \Models\User();

        $userInfo = $userClass->getInfoUser();

        $pageTitle = "Mon compte";

        $this->render('user/info', compact('pageTitle', 'userInfo'));
    }

    public function showUsers()
    {
        $userClass = new \Models\User();

        $usersInfo = $userClass->getAllUser();

        $pageTitle = "Tous les utilisateurs";

        $this->render('admin/accueil', compact('pageTitle', 'usersInfo'));
    }

    public function deleteUser()
    {
        $userClass = new \Models\User();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $usersInfo = $userClass->delete($id);

        $pageTitle = "Tous les utilisateurs";

        $this->redirect('index.php?controller=user&task=showUsers');
    }

    public function getUser()
    {
        $userClass = new \Models\User();

        if ($_GET['id']) {
            $id = $_GET['id'];
        }

        if (!$id) {
            echo "il y a eu une erreur";
        }

        $userInfo = $userClass->getUser($id);

        $pageTitle = "Modifier l'utilisateur";

        $this->render('admin/editUser', compact('pageTitle', 'userInfo'));
    }

    public function editUser()
    {

        $userClass = new \Models\User();

        $lname = null;
        $fname = null;
        $email = null;
        $adress = null;
        $city = null;
        $zip_code = null;


        $lname = $_POST['edit_lname'];
        $fname = $_POST['edit_fname'];
        $email = $_POST['edit_email'];
        $adress = $_POST['edit_adress'];
        $city = $_POST['edit_city'];
        $zip_code = $_POST['edit_zip_code'];
        $id = $_GET['id'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $userClass->edit($lname, $fname, $email, $adress, $city, $zip_code, $id);

            $this->redirect('index.php?controller=user&task=showUsers');
        } else {
            echo "L'email : $email, n'est pas un email valide.";
        }
    }
    public function editMyUser()
    {

        $userClass = new \Models\User();

        $lname = null;
        $fname = null;
        $email = null;
        $adress = null;
        $city = null;
        $zip_code = null;


        $lname = $_POST['edit_lname'];
        $fname = $_POST['edit_fname'];
        $email = $_POST['edit_email'];
        $adress = $_POST['edit_adress'];
        $city = $_POST['edit_city'];
        $zip_code = $_POST['edit_zip_code'];
        $id = $_GET['id'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $userClass->edit($lname, $fname, $email, $adress, $city, $zip_code, $id);

            $this->redirect('index.php?controller=pret&task=availableIndex');
        } else {
            echo "L'email : $email, n'est pas un email valide.";
        }
    }
}
