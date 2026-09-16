import { tareaService } from "../../services/tareaService.js";
import { getTareas } from "./getTareas.js";

export const initCreateTarea = () => {
  const btnNueva = document.getElementById("btnNuevaTarea");
  const formTarea = document.getElementById("formTarea");
  const modalEl = document.getElementById("modalTarea");

  if (!formTarea || !modalEl) return;

  const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);

  // Resetear formulario para creación limpia
  if (btnNueva) {
    btnNueva.addEventListener("click", () => {
      formTarea.reset();
      document.getElementById("id_tarea").value = "";
      document.getElementById("modalTareaTitulo").textContent = "Nueva Tarea";
    });
  }

  formTarea.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Si tiene id_tarea, dejamos que tome el control updateTarea.js
    const idTarea = document.getElementById("id_tarea").value;
    if (idTarea) return;

    const formData = new FormData(formTarea);
    const data = Object.fromEntries(formData.entries());

    try {
      await tareaService.create(data);
      modalInstance.hide();
      formTarea.reset();

      const selectFiltro = document.getElementById("selectFiltroEstado");
      getTareas(selectFiltro ? selectFiltro.value : 0);
    } catch (error) {
      console.error("Error al crear tarea:", error);
    }
  });
};
