// Выбираем все кнопки для открытия модального окна
document.addEventListener('DOMContentLoaded', () => {
    const openModalBtns = document.querySelectorAll('.open-modal-btn');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const modal = document.querySelector('.modal');
    const contactForm = document.querySelector('.contact-form');
    const submitBtn = document.querySelector('.submit-btn');

    // Функция для открытия модального окна
    function openModal() {
        modal.style.display = 'block';
    }
    // Функция для закрытия модального окна
    function closeModal() {
        modal.style.display = 'none';
    }
    // Функция для проверки валидности email
    function isValidEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        return emailRegex.test(email);
    }
    // Функция для проверки валидности имени и фамилии
    function isValidName(name) {
        const nameRegex = /^[a-zA-Z]+$/;
        return nameRegex.test(name);
    }

    // Функция для обработки отправки формы
    function handleSubmit(event) {
        // Предотвращаем стандартное поведение формы
        event.preventDefault();

        // Функция для получения содержания форм ввода
        const firstName = document.getElementById('first-name').value.trim();
        const lastName = document.getElementById('last-name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();

        // Сообщения об успешной отправки формы
        const message = function(){alert("Form submitted successfully!")};

        // Сообщения об ошибке в заполнении с проверками на правильность
        if (!isValidName(firstName) || !isValidName(lastName)) {
            alert('Please enter a valid first and last name (English letters only).');
            return;
        }

        if (!phone.match(/^\+380[0-9]{9}$/)) {
            alert('Please enter a valid phone number starting with +380 and followed by 9 digits.');
            return;
        }

        if (!isValidEmail(email)) {
            alert('Please enter a valid email address.');
            return;
        }


        // Функция для очистки формы после ввода
        contactForm.reset();
        closeModal();
        // Функция для сообщение об успехе отправки формы(задержка для того чтобы alert не останавливал выполнения остальных функций
        setTimeout(message, 600);
    }
    // Добавляем обработчики событий для каждой кнопки открытия модального окна
    openModalBtns.forEach(btn => {
        btn.addEventListener('click', openModal);
    });

    // Добавляем обработчик события для кнопки закрытия модального окна
    closeModalBtn.addEventListener('click', closeModal);

    // Обновляем состояние кнопки submit при изменении полей формы
    contactForm.addEventListener('input', function () {
        const isFormValid = contactForm.checkValidity();
        submitBtn.disabled = !isFormValid;
    });

    // Добавляем обработчик события для отправки формы
    contactForm.addEventListener('submit', handleSubmit);
});