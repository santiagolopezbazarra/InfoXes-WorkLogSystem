// Obtener los elementos del DOM
const modal = document.getElementById("modal");
const observacionesButton = document.querySelector(".observaciones");
const closeModalButton = document.querySelector(".close");

// Cuando el usuario haga clic en el botón de Observaciones, abrir el modal
observacionesButton.addEventListener("click", () => {
    modal.style.display = "flex"; // Mostrar el modal
});

// Cuando el usuario haga clic en el botón de cerrar (x), cerrar el modal
closeModalButton.addEventListener("click", () => {
    modal.style.display = "none"; // Ocultar el modal
});

// Cuando el usuario haga clic fuera del contenido del modal, cerrar el modal
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none"; // Ocultar el modal
    }
});


function cargarDia(){
    let elementoFecha = document.getElementById("elementoFecha");
    
    const fechaActual = new Date();

    const dia = String(fechaActual.getDate()).padStart(2, '0'); // Obtener el día y añadir 0 si es menor a 10
    const mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
    const anio = fechaActual.getFullYear();

    const fechaFormateada = `${dia}/${mes}/${anio}`;

    elementoFecha.textContent = fechaFormateada;
}