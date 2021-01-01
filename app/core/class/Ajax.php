<?php
include_once 'kkblog.php';

//csrf protection
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
    die("Sorry bro!");

$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
    die("Sorry bro!");

$action = $_POST['action'];

switch ($action) {
	case 'checkLogin':
		$logged = $login->userLogin($_POST['username'], $_POST['password']);
        if($logged === true)
            echo json_encode(array(
                'status' => 'success',
                'page'   => get_redirect_page()
            ));
		break;
    case "registerUser":
        $register->register($_POST['User']);
        break;
        
    case "resetPassword":
        $register->resetPassword($_POST['newPass'], $_POST['key']);
        break;
        
    case "forgotPassword":
        $result = $register->forgotPassword($_POST['email']);
        if ( $result !== TRUE )
            echo $result;
        break;
        
    case "postComment":
        $Comment = new Comment();
        echo $Comment->insertComment(session::get("user_id"), $_POST['comment']);
        break;
        
    case "updatePassword":
        $user = new User(session::get("user_id"));
        $user->updatePassword($_POST['oldpass'], $_POST['newpass']);
        break;
        
    case "updateDetails":
        $user = new User(session::get("user_id"));
        $user->updateDetails($_POST['details']);
        break;
        
        
    case "deleteUser":
        onlyAdmin();

        $user = new User($_POST['userId']);
        $user->deleteUser();
        break;
    
    case "getUserDetails":
        onlyAdmin();

        $user = new User($_POST['userId']);
        echo json_encode( $user->getAll() );
        break;


    case "addUser":
        onlyAdmin();

        $user = new WIUser(null);
        echo json_encode( $user->add($_POST) );
        break;


      default:
        
        break;
}

//switch($_GET['action']){
        
        //case "getEvents":
        //$calendar = new WICalendar();
        //$calendar->getEvents($_GET['date']) ;
        //break;
        
       // default:
      //  break;
   // }

function onlyAdmin() {
    $login = new Login();
    if ( ! $login->isLoggedIn() ) exit();

    $loggedUser = new User(WISession::get("user_id"));
    if( ! $loggedUser->isAdmin() ) exit();
}