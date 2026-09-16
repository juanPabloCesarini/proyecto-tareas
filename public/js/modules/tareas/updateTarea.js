import { tareaService } from "../../services/tareaService.js";
import { getTareas } from "./getTareas.js";

export const prepareEditTarea = async (id) => {
  const modalEl = document.getElementById("modalTarea");
  if (!modalEl) return;

  const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);

  try {
    const tarea = await tareaService.getById(id);

    document.getElementById("id_tarea").value = tarea.id_tarea;
    document.getElementById("tareaTitulo").value = tarea.titulo;
    document.getElementById("tareaDescripcion").value = tarea.descripcion;
    document.getElementById("tareaExpiredAt").value = tarea.expired_at;
    document.getElementById("tareaIdEstado").value = tarea.id_estado;

    document.getElementById("modalTareaTitulo").textContent = "Editar Tarea";
    modalInstance.show();
  } catch (error) {
    console.error("Error al cargar datos para editar:", error);
  }
};

export const initUpdateTarea = () => {
  const formTarea = document.getElementById("formTarea");
  const modalEl = document.getElementById("modalTarea");

  if (!formTarea || !modalEl) return;

  const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);

  formTarea.addEventListener("submit", async (e) => {
    const idTarea = document.getElementById("id_tarea").value;
    if (!idTarea) return; // Si no hay ID, es una creación

    e.preventDefault();
    const formData = new FormData(formTarea);
    const data = Object.fromEntries(formData.entries());

    try {
      await tareaService.update(idTarea, data);
      modalInstance.hide();
      formTarea.reset();
      document.getElementById("id_tarea").value = "";

      const selectFiltro = document.getElementById("selectFiltroEstado");
      getTareas(selectFiltro ? selectFiltro.value : 0);
    } catch (error) {
      console.error("Error al actualizar tarea:", error);
    }
  });
};
