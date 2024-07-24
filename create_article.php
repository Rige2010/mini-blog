<?php error_reporting(-1);
session_start();

require_once "./app/lib/functions.php";
require_once "./app/class/Database.php";
$db = new Database();

if (isset($_POST['title']) && isset($_POST['content'])) {
    if (!check_article($_POST['title'], $_POST['content'])) {
        header("Location: create_article.php");
        exit;
    } else {
        $db->add_post($_POST['title'], $_POST['content']);
        $_SESSION['success'] = "Пост успешно опубликован";
        header("Location: index.php");
        exit;
    }
}



$title = "Написать пост";
require_once "./app/default/header.php";
?>

<div class="container">
    <div class="create__container">

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

        <form class="create__form" method="post">
            <label for="title">Заголовок поста</label>
            <input type="text" name="title" id="title">
            <label for="content">Текст поста</label>
            <textarea name="content" id="content"></textarea>
            <button type="submit">Опубликовать</button>
        </form>

    </div>
</div>

<?php
require_once "./app/default/footer.php";
?>