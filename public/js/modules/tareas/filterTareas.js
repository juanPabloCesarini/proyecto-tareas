import { getTareas } from "./getTareas.js";

export const initFilterTarea = () => {
  const selectFiltro = document.getElementById("selectFiltroEstado");
  if (!selectFiltro) return;

  selectFiltro.addEventListener("change", (e) => {
    getTareas(e.target.value);
  });
};
