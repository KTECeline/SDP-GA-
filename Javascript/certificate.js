function closeLogin() {
    window.location.href = "../user/homepage.php";
}

function downloadCertificate() {
    var header = document.querySelector('header');
    var footer = document.querySelector('footer');
    var buttons = document.querySelector('.button');
    var originalBackground = document.body.style.background;

    if (header) header.style.display = 'none';
    if (footer) footer.style.display = 'none';
    if (buttons) buttons.style.display = 'none';
    document.body.style.background = 'white';

    window.print();

    if (header) header.style.display = '';
    if (footer) footer.style.display = '';
    if (buttons) buttons.style.display = '';
    document.body.style.background = originalBackground;
}