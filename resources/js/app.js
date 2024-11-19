import './bootstrap';
import '../css/app.css';


document.addEventListener('DOMContentLoaded', function () {
    const successMessage = document.getElementById('success-message');
    if (successMessage) {
        setTimeout(() => {
            successMessage.classList.add('opacity-0');
            setTimeout(() => successMessage.remove(), 500);
        }, 3000);
    }
});
