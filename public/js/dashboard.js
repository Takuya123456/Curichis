// Funciones generales del dashboard: sidebar movil y cierre de sesion.
document.addEventListener("DOMContentLoaded", () => {
    const hamburger = document.querySelector(".hamburger");
    const sidebar = document.querySelector(".sidebar");
    const overlay = document.querySelector(".overlay");
    const logoutButton = document.getElementById("btn-logout");

    // Abre el menu lateral en pantallas pequenas.
    function openSidebar() {
        sidebar?.classList.add("open");
        overlay?.classList.add("show");
    }

    // Cierra el menu lateral y oculta el fondo oscuro.
    function closeSidebar() {
        sidebar?.classList.remove("open");
        overlay?.classList.remove("show");
    }

    hamburger?.addEventListener("click", openSidebar);
    overlay?.addEventListener("click", closeSidebar);

    // Pide confirmacion antes de cerrar sesion.
    logoutButton?.addEventListener("click", (e) => {
        e.preventDefault();
        if (confirm("Seguro que deseas cerrar sesion?")) {
            window.location.href = e.currentTarget.href;
        }
    });
});
