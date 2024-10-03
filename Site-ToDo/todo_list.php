<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список дел</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="js/script.js" defer></script>
</head>

<body>

    <div class="container">
        <header>
            <h1>Список дел</h1>
            <div class="controls">
                <input type="text" id="search-task" class="text" placeholder="Поиск задачи">
                <select id="filter-task">
                    <option value="all">Все</option>
                    <option value="completed">Выполненные</option>
                    <option value="incomplete">Невыполненные</option>
                </select>
                <button id="theme-toggle">
                    <img id="theme-icon" src="images/moon.png" alt="Тёмная тема">
                </button>
            </div>


            <a href="sign/logout.php" class="logout">Выйти</a>
        </header>

        <div class="task-form">
            <button class="add-task-btn" onclick="openModal()">
                <img src="images/Vector.png" alt="Добавить задачу">
            </button>

            <div class="task-list">
            </div>

        </div>
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h2>Добавить задачу</h2>
            <div class="text-div">
                <input type="text" id="note-title" placeholder="Заголовок задачи">
                <textarea id="note-input" placeholder="Описание задачи"></textarea>
                <div class="modal-actions">
                    <button id="cancel-btn" class="modal-btn cancel">Закрыть</button>
                    <button id="apply-btn" class="modal-btn apply">Добавить</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>