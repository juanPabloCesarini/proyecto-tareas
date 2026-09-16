import { tareaService } from "../../services/tareaService.js";
import { getTareas } from "./getTareas.js";

export const deleteTarea = async (id) => {
  if (!confirm("¿Desea eliminar esta tarea?")) return;

  try {
    await tareaService.delete(id);
    const selectFiltro = document.getElementById("selectFiltroEstado");
    getTareas(selectFiltro ? selectFiltro.value : 0);
  } catch (error) {
    console.error("Error al eliminar tarea:", error);
  }
};
