<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .users-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .user-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .user-card p {
            margin: 8px 0;
            color: #34495e;
        }

        .user-id {
            font-weight: bold;
            color: #2c3e50;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .user-detail {
            display: flex;
            justify-content: space-between;
        }

        .label {
            font-weight: bold;
            color: #7f8c8d;
        }

        .input {
            width: 100%;
            padding: 12px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 13px;
            transition: border-color 0.3s;
            outline: none;
        }

        input.input:focus {
            border-color: #3498db;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Gestión de Usuarios</h1>

        <form action="">
            <label for="cedula" class="label">Cédula:</label>
            <input type="text" class="input" name="cedula" placeholder="Cédula">
            <label for="nombre" class="label">Nombre:</label>
            <input type="text" class="input" name="nombre" placeholder="Nombre">
            <label for="apellido" class="label">Apellido:</label>
            <input type="text" class="input" name="apellido" placeholder="Apellido">
            <div id="mensaje"></div>
            <button type="button" onclick="cargarTodos()">Cargar Usuarios</button>
            <button type="button" onclick="registrarUsuarios()">Registrar Usuarios</button>
            <button type="button" onclick="eliminarUsuario()">Eliminar Usuarios</button>
            <div class="users-container" id="users-container">
                <!-- Los usuarios se mostrarán aquí -->
            </div>
        </form>
    </div>

    <script>
        function cargarTodos() {
            fetch('cargarValores.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    enlistarValores(data);
                })
                .catch(error => console.error('Error:', error));
        }

        function registrarUsuarios() {
            const formulario = document.querySelector('form');
            const info = {
                cedula: document.querySelector('input[name="cedula"]').value,
                nombre: document.querySelector('input[name="nombre"]').value,
                apellido: document.querySelector('input[name="apellido"]').value
            };
            fetch('registrarUsuarios.php', {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(info)
                })
                .then(resp => resp.json())
                .then(data => {
                    const mensajeDiv = document.getElementById('mensaje');
                    if (data.mensaje) {
                        mensajeDiv.innerHTML = `<p style="color: green;">${data.mensaje}</p>`;
                        setTimeout(() => {
                            window.location.href = 'practicaConJson.php';
                        }, "1500");
                    } else if (data.error) {
                        mensajeDiv.innerHTML = `<p style="color: red;">${data.error}</p>`;
                    }
                })
                .catch(error => {
                    console.log('Error! ' + error);
                });
        }

        function eliminarUsuario() {
            const formulario = document.querySelector('form');
            const info = {
                cedula: document.querySelector('input[name="cedula"]').value,
            };
            fetch('eliminarUsuarios.php', {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(info)
                })
                .then(resp => resp.json())
                .then(data => {
                    const mensajeDiv = document.getElementById('mensaje');
                    if (data.mensaje) {
                        mensajeDiv.innerHTML = `<p style="color: green;">${data.mensaje}</p>`;
                        setTimeout(() => {
                            window.location.href = 'practicaConJson.php';
                        }, "1000");
                    } else if (data.error) {
                        mensajeDiv.innerHTML = `<p style="color: red;">${data.error}</p>`;
                    }
                })
                .catch(error => {
                    console.log('Error! ' + error);
                });
        }

        function tomarValores(id) {
            const radio = document.querySelector('input[name="seleccionar"]:checked');
            if (!radio) return; // Si no hay ningún radio seleccionado, salir de la función

            const info = {
                userId: id
            };

            fetch('cargarInput.php', {
                    method: 'POST',
                    headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(info)
                })
                .then(resp => resp.json())
                .then(data => {
                    document.querySelector('input[name="cedula"]').value = data.cedula;
                    document.querySelector('input[name="nombre"]').value = data.nombre;
                    document.querySelector('input[name="apellido"]').value = data.apellido;

                    if (data.error) {
                        const mensajeDiv = document.getElementById('mensaje');
                        mensajeDiv.innerHTML = `<p style="color: red;">${data.error}</p>`;
                    }
                })
                .catch(error => {
                    console.log('Error! ' + error);
                });
        }

        function enlistarValores(data) {
            const usersContainer = document.getElementById('users-container');
            usersContainer.innerHTML = ''; // Limpiar contenedor antes de agregar nuevos elementos

            data.forEach((valor, index) => {
                usersContainer.innerHTML += `
                    <div class="user-card">
                        <input type="radio" name="seleccionar" onclick="tomarValores(${valor.id})">
                        <p class="user-id">Usuario #${valor.id}</p>
                        <div class="user-detail">
                            <span class="label">Cédula:</span>
                            <span>${valor.cedula}</span>
                        </div>
                        <div class="user-detail">
                            <span class="label">Nombre:</span>
                            <span>${valor.nombre}</span>
                        </div>
                    </div>
                `;
            });
        }
    </script>
</body>

</html>