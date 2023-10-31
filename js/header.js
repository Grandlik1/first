const userIcon = document.querySelector('.user-icon');
const userMenu = userIcon.querySelector('.user-menu');
const profileButton = userMenu.querySelector('#profile-button');
const logoutButton = userMenu.querySelector('#logout-button');

// Отображение/скрытие меню при клике на иконку пользователя
userIcon.addEventListener('click', () => {
    userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
});

// Обработчик для кнопки "Профиль пользователя"
profileButton.addEventListener('click', () => {
    window.location.href = 'profile.html';
});

// Обработчик для кнопки "Выход"
logoutButton.addEventListener('click', () => {
    window.location.href = 'logout.php';
});