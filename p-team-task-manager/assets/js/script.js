function registerUser() {
    console.log("Clicked");

    let data = new FormData(document.getElementById("registerForm"));

    fetch("/p-team-task-manager/api/auth.php?action=register", {
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);
        alert(data);
    });
}

function loginUser() {
    let data = new FormData(document.getElementById("loginForm"));

    fetch("/p-team-task-manager/api/auth.php?action=login", {   // ✅ FIXED PATH
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then(response => {
        console.log("Server response:", response);

        if (response.trim() === "success") {   // ✅ FIXED CHECK
            window.location.href = "/p-team-task-manager/public/dashboard.php";
        } else {
            alert(response);
        }
    });
}

function createProject() {
    let data = new FormData(document.getElementById("projectForm"));

    fetch("/p-team-task-manager/api/project.php", {
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        location.reload();
    });
}

function createTask() {
    console.log("Add Task clicked");   // ✅ DEBUG

    let form = document.getElementById("taskForm");

    if (!form) {
        alert("Form not found");
        return;
    }

    let data = new FormData(form);

    fetch("/p-team-task-manager/api/task.php", {   // ✅ CORRECT PATH
        method: "POST",
        body: data
    })
    .then(res => res.text())
    .then(response => {
        console.log("Server:", response);
        alert(response);
        location.reload();
    });
}

function updateStatus(taskId, selectElement) {

    let status = selectElement.value;

    fetch("/p-team-task-manager/api/task.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${taskId}&status=${status}`
    })
    .then(res => res.text())
    .then(response => {
        console.log(response);

        if (response.trim() === "updated") {

            // ✅ UI instant update (no reload)
            selectElement.classList.add("border-success");

            setTimeout(() => {
                selectElement.classList.remove("border-success");
            }, 1000);

        } else {
            alert(response);
        }
    })
    .catch(err => console.log(err));
}

