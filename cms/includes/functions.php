<?php

if (!defined('included')){
die('You cannot access this file directly!');
}

//log user in ---------------------------------------------------
function login($conn, $user, $pass){
   //strip all tags from varible   
   $user = strip_tags(mysqli_real_escape_string($conn, $user));
   $pass = strip_tags(mysqli_real_escape_string($conn, $pass));

   // check if the user id and password combination exist in database
   $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
   $result = mysqli_query($conn, $sql) or die('Query failed. ' . mysqli_error($conn));
     
     while($row = mysqli_fetch_object($result)){
       $userID = $row->userID;
       $userPrivilege = $row->admin;
     }
   
   $_SESSION['admin'] = $userPrivilege;
   $_SESSION['userID'] = $userID;
      
   if (mysqli_num_rows($result) == 1) {
      // the username and password match,
      // set the session
	  $_SESSION['authorized'] = true;
					  
	  // direct to admin
      header('Location: '.DIRADMIN);
	  exit();
   } else {
	// define an error message
	$_SESSION['error'] = 'Sorry, wrong username or password';
   }
}

function NewUser($conn) { 
  $fullname = $_POST['signupname']; 
  $userName = $_POST['signupusername'];  
  $password = $_POST['signuppassword']; 
  $query = "INSERT INTO users (username,password,realname) VALUES ('$userName','$password','$fullname')"; 
  $data = mysqli_query ($conn, $query)or die(mysqli_error($conn)); 
  if($data) { echo "YOUR REGISTRATION IS COMPLETED..."; 
  } 
}
//checking the 'user' name which is from Sign-Up.html, is it empty or have some text
function SignUp($conn) { if(!empty($_POST['signupusername']))  { 
  $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$_POST[signupusername]' AND password = '$_POST[signuppassword]'") or die(mysqli_error($conn)); 
  if(!$row = mysqli_fetch_array($query) or die(mysqli_error($conn))) 
  { 
    NewUser($conn); 
  } 
  else { echo "SORRY...YOU ARE ALREADY REGISTERED USER..."; 
  } 
} 
}

// Authentication
function logged_in() {
	if($_SESSION['authorized'] == true) {
		return true;
	} else {
		return false;
	}	
}

function login_required() {
	if(logged_in()) {	
		return true;
	} else {
		header('Location: '.DIRADMIN.'login.php');
		exit();
	}	
}

function logout(){
	unset($_SESSION['authorized']);
	header('Location: '.DIRADMIN.'login.php');
	exit();
}

// Render error messages
function messages() {
    $message = '';
    if($_SESSION['success'] != '') {
        $message = '<div class="msg-ok">'.$_SESSION['success'].'</div>';
        $_SESSION['success'] = '';
    }
    if($_SESSION['error'] != '') {
        $message = '<div class="msg-error">'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = '';
    }
    echo "$message";
}

function errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
			$showError.= "<div class=\"msg-error\">".$error[$i]."</div>";
			$i ++;}
			echo $showError;
	}// close if empty errors
} // close function

?>