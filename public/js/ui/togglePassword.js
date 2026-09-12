/**
 * Componente UI: Toggle Password Visibility
 * Alterna el tipo de input (password/text) y la clase del icono de Bootstrap Icons
 */
export const initTogglePassword = () => {
  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-toggle-password");
    if (!btn) return;

    e.preventDefault();

    const container = btn.closest(".input-group");
    const input = container ? container.querySelector("input") : null;
    const icon = btn.querySelector("i");

    if (!input || !icon) return;

    if (input.type === "password") {
      input.type = "text";
      icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
      input.type = "password";
      icon.classList.replace("bi-eye-slash", "bi-eye");
    }
  });
};
