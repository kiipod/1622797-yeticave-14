<?php
/**
 * @var mysqli $link
 */
require_once __DIR__ . '/init.php';

$categories = get_categories($link);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $login_form = filter_input_array(INPUT_POST, [
        'email' => FILTER_DEFAULT,
        'password' => FILTER_DEFAULT
    ], true);

    $errors = validate_login_form($link, $login_form);
    if (!$errors && authentication($link, $login_form)) {
        header("Location: /index.php");
        exit();
    }
}

$content = include_template('login.php', ['categories' => $categories, 'errors' => $errors]);

$layout_content = include_template('layout.php', [
    'categories' => $categories,
    'content' => $content,
    'title' => 'Вход на сайт'
]);

print($layout_content);
