<?php

require_once "config/init.php";

include "view_partials/header.php";

class Page{

    public function __construct(){
        if (array_key_exists('page', $_GET)) {
            switch ($_GET['page']) {
                case 'register':
                    $this->caseRegister();
                    break;
        
                case 'login':
                    $this->caseLogin();
                    break;
        
                case 'logout':
                    $this->caseLogout();
                    break;
                
                case "home":
                   $this->caseHome();
                    break;
                default:
                    $this->caseDefault();
                    break;
            }
        }
    }
    public function caseRegister(){
        if (isset($_SESSION['is_logged_in'])) {
            include "view_partials/forbidden_logout.php";

        } else {
            include "pages/register.php";
        }
    }
    public function caseLogin(){
        if (isset($_SESSION['is_logged_in'])) {
            include "view_partials/forbidden_logout.php";
        } else {
            include "pages/login.php";
        }
    }
    public function caseLogout(){
        session_destroy();
        echo "<script>
            window.location.href = '?page=login&debug_came_from_logout=1';
        </script>";

    }
    public function caseHome(){
        if (!isset($_SESSION['is_logged_in'])) {
            include "view_partials/forbidden_login.php";
            
        } else {
            include "pages/home.php";
        }
    }
    public function caseDefault(){
        if (!isset($_SESSION['is_logged_in'])) {
            echo "<script>
                window.location.href = '?page=login&debug_came_from_logout=1';
            </script>";
            
        } else {
            echo "<script>
                window.location.href = '?page=home&debug_came_from_logout=1';
            </script>";
        }
    }
}

$db = new DB();
$newPage = new Page($db);

include "view_partials/footer.php";