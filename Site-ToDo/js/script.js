document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme) {
        document.body.classList.toggle('dark-theme', currentTheme === 'dark');
        themeIcon.src = currentTheme === 'dark' ? 'images/sun.png' : 'images/moon.png';
        themeIcon.alt = currentTheme === 'dark' ? 'Светлая тема' : 'Тёмная тема';
    }

    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-theme');
        const isDarkTheme = document.body.classList.contains('dark-theme');

        themeIcon.src = isDarkTheme ? 'images/sun.png' : 'images/moon.png';
        themeIcon.alt = isDarkTheme ? 'Светлая тема' : 'Тёмная тема';

        localStorage.setItem('theme', isDarkTheme ? 'dark' : 'light');
    });
});

const modal = document.getElementById('modal');
const addTaskBtn = document.querySelector('.add-task-btn');
const cancelBtn = document.getElementById('cancel-btn');
const applyBtn = document.getElementById('apply-btn');

addTaskBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
});

cancelBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

applyBtn.addEventListener('click', () => {
    const title = document.getElementById('note-title').value;
    const note = document.getElementById('note-input').value;

    if (title && note) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../sign/add_task.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message); 
                    loadTasks();
                } else {
                    alert(response.message); 
                }
            }
        };

        const data = `title=${encodeURIComponent(title)}&note=${encodeURIComponent(note)}`;
        xhr.send(data);

        modal.style.display = 'none';
    } else {
        alert('Заполните оба поля.');
    }
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = 'none';
    }
});

function renderTasks(tasks) {
    const taskList = document.querySelector('.task-list');
    taskList.innerHTML = ''; 

    tasks.forEach(task => {
        const taskItem = document.createElement('div');
        taskItem.classList.add('task-item');
        if (task.completed) {
            taskItem.classList.add('completed');
        }

        taskItem.innerHTML = `
            <input type="checkbox" ${task.completed ? 'checked' : ''} onchange="toggleTask(${task.id})">
            <div class="task-info">
                <span class="task-title">${task.title}</span>
                <span class="task-text">${task.text}</span>
            </div>
            <div class="actions">
                ${task.completed ? '' : `<img src="images/Frame 6.svg" alt="Edit" onclick="editTask(${task.id}, '${task.title}', '${task.text}')">`}
                <img src="images/trash-svgrepo-com 1.svg" alt="Delete" onclick="deleteTask(${task.id})">
            </div>
        `;

        taskList.appendChild(taskItem);
    });
}


function toggleTask(id) {
    const isChecked = document.querySelector(`input[onchange="toggleTask(${id})"]`).checked;

    if (confirm(`Вы уверены, что хотите ${isChecked ? 'завершить' : 'возобновить'} эту задачу?`)) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../sign/update_task.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status !== 200) {
                alert('Ошибка обновления задачи.');
            } else {
                alert('Задача успешно обновлена.');
                loadTasks();
            }
        };

        const data = `id=${id}&completed=${isChecked ? 1 : 0}`;
        xhr.send(data);
    } else {
        document.querySelector(`input[onchange="toggleTask(${id})"]`).checked = !isChecked;
    }
}


function editTask(id, currentTitle, currentText) {
    const newTitle = prompt('Редактировать заголовок задачи', currentTitle);
    const newText = prompt('Редактировать описание задачи', currentText);

    if (newTitle && newText) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../sign/edit_task.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status !== 200) {
                alert('Ошибка редактирования задачи.');
            } else {
                alert('Задача успешно отредактирована.');
                loadTasks(); 
            }
        };

        const data = `id=${id}&title=${encodeURIComponent(newTitle)}&text=${encodeURIComponent(newText)}`;
        xhr.send(data);
    } else {
        alert('Заголовок и описание не могут быть пустыми.');
    }
}

function deleteTask(id) {
    if (confirm('Вы уверены, что хотите удалить задачу?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../sign/delete_task.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status !== 200) {
                alert('Ошибка удаления задачи.');
            } else {
                alert('Задача успешно удалена.'); 
                loadTasks();
            }
        };

        const data = `id=${id}`;
        xhr.send(data);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const searchTaskInput = document.getElementById('search-task');
    const filterTaskSelect = document.getElementById('filter-task');

    searchTaskInput.addEventListener('input', loadTasks);
    filterTaskSelect.addEventListener('change', loadTasks); 
});

function loadTasks() {
    const searchQuery = document.getElementById('search-task').value;
    const filterStatus = document.getElementById('filter-task').value;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `../sign/get_tasks.php?search=${encodeURIComponent(searchQuery)}&filter=${encodeURIComponent(filterStatus)}`, true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const tasks = JSON.parse(xhr.responseText);
            renderTasks(tasks);
        } else {
            alert('Ошибка загрузки задач.');
        }
    };

    xhr.send();
}

document.addEventListener('DOMContentLoaded', loadTasks);
