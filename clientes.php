<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include("sidebar.php");
    ?>
     <!-- Home Section / Main Content -->
    <section class="home-section">
        <div class="main-content">
            <div class="content-header">
                <h2>Módulo de Clientes</h2>
                <p>Bienvenido al sistema de gestión de Cosmos Gym</p>
            </div>
            <div class="content-header">
                <h2>Clientes Recientes</h2>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Membresía</th>
                            <th>Fecha de Inicio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>María González</td>
                            <td>Premium Anual</td>
                            <td>15/08/2023</td>
                            <td>Activa</td>
                            <td>
                                <button class="btn btn-outline">Ver</button>
                                <button class="btn btn-primary">Editar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Carlos López</td>
                            <td>Básica Mensual</td>
                            <td>20/08/2023</td>
                            <td>Activa</td>
                            <td>
                                <button class="btn btn-outline">Ver</button>
                                <button class="btn btn-primary">Editar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Ana Rodríguez</td>
                            <td>Premium Mensual</td>
                            <td>05/09/2023</td>
                            <td>Activa</td>
                            <td>
                                <button class="btn btn-outline">Ver</button>
                                <button class="btn btn-primary">Editar</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Javier Martínez</td>
                            <td>Básica Anual</td>
                            <td>10/09/2023</td>
                            <td>Activa</td>
                            <td>
                                <button class="btn btn-outline">Ver</button>
                                <button class="btn btn-primary">Editar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
        <script>
        // Funcionalidad para abrir/cerrar la sidebar
        const sidebar = document.querySelector(".sidebar");
        const sidebarBtn = document.querySelector(".bx-menu");
        
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        
        // Funcionalidad para los submenús desplegables
        const arrows = document.querySelectorAll(".arrow");
        
        arrows.forEach(arrow => {
            arrow.addEventListener("click", (e) => {
                const arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        });
        
        // Cerrar submenús al hacer clic fuera de ellos
        document.addEventListener("click", (e) => {
            if (!e.target.matches(".arrow") && !e.target.matches(".icon-link a")) {
                const subMenus = document.querySelectorAll(".nav-links li");
                subMenus.forEach(item => {
                    if (item.classList.contains("showMenu")) {
                        item.classList.remove("showMenu");
                    }
                });
            }
        });
    </script>
</body>
</html>