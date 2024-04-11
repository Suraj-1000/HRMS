<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .parent {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        #Input {
            width: 80%;
            padding: 8px;
            margin-bottom: 8px;
            border: 1px solid;
            border-radius: 5px;
        }

        #add {
            padding: 8px 15px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-button {
            padding: 5px 10px;
            border: 1px solid;
            border-radius: 5px;
            color: Red;
            cursor: pointer;
            
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

    </style>
</head>
<body>
    <div class="parent">
        <h1>To-Do-List</h1>
        <input type="text" id="Input" placeholder="Enter....">
        <button id="add">Add</button>
        <ul id="List"></ul>
    </div>

    

    <script>
         const taskInput = document.getElementById("Input");
        const addTaskBtn = document.getElementById("add");
        const taskList = document.getElementById("List");
        const tasks = JSON.parse(localStorage.getItem("tasks")) || [];

        function renderTasks() {
            taskList.innerHTML = tasks.map((task, index) => `
                <li>
                    <input type="checkbox" class="checkbox" data-index="${index}" ${task.completed ? "checked" : ""}>
                    <span class="task ${task.completed ? "completed" : ""}">${task.name}</span>
                    <span class="delete-button" data-index="${index}">Delete</span>
                </li>
            `).join("");
        }

        function saveTasks() {
            localStorage.setItem("tasks", JSON.stringify(tasks));
            renderTasks();
        }

        addTaskBtn.addEventListener("click", () => {
            const taskName = taskInput.value.trim();
            if (taskName !== "") {
                tasks.push({ name: taskName, completed: false });
                taskInput.value = "";
                saveTasks();
            }
        });

        taskList.addEventListener("change", (e) => {
            if (e.target.classList.contains("checkbox")) {
                const index = e.target.dataset.index;
                tasks[index].completed = e.target.checked;
                saveTasks();
            }
        });

        taskList.addEventListener("click", (e) => {
            if (e.target.classList.contains("delete-button")) {
                const index = e.target.dataset.index;
                tasks.splice(index, 1);
                saveTasks();
            }
        });

        renderTasks();
    </script>
</body>
</html>
