import { dashboardTemplate } from "../templates/dashboardTemplate.js";

export const renderDashboard = (container) => {
  container.innerHTML = dashboardTemplate();
};
