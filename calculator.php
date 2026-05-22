<?php
// Проверяем, были ли отправлены данные методом POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Если зашли напрямую - перенаправляем на форму
    header('Location: calculator.html');
    exit;
}

// Функция для проверки, является ли значение числом
function isNumber($value) {
    return is_numeric($value);
}

// Получаем данные из формы
$num1 = isset($_POST['num1']) ? $_POST['num1'] : '';
$num2 = isset($_POST['num2']) ? $_POST['num2'] : '';
$operation = isset($_POST['operation']) ? $_POST['operation'] : '';

$result = null;
$error = null;
$expression = '';

// Проверка на пустые поля
if ($num1 === '' || $num2 === '' || $operation === '') {
    $error = 'Ошибка: Все поля должны быть заполнены!';
} 
// Проверка, что введены числа
elseif (!isNumber($num1) || !isNumber($num2)) {
    $error = 'Ошибка: Пожалуйста, введите корректные числа!';
}
else {
    // Преобразуем в числа с учетом плавающей точки
    $num1 = $num1 + 0;  // Приводим к числовому типу
    $num2 = $num2 + 0;
    
    // Выполняем выбранную операцию
    switch ($operation) {
        case '+':
            $result = $num1 + $num2;
            $expression = "$num1 + $num2";
            break;
            
        case '-':
            $result = $num1 - $num2;
            $expression = "$num1 - $num2";
            break;
            
        case '*':
            $result = $num1 * $num2;
            $expression = "$num1 × $num2";
            break;
            
        case '/':
            // Обработка деления на ноль
            if ($num2 == 0) {
                $error = 'Ошибка: Деление на ноль невозможно!';
            } else {
                $result = $num1 / $num2;
                $expression = "$num1 ÷ $num2";
            }
            break;
            
        case '%':
            // Остаток от деления (только для целых чисел)
            $result = $num1 % $num2;
            $expression = "$num1 % $num2 (остаток от деления)";
            break;
            
        case '^':
            // Возведение в степень с использованием функции pow()
            $result = pow($num1, $num2);
            $expression = "$num1 ^ $num2";
            break;
            
        default:
            $error = 'Ошибка: Неподдерживаемая операция!';
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат калькулятора</title>
    <link rel="stylesheet" href="calculator.css">
</head>
<body>
    <div class="result-container">
        <h1>📊 Результат вычислений</h1>
        
        <?php if ($error !== null): ?>
            <!-- Вывод ошибки -->
            <div class="error-message">
                <strong>⚠️ <?php echo htmlspecialchars($error); ?></strong>
            </div>
        <?php else: ?>
            <!-- Вывод результата -->
            <div class="result-box">
                <div class="result-expression">
                    <?php echo htmlspecialchars($expression); ?> =
                </div>
                <div class="result-value">
                    <?php 
                    // Форматируем результат: убираем .00 если число целое
                    if (is_float($result) && $result == (int)$result) {
                        echo (int)$result;
                    } else {
                        echo htmlspecialchars($result);
                    }
                    ?>
                </div>
            </div>
            <div class="result-info">
                ✅ Операция успешно выполнена
            </div>
        <?php endif; ?>
        
        <a href="calculator.html" class="back-link">🔙 Вернуться к калькулятору</a>
    </div>
</body>
</html>