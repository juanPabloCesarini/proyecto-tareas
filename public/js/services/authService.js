// public/js/services/authService.js
import { httpClient } from "../utils/httpClient.js";

export const authService = {
  login: async (datos) => {
    return await httpClient("/AuthController/loginUsuario", {
      method: "POST",
      body: JSON.stringify(datos),
    });
  },

  recuperarPassword: async (email) => {
    return await httpClient("/AuthController/enviar_password", {
      method: "POST",
      body: JSON.stringify({ email }),
    });
  },

  actualizarPassword: async (datos) => {
    return await httpClient("/AuthController/actualizar_password", {
      method: "POST",
      body: JSON.stringify(datos),
    });
  },

  logout: async () => {
    return await httpClient("/AuthController/logout", {
      method: "POST",
    });
  },
};
