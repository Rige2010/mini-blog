<?php error_reporting(-1);
session_start();

require_once "./app/lib/functions.php";
require_once "./app/class/Database.php";

$db = new Database();
$articles = $db->get_posts();



$title = "Мини Блог";
require_once "./app/default/header.php";
?>

<div class="container">
    <div class="articles__container">

        <div class="notification">
            <?php if (!empty($_SESSION['errors'])) : ?>
                <div class="error-message">
                    <?php
                    echo $_SESSION['errors'];
                    unset($_SESSION['errors']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])) : ?>
                <div class="success-message">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="articles">
            <?php if ($articles) : ?>
                <?php foreach ($articles as $article) : ?>
                    <a class="articles__art-link" href="article.php/?id=<?= $article['id'] ?>">
                        <div class="articles__item">
                            <h3 class="articles__title"><?= htmlspecialchars(cut_content($article['title'], 100)) ?></h3>
                            <hr>
                            <p class="articles__content"><?= nl2br(htmlspecialchars(cut_content($article['content'], 150))) ?></p>
                            <div class="articles__date"><?= $article['created_at'] ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <div>Здесь пока что ничего нет =)</div>
            <?php endif; ?>
        </div>

    </div>
</div>
<!-- <script>alert("Hello")</script> -->

<?php
require_once "./app/default/footer.php";
