<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Validación Regex</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        h1 {
            text-align: center;
            color: #2d3748;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
        }

        input::placeholder {
            color: #a0aec0;
        }

        input.error {
            border: 2px solid #e53e3e;
            box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.2);
        }

        input.success {
            border: 2px solid #38a169;
        }

        .error-message {
            color: #e53e3e;
            font-size: 14px;
            margin-top: 5px;
            display: block;
            min-height: 20px;
        }

        .success-message {
            color: #38a169;
            font-size: 14px;
            margin-top: 5px;
            display: block;
            min-height: 20px;
        }

        button {
            background-color: #4a6cf7;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #3b5be3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #718096;
            font-size: 14px;
        }

        .requirements {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
            color: #4a5568;
        }

        .requirements h3 {
            margin-bottom: 10px;
            color: #2d3748;
        }

        .requirements ul {
            padding-left: 20px;
        }

        .requirements li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Formulario con Validación</h1>
        <form id="myForm">
            <div class="input-group">
                <input type="text" id="usuario" name="usuario" placeholder="Escribe tu nombre de usuario">
                <span class="error-message" id="error-usuario"></span>
            </div>

            <div class="input-group">
                <input type="text" id="email" name="email" placeholder="Escribe tu email">
                <span class="error-message" id="error-email"></span>
            </div>

            <button type="submit" id="btn-enviar">ENVIAR</button>

            <div class="form-footer" style="color: red;">
                Todos los campos son obligatorios
            </div>
        </form>

        <div class="requirements">
            <h3>Requisitos de validación:</h3>
            <ul style="color: red;">
                <li>Usuario: 4-15 caracteres, solo letras, números y guiones bajos</li>
                <li>Email: debe tener un formato de email válido</li>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //Definimos variables a manipular
            const form = document.getElementById('myForm');
            const usuarioInput = document.getElementById('usuario');
            const emailInput = document.getElementById('email');

            //Definimos campos de error
            const errorUsuario = document.getElementById('error-usuario');
            const errorEmail = document.getElementById('error-email');

            // Expresiones regulares para validación
            const usuarioRegex = /^[a-zA-Z0-9_]{4,15}$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;

                // Validar usuario con regex
                if (usuarioInput.value.trim() === '') {
                    showError(usuarioInput, errorUsuario, 'Por favor, escribe tu nombre de usuario');
                    isValid = false;
                } else if (!usuarioRegex.test(usuarioInput.value)) {
                    showError(usuarioInput, errorUsuario, 'El usuario debe tener entre 4 y 15 caracteres (solo letras, números y _)');
                    isValid = false;
                } else {
                    clearError(usuarioInput, errorUsuario);
                }

                // Validar email con regex
                if (emailInput.value.trim() === '') {
                    showError(emailInput, errorEmail, 'Por favor, escribe tu correo electrónico');
                    isValid = false;
                } else if (!emailRegex.test(emailInput.value)) {
                    showError(emailInput, errorEmail, 'Por favor, introduce un email válido');
                    isValid = false;
                } else {
                    clearError(emailInput, errorEmail);
                }

                if (isValid) {
                    alert('Los campos se llenaron correctamente');
                    // Aquí normalmente se enviaría el formulario
                    usuarioInput.classList.add('success');
                    emailInput.classList.add('success');

                    // Limpiar formulario después de 2 segundos
                    setTimeout(() => {
                        form.reset();
                        usuarioInput.classList.remove('success');
                        emailInput.classList.remove('success');
                    }, 2000);
                }
            });

            function showError(input, errorElement, message) {
                input.classList.add('error');
                input.classList.remove('success');
                errorElement.textContent = message;
            }

            function clearError(input, errorElement) {
                input.classList.remove('error');
                errorElement.textContent = '';
            }
        });
    </script>
</body>

</html>