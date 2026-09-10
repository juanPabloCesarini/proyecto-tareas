export function mostrarExito(mensaje) {
  Swal.fire({
    icon: "success",
    title: "¡Listo!",
    text: mensaje,
  });
}

export function mostrarError(mensaje) {
  Swal.fire({
    icon: "error",
    title: "Error",
    text: mensaje,
  });
}

export function mostrarAdvertencia(mensaje) {
  Swal.fire({
    icon: "warning",
    title: "Atención",
    text: mensaje,
  });
}

export function mostrarInfo(mensaje) {
  Swal.fire({
    icon: "info",
    title: "Información",
    text: mensaje,
  });
}
