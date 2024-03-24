<?php
namespace app\models;

class Comment extends \app\core\Model
{
    public $comment_id;
    public $profile_id;
    public $publication_id;
    public $comment_text;
    public $timestamp;

    public function insert()
    {
        $SQL = 'INSERT INTO publication_comment(profile_id, publication_id, comment_text) 
                VALUES (:profile_id, :publication_id, :comment_text)';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'profile_id' => $this->profile_id,
            'publication_id' => $this->publication_id,
            'comment_text' => $this->comment_text
        ]);
    }

    public function update()
    {
        $SQL = 'UPDATE publication_comment SET comment_text=:comment_text WHERE comment_id=:comment_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute([
            'comment_id' => $this->comment_id,
            'comment_text' => $this->comment_text
        ]);
    }

    public function delete()
    {
        $SQL = 'DELETE FROM publication_comment WHERE comment_id=:comment_id';
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['comment_id' => $this->comment_id]);
    }

    public static function getById($comment_id)
    {
        $SQL = "SELECT * FROM publication_comment WHERE comment_id = :comment_id";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['comment_id' => $comment_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Comment');
        return $STMT->fetch();
    }

    public static function getByProfileId($profile_id)
    {
        $SQL = "SELECT * FROM publication_comment WHERE profile_id = :profile_id";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['profile_id' => $profile_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Comment');
        return $STMT->fetchAll();
    }

    public static function getByPublicationId($publication_id)
    {
        $SQL = "SELECT * FROM publication_comment WHERE publication_id = :publication_id";
        $STMT = self::$_conn->prepare($SQL);
        $STMT->execute(['publication_id' => $publication_id]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, 'app\models\Comment');
        return $STMT->fetchAll();
    }
}

