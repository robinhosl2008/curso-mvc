// $(document).ready(function() {
    var email = document.querySelector('input[name="email"]');
    var password = document.querySelector('input[name="password"]');

    email.addEventListener('click', function() {
        removeMensagem();
    });

    password.addEventListener('click', function() {
        removeMensagem();
    });

    function removeMensagem() {
        setTimeout(function() {
            document.querySelector('.msg').innerText = '';
        }, 1000);
    }
// });
