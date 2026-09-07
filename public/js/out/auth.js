
export function iniciarAuth() {

    const formulario = document.querySelector('#formLogin');

    // Si la página no tiene formulario de login,
    // simplemente no hacemos nada.
    if (!formulario) {
        return;
    }

    formulario.addEventListener('submit', async function (event) {

        event.preventDefault();

        const email = document.querySelector('#exampleInputEmail').value;
        const password = document.querySelector('#exampleInputPassword').value;

        const datos = {
            email: email,
            password: password
        };

        try {

            const respuesta = await fetch(formulario.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            });

            const resultado = await respuesta.json();

            if (resultado.ok) {

                toastr.success(resultado.mensaje);

                window.location.href = resultado.redirect;

            } else {

                toastr.error(resultado.mensaje);

            }

        } catch (error) {

            console.error('Error en el login:', error);

            toastr.error('No se pudo conectar con el servidor.');

        }

    });
}

