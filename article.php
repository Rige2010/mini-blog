<?php error_reporting(-1);
session_start();

require_once "./app/class/Database.php";
$db = new Database();
$article;
$id = '';

$warning_message = 'Такого поста нет';

if (isset($_GET['id'])) {
    if ($article = $db->get_post($_GET['id'])) {
        $id = $_GET['id'];
    }
}



$title = $article['title'] ? $article['title'] : $warning_message;
require_once "./app/default/header.php";

if (!empty($id)) :
?>
    <div>
        <div class="container article-page">
            <div class="articles__item">
                <h3 class="articles__title"><?= htmlspecialchars($article['title']) ?></h3>
                <hr>
                <p class="articles__content"><?= nl2br(htmlspecialchars($article['content'])) ?></p>
                <div class="articles__date"><?= $article['created_at'] ?></div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="articles__item">
        <h3 class="articles__title articles__warning"><?= $warning_message ?></h3>
    </div>

<?php
endif;
require_once "./app/default/footer.php";
?>