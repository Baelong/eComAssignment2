<?php
namespace app\controllers;

// Applying the Login condition to the whole class
#[\app\filters\Login]
class Profile extends \app\core\Controller{

    #[\app\filters\HasProfile]
    public function index(){
    // Get the user ID from the session
    $user_id = $_SESSION['user_id']; // Assuming you store the user ID in the session
    
    // Fetch profile for the current user
    $profileModel = new \app\models\Profile();
    $profile = $profileModel->getForUser($user_id);

    // Check if profile is fetched successfully
    if (!$profile) {
        // Handle case where profile is not found
        // For example, redirect to profile creation page
        header('Location: /Profile/create');
        exit;
    }

    // Fetch publications for the current profile
    $publicationModel = new \app\models\Publication();
    $publications = $publicationModel->getForUser($profile->profile_id);

    // Pass profile and publications data to the view
    $this->view('Profile/index', compact('profile', 'publications'));
}
    

/*
public function create(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){//data is submitted through method POST
        // Make a new profile object
        $profile = new \app\models\Profile();
        // Populate it
        $profile->user_id = $_SESSION['user_id'];
        $profile->first_name = $_POST['first_name'];
        $profile->middle_name = $_POST['middle_name'];
        $profile->last_name = $_POST['last_name'];
        // Insert it
        $profile->insert();

        // Set the profile_id in the session to the ID of the newly created profile
        $_SESSION["profile_id"] = $profile->profile_id;

        // Redirect
        header('location:/Profile/index');
    } else {
        $this->view('Profile/create');
    }
}

*/
public function create(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){//data is submitted through method POST
        // Make a new profile object
        $profile = new \app\models\Profile();
        // Populate it
        $profile->user_id = $_SESSION['user_id'];
        $profile->first_name = $_POST['first_name'];
        $profile->middle_name = $_POST['middle_name'];
        $profile->last_name = $_POST['last_name'];
        // Insert it
        $profile->insert();

        // Set the profile_id in the session to the ID of the newly created profile
        $_SESSION["profile_id"] = $profile->profile_id;
/*
        // Debugging: Output session variables to console
        echo "<script>console.log('Session variables after profile creation:', " . json_encode($_SESSION) . ");</script>";
        header('Refresh: 10; url=/Profile/index');
        */
          header('Location: /Profile/index');
        exit;
    } else {
        $this->view('Profile/create');
    }
}

    public function modify(){
        $profile = new \app\models\Profile();
        $profile = $profile->getForUser($_SESSION['user_id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){//data is submitted through method POST
            // Populate the profile object with updated data
            $profile->first_name = $_POST['first_name'];
            $profile->middle_name = $_POST['middle_name'];
            $profile->last_name = $_POST['last_name'];
            // Update the profile
            $profile->update();
            // Redirect
            header('location:/Profile/index');
        }else{
            $this->view('Profile/modify', $profile);
        }
    }

    public function delete(){
        $profile = new \app\models\Profile();
        $profile = $profile->getForUser($_SESSION['user_id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $profile->delete();
            header('location:/Profile/index');
        }else{
            $this->view('Profile/delete',$profile);
        }
    }


}
