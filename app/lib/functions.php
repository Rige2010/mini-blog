<?php error_reporting(-1);

function debug($data)
{
    return "<pre>" . print_r($data, 1) . "</pre>";
}

function cut_content($text, $cut_length)
{
    if (mb_strlen($text) > $cut_length) {
        return mb_substr($text, 0, $cut_length) . ' ...';
    } else {
        return $text;
    }
}

function check_article($post_title, $post_content)
{
    $title = trim($post_title);
    $content = trim($post_content);
    if (empty($title) || empty($content)) {
        $_SESSION['errors'] = "Поля должны быть заполнены";
        return false;
    } else {
        if (mb_strlen($title) > 255) {
            $_SESSION['errors'] = "Максимальная длина поля заголовка 255 символов";
            return false;
        }
        if (mb_strlen($content) > 65000) {
            $_SESSION['errors'] = "Максимальная длина поля текста 65000 символов";
            return false;
        }
    }
    return true;
}
