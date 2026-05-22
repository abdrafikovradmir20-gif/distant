<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карточки пользователей</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>👥 Наши пользователи</h1>
        
        <div class="cards-grid">
            <?php
            // Подключаем файл с массивом пользователей
            include 'users.php';
            
            // Цикл для вывода карточек
            foreach ($users as $user) {
                // Используем конкатенацию строк для сборки HTML
                $card = '<div class="card">';
                $card .= '<div class="card-header">';
                $card .= '<span class="card-name">' . $user["name"] . '</span>';
                $card .= '<span class="card-age">, ' . $user["age"] . ' лет</span>';
                $card .= '</div>';
                
                $card .= '<div class="card-detail">';
                $card .= '<span class="label">📧 Email:</span>';
                $card .= '<span class="value">';
                $card .= '<a href="mailto:' . $user["email"] . '" class="email-link">' . $user["email"] . '</a>';
                $card .= '</span>';
                $card .= '</div>';
                
                $card .= '<div class="card-detail">';
                $card .= '<span class="label">🏙️ Город:</span>';
                $card .= '<span class="value city-value">' . $user["city"] . '</span>';
                $card .= '</div>';
                
                $card .= '</div>';
                
                // Выводим карточку
                echo $card;
            }
            ?>
        </div>
        
        <div class="footer">
            <p>Всего пользователей: 
                <?php 
                    include 'users.php';
                    echo count($users); 
                ?>
            </p>
        </div>
    </div>
</body>
</html>