function togglePassword() {
    const passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function showAlert(message) {
    alert(message);
}

function login() {
    window.location.href = "index.php"; // Relativer Pfad zur neuen Seite
}