import { mostrarExito, mostrarError } from "../ui/alerts.js";

export function iniciarAuth() {
  const formulario = document.querySelector("#formLogin");

  // Si la página no tiene formulario de login,
  // simplemente no hacemos nada.
  if (!formulario) {
    return;
  }

  formulario.addEventListener("submit", async function (event) {
    event.preventDefault();

    const datos = new FormData(formulario);

    try {
      const respuesta = await fetch(formulario.action, {
        method: "POST",
        body: datos,
      });

      const resultado = await respuesta.json();

      if (resultado.ok) {
        mostrarExito(resultado.mensaje);

        if (resultado.redirect) {
          window.location.href = resultado.redirect;
        }
      } else {
        mostrarError(resultado.mensaje);
      }
    } catch (error) {
      console.error("Error en el login:", error);

      mostrarError("No se pudo conectar con el servidor.");
    }
  });
}
