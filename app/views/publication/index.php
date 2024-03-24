<html>
<head>
    <title><?= $name ?> view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class='container'>
        <h1>User Publications</h1>
        <br><a href='/Profile/index'>Go to my profile</a>
        
        <?php foreach ($data as $publication): ?>
            <dl>
                <dt>Title:</dt>
                <dd><?= $publication->publication_title ?></dd>
                <dt>Content:</dt>
                <dd><?= $publication->publication_text ?></dd>
            </dl>
            
            
             <div>
                <h3>Comments</h3>
                <?php foreach ($publication->comments as $comment): ?>
                    <div>
                        <p><?= $comment->comment_text ?></p>
                        <small>Posted by <?= $comment->profile_id ?> on <?= $comment->timestamp ?></small>
                    </div>
                <?php endforeach; ?>
                <form method="post" action="/Comment/add">    
                    <input type="hidden" name="publication_id" value="<?= $publication->publication_id ?>">
                    <textarea name="comment_text" placeholder="Enter your comment" required></textarea>
                    <button type="submit">Add Comment</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
