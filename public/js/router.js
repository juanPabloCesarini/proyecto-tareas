import { renderHome } from "./modules/home.js";
import {
  renderLogin,
  renderResetPassword,
  renderRegister,
  renderUpdatePassword,
} from "./modules/auth/index.js";

const routes = {
  "/": renderHome,
  "/login": renderLogin,
  "/register": renderRegister,
  "/reset-password": renderResetPassword,
  "/update-password": renderUpdatePassword,
};

const getNormalizedPath = () => {
  const path = window.location.pathname;
  const basePath = "/proyecto-tareas";

  if (path.startsWith(basePath)) {
    const route = path.replace(basePath, "");
    return route === "" ? "/" : route;
  }

  return path;
};

export const router = {
  handleRoute: () => {
    const path = getNormalizedPath();
    const renderFn = routes[path] || routes["/"];
    const container = document.getElementById("app");

    if (container && typeof renderFn === "function") {
      container.innerHTML = "";
      renderFn(container);
    }
  },

  navigateTo: (url) => {
    const basePath = "/proyecto-tareas";

    const targetUrl = url.startsWith(basePath)
      ? url
      : `${basePath}${url.startsWith("/") ? url : `/${url}`}`;

    window.history.pushState({}, "", targetUrl);
    router.handleRoute();
  },

  init: () => {
    document.addEventListener("click", (e) => {
      const link = e.target.closest("[data-link]");
      if (link) {
        e.preventDefault();
        const targetUrl = link.getAttribute("href");
        router.navigateTo(targetUrl);
      }
    });

    window.addEventListener("popstate", () => {
      router.handleRoute();
    });

    router.handleRoute();
  },
  handleRoute: () => {
    const path = getNormalizedPath();
    console.log("Ruta actual detectada:", path); // <-- LOG 1

    const renderFn = routes[path] || routes["/"];
    console.log("Función de render a ejecutar:", renderFn); // <-- LOG 2

    const container = document.getElementById("app");

    if (container && typeof renderFn === "function") {
      container.innerHTML = "";
      renderFn(container);
    } else {
      console.error(
        "No se encontró el contenedor #app o renderFn no es función",
      );
    }
  },
};
