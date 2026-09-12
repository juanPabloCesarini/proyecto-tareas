// public/js/modules/auth.js
import { authService } from "../services/authService.js";
import { initTogglePassword } from "../ui/togglePassword.js";

// Inicializar componentes UI

export const iniciarAuth = () => {
  initTogglePassword();
  // 1. LOGIN
  const formLogin = document.querySelector("#formLogin");
  if (formLogin) {
    formLogin.addEventListener("submit", async (event) => {
      event.preventDefault();

      const email = document.querySelector("#exampleInputEmail").value;
      const password = document.querySelector("#exampleInputPassword").value;

      try {
        const resultado = await authService.login({ email, password });

        if (resultado.ok) {
          toastr.success(resultado.mensaje);
          window.location.href = resultado.redirect;
        } else {
          toastr.error(resultado.mensaje);
        }
      } catch (error) {
        toastr.error("Error al conectar con el servidor.");
      }
    });
  }

  // 2. RECUPERO DE CONTRASEÑA
  const formForgot = document.querySelector("#formForgotPassword");
  if (formForgot) {
    formForgot.addEventListener("submit", async (event) => {
      event.preventDefault();

      const email = document.querySelector("#inputEmail").value;

      try {
        const resultado = await authService.recuperarPassword(email);

        if (resultado.ok) {
          toastr.success(resultado.mensaje);
          formForgot.reset();
        } else {
          toastr.warning(resultado.mensaje);
        }
      } catch (error) {
        toastr.error("Error al conectar con el servidor.");
      }
    });
  }

  // 3. ACTUALIZAR CONTRASEÑA
  const formUpdatePass = document.querySelector("#formUpdatePassword");
  if (formUpdatePass) {
    formUpdatePass.addEventListener("submit", async (event) => {
      event.preventDefault();

      const email = document.querySelector('input[name="email"]').value;
      const pass_actual = document.querySelector(
        'input[name="pass_actual"]',
      ).value;
      const pass_nueva = document.querySelector(
        'input[name="pass_nueva"]',
      ).value;
      const pass_nueva2 = document.querySelector(
        'input[name="pass_nueva2"]',
      ).value;

      try {
        const resultado = await authService.actualizarPassword({
          email,
          pass_actual,
          pass_nueva,
          pass_nueva2,
        });

        if (resultado.ok) {
          toastr.success(resultado.mensaje);
          setTimeout(() => {
            window.location.href = resultado.redirect;
          }, 1500);
        } else {
          toastr.error(resultado.mensaje);
        }
      } catch (error) {
        toastr.error("Error al conectar con el servidor.");
      }
    });
  }
};
