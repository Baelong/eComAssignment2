<?php
namespace app\controllers;

use app\models\Comment;

class CommentController extends \app\core\Controller
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = new Comment();
            $comment->profile_id = $_SESSION['profile_id'];
            $comment->publication_id = $_POST['publication_id'];
            $comment->comment_text = $_POST['comment_text'];
            //Insert the comment into the database
            $comment->insert();

            header('location: /Publication/index');
            exit;
        }
    }

    public function edit($comment_id)
    {
        //Get the comment by its ID
        $comment = Comment::getById($comment_id);
        //Check if the comment belongs to the current user's profile
        if ($comment && $comment->profile_id == $_SESSION['profile_id']) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $comment->comment_text = $_POST['comment_text'];
                $comment->update();
               
                header('location: /Profile/index');
                exit;
            } else {
                $this->view('Comment/edit', ['comment' => $comment]);
            }
        }
    }

    public function delete($comment_id)
    {
        $comment = Comment::getById($comment_id);
        //Check if comment has the current user's profile_id
        if ($comment && $comment->profile_id == $_SESSION['profile_id']) {
            $comment->delete();

            header('location: /Profile/index');
            exit;
        } 
    }
}
