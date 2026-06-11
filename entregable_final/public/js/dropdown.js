// Controla los submenus desplegables del sidebar.
document.addEventListener("DOMContentLoaded", () => {
    const dropButtons = document.querySelectorAll(".sidebar .dropbtn");

    dropButtons.forEach((button) => {
        button.addEventListener("click", (event) => {
            // Evita que el enlace "#" recargue o suba la pagina.
            event.preventDefault();

            // Muestra u oculta el submenu del modulo seleccionado.
            const dropdown = button.closest(".dropdown");
            dropdown?.classList.toggle("show");
        });
    });
});
