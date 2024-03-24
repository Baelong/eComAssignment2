<?php
namespace app\controllers;


class Publication extends \app\core\Controller
{
    public function index() {
    $publicationModel = new \app\models\Publication();
    $publications = $publicationModel->getPublications();
    $this->view('Publication/index', ['data' => $publications]);
}


  public function create()
{
    $publication = new \app\models\Publication();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Check if profile_ID is in session
        if (isset($_SESSION['profile_id']) && $_SESSION['profile_id'] !== '') {
            $publication->profile_id = $_SESSION['profile_id'];
            $publication->publication_title = $_POST['publication_title'];
            $publication->publication_text = $_POST['publication_text'];
            $publication->publication_status = $_POST['publication_status'];
            
            $publication->insert();
            
            header('Location: /Publication/index');
            exit;
        } 
            
    }
    
    $this->view('Publication/create');
}


public function modify($publication_id)
{
    $publicationModel = new \app\models\Publication();
    //Get the publication data by its ID
    $publication = $publicationModel->get($publication_id);
    $this->view('Publication/modify', ['publication' => $publication]);
}


    public function delete($publication_id)
    {
        $publication = new \app\models\Publication();
        $publication = $publication->getById($publication_id);

        // Check if the publication has the current user's profile_id
        if ($publication && $publication['profile_id'] == $_SESSION['profile_id']) {
            $publication->delete();

            header('location:/Profile/index');
    } 
    }
}

