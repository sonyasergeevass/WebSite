<?php

    $db = @mysqli_connect('localhost', 'root', '', 'mysitebase') or die('Ошибка соединения с БД');
    mysqli_set_charset($db, "utf8mb4") or die('Не установлена кодировка');
?> 