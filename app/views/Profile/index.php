<!DOCTYPE html>
<html>
<head>
    <title><?= $profile->first_name ?> view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div>
            <h1>User profile</h1>
            <p>Your profile has been created with ID: <?= $_SESSION["profile_id"] ?></p>
            <dl>
                <dt>First name:</dt>
                <dd><?= $profile->first_name ?></dd>
                <dt>Middle name:</dt>
                <dd><?= $profile->middle_name ?></dd>
                <dt>Last name:</dt>
                <dd><?= $profile->last_name ?></dd>
                <dd><a href="/User/logout">Logout</a></dd>
            </dl>
            <a href='/Profile/modify'>Modify my profile</a> 
            <a href='/Profile/delete'>Delete my profile</a>
            <br><a href='/Publication/create'>Create a publication</a> 
            <br><a href='/Publication/index'>Go to publication index page</a> 
        </div>

        <div class='Publications'>
            <h1>My publications</h1>
            <?php if ($publications): ?>
                <?php foreach ($publications as $publication): ?>
                    <p><?= $publication->publication_title ?></p>
                    <a href='/Publication/modify/<?= $publication->publication_id ?>'>Edit</a>
                    <a href='/Publication/delete/<?= $publication->publication_id ?>'>Delete</a>
                    <div class="comments">
                        <h2>Comments</h2>
                        <?php foreach ($publication->comments as $comment): ?>
                            <p><?= $comment->comment_text ?></p>
                            <a href='/Comment/edit/<?= $comment->comment_id ?>'>Edit</a>
                            <a href='/Comment/delete/<?= $comment->comment_id ?>'>Delete</a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                No publications available.
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

