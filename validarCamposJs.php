<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Estilizado</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.1);
        }

        input::placeholder {
            color: #aaa;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-bottom: 15px;
            display: block;
            min-height: 20px;
        }

        button {
            background-color: #4a6cf7;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3b5be3;
        }
    </style>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="fomulario-js">
        <h2 style="text-align: center; margin-bottom:10px;">VALDACIÓN DE CAMPOS</h2>
        <input type="text" id="usuario" name="usuario" placeholder="Escribe tu nombre de usuario">
        <span class="error" id="error-usuario"></span>
        <input type="text" id="email" name="email" placeholder="Escribe tu email">
        <span class="error" id="error-email"></span>
        <button type="submit" id="btn-enviar">ENVIAR</button>
    </form>
</body>
<script>
    const formulario = document.getElementById('fomulario-js');
    const btnEnviar = document.getElementById('btn-enviar');

    const validación = (e) => {
        //Detener el envío de mi formuario
        e.preventDefault();

        const nombreDeUsuario = document.getElementById('usuario').value.trim();
        const direcciónEmail = document.getElementById('email').value.trim();

        if (nombreDeUsuario === "") {
            alert("Por favor, escribe tu nombre de usuario.");
            //nombreDeUsuario.focus();
            return false;
        }

        if (direcciónEmail === "") {
            alert("Por favor, escribe tu correo electrónico");
            //direcciónEmail.focus();
            return false;
        }
        return true;
    }

    const validacion1 = (e) => {
        e.preventDefault();

        //Definimos variables
        const nombreDeUsuario = document.getElementById('usuario');
        const direcciónEmail = document.getElementById('email');

        //Semáforo o flag
        let isValid = true;

        if (nombreDeUsuario.value === "") {
            document.getElementById('error-usuario').textContent = 'Por favor, escribe tu nombre de usuario';
            isValid = false;
            usuario.focus();
        } else {
            document.getElementById('error-usuario').textContent = '';
        }

        if (direcciónEmail.value === "") {
            document.getElementById('error-email').textContent = 'Por favor, escribe tu correo electrónico';
            isValid = false;
            email.focus();
        } else {
            document.getElementById('error-email').textContent = '';
        }

        //Preguntamos si luego de validar los campos isValid sigue siendo true
        if (isValid) {
            alert('Los campo se llenaron correctamente');
            return true;
        }
    }

    const validacion2 = (e) => {
        e.preventDefault();

        const nombreDeUsuario = document.getElementById('usuario');
        const direcciónEmail = document.getElementById('email');

        let isValid = true;

        if (nombreDeUsuario.value === "") {
            document.getElementById('error-usuario').style.display = 'block';
            document.getElementById('error-usuario').textContent = 'Por favor, escribe tu nombre de usuario';
            isValid = false;
            usuario.focus();
        } else {
            document.getElementById('error-usuario').style.display = 'none';
        }
        
        if (direcciónEmail.value === "") {
            document.getElementById('error-email').style.display = 'block';
            document.getElementById('error-email').textContent = 'Por favor, escribe tu correo electrónico';
            isValid = false;
            email.focus();
        } else {
            document.getElementById('error-email').style.display = 'none';
        }

        if (isValid) {
            alert('Los campo se llenaron correctamente');
            return true;
        }
    }

    const validacion3 = (e) => {
        e.preventDefault();

        const nombreDeUsuario = document.getElementById('usuario');
        const direcciónEmail = document.getElementById('email');

        let isValid = true;

        if (nombreDeUsuario.value === "") {
            nombreDeUsuario.style.borderBlockColor = 'red';
            document.getElementById('error-usuario').textContent = 'Por favor, escribe tu nombre de usuario';
            isValid = false;
        } else {
            document.getElementById('error-usuario').textContent = '';
        }

        if (direcciónEmail.value === "") {
            direcciónEmail.style.borderBlockColor = 'red';
            document.getElementById('error-email').textContent = 'Por favor, escribe tu correo electrónico';
            isValid = false;
        } else {
            document.getElementById('error-email').textContent = '';
        }

        if (isValid) {
            nombreDeUsuario.style.borderBlockColor = 'green';
            direcciónEmail.style.borderBlockColor = 'green';
            alert('Los campo se llenaron correctamente');
            return true;
        }
    }

    //Listener para botón
    btnEnviar.addEventListener('click', validacion3);
</script>
</body>

</html>