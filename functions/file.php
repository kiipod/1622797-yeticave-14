<?php

/**
 * Функция осуществляет добавление в папку uploads картинки
 * @param array $files Передает картинку из формы
 * @return string|null Возвращает новое название картинки и ее местоположение
 */
function upload_image(array $files): ?string
{
    $tmp_name = $files['img']['tmp_name'];
    $file_type = mime_content_type($tmp_name);

    if ($file_type === 'image/jpeg') {
        $filename = uniqid() . '.jpeg';
    } else {
        $filename = uniqid() . '.png';
    }

    if (!move_uploaded_file($tmp_name, 'uploads/' . $filename)) {
        exit('Нужны права на запись в папку uploads');
    }

    return 'uploads/' . $filename;
}
