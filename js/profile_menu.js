// JavaScript для управления всплывающим меню
function toggleMenu() {
    let userMenu = document.getElementById("userMenu");
    userMenu.style.display = userMenu.style.display === "none" ? "block" : "none";
}

// Дополнительная функция для скрытия меню при уходе курсора
function hideMenu() {
    let userMenu = document.getElementById("userMenu");
    userMenu.style.display = "none";
}

// Скрипт для проверки сессии и изменения состояния иконки пользователя
function checkSessionAndToggleIcon() {
    fetch('/first/php/check_session.php')
        .then(response => response.json())
        .then(data => {
            let userIcon = document.getElementById("userIcon");
            let profileBtn = document.getElementById("profileBtn");
            let logoutBtn = document.getElementById("logoutBtn");
            let loginBtn = document.getElementById("loginBtn");
            let registerBtn = document.getElementById("registerBtn");

            if (data.sessionActive) {
                userIcon.src = "/first/images/user_icon_active.svg";
                profileBtn.style.display = "block";
                logoutBtn.style.display = "block";
                loginBtn.style.display = "none";
                registerBtn.style.display = "none";
            } else {
                userIcon.src = "/first/images/user_icon_inactive.svg";
                profileBtn.style.display = "none";
                logoutBtn.style.display = "none";
                loginBtn.style.display = "block";
                registerBtn.style.display = "block";
            }
        })
        .catch(error => console.error('Error:', error));
}

// Вызываем функцию при загрузке страницы
window.onload = checkSessionAndToggleIcon;

// Закрываем меню при клике вне его области
