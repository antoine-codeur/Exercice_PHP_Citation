document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('themeDarkToggle');
    function changeTheme() {
        const theme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', theme);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '?', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('theme=' + theme);    
        toggleBtn.textContent = theme === 'dark' ? 'Activer le mode clair' : 'Activer le mode sombre';
    }
    if (toggleBtn) {
        toggleBtn.addEventListener('click', changeTheme);
    }
});
