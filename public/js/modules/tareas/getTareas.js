import { tareaService } from "../../services/tareaService.js";
import { tareaTemplates } from "../../templates/tareaTemplates.js";

export const getTareas = async (idEstado = 0) => {
  const tablaBody = document.getElementById("tablaTareasBody");
  if (!tablaBody) return;

  try {
    const tareas = await tareaService.getAll(idEstado);
    tablaBody.innerHTML = tareaTemplates.filasTabla(tareas);
  } catch (error) {
    console.error("Error al obtener tareas:", error);
  }
};
