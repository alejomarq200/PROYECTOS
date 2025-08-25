<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmos Gym - Sistema de Gestión</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-thin-straight/css/uicons-thin-straight.css'>
    <style>
        /* Importación de fuentes */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --body-color: #E4E9F7;
            --sidebar-color: #FFF;
            --primary-color: #2c3e50;
            --primary-color-light: #F6F5FF;
            --toggle-color: #DDD;
            --text-color: #2c3e50;
            --transition: all 0.3s ease;
        }

        body {
            min-height: 100vh;
            background-color: var(--body-color);
            transition: var(--transition);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding: 10px 14px;
            background: var(--sidebar-color);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar.close {
            width: 88px;
        }

        .logo-details {
            display: flex;
            align-items: center;
            height: 60px;
        }

        .logo-details i {
            font-size: 30px;
            color: var(--primary-color);
            height: 50px;
            min-width: 50px;
            text-align: center;
            line-height: 50px;
        }

        .logo-details .logo_name {
            font-size: 22px;
            color: var(--text-color);
            font-weight: 600;
            transition: var(--transition);
        }

        .sidebar.close .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar .nav-links {
            margin-top: 20px;
            height: 100%;
        }

        .sidebar li {
            position: relative;
            list-style: none;
            height: 50px;
            margin: 5px 0;
        }

        .sidebar li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 6px;
            align-items: center;
            text-decoration: none;
            transition: var(--transition);
        }

        .sidebar li a:hover {
            background: var(--primary-color-light);
        }

        .sidebar li a .link_name {
            color: var(--text-color);
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 1;
            pointer-events: auto;
            transition: var(--transition);
        }

        .sidebar.close li a .link_name {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar li a i {
            height: 35px;
            min-width: 35px;
            border-radius: 6px;
            line-height: 35px;
            text-align: center;
            font-size: 22px;
            color: var(--text-color);
            transition: var(--transition);
        }

        .sidebar li .sub-menu {
            padding: 6px 6px 14px 50px;
            margin-top: -10px;
            background: var(--primary-color-light);
            border-radius: 0 0 6px 6px;
            display: none;
        }

        .sidebar li.showMenu .sub-menu {
            display: block;
        }

        .sidebar li .sub-menu a {
            color: var(--text-color);
            font-size: 14px;
            padding: 5px 0;
            white-space: nowrap;
            opacity: 0.8;
            transition: var(--transition);
        }

        .sidebar li .sub-menu a:hover {
            opacity: 1;
        }

        .sidebar.close .sub-menu {
            position: absolute;
            left: 100%;
            top: 0;
            margin-top: 0;
            padding: 10px 20px;
            border-radius: 6px;
            background: var(--primary-color-light);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            display: block;
            transform: translateX(-20px);
            pointer-events: none;
            transition: var(--transition);
            width: 180px;
        }

        .sidebar.close .nav-links li:hover .sub-menu {
            opacity: 1;
            pointer-events: auto;
            transform: translateX(0);
        }

        .sidebar .sub-menu .link_name {
            display: none;
        }

        .sidebar.close .sub-menu .link_name {
            font-size: 16px;
            font-weight: 500;
            display: block;
        }

        .sidebar .sub-menu.blank {
            opacity: 1;
            pointer-events: auto;
            padding: 3px 20px 6px;
            opacity: 0;
            pointer-events: none;
        }

        .sidebar .nav-links li:hover .sub-menu.blank {
            top: 50%;
            transform: translateY(-50%);
        }

        .icon-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon-link i.arrow {
            min-width: auto;
            transition: var(--transition);
        }

        .sidebar li.showMenu i.arrow {
            transform: rotate(180deg);
        }

        .profile-details {
            position: fixed;
            bottom: 0;
            width: 220px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--primary-color-light);
            padding: 12px 0;
            transition: var(--transition);
        }

        .sidebar.close .profile-details {
            width: 60px;
            background: none;
        }

        .profile-content {
            display: flex;
            align-items: center;
        }

        .profile-content img {
            height: 45px;
            width: 45px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 10px 0 0;
        }

        .profile-details .name-job {
            white-space: nowrap;
        }

        .profile-details .profile_name {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-color);
        }

        .profile-details .job {
            font-size: 12px;
            color: var(--text-color);
        }

        .sidebar.close .profile-details .name-job,
        .sidebar.close .profile-details i {
            opacity: 0;
            pointer-events: none;
        }

        .home-section {
            position: relative;
            background: var(--body-color);
            min-height: 100vh;
            left: 250px;
            width: calc(100% - 250px);
            transition: var(--transition);
            padding: 20px;
        }

        .sidebar.close~.home-section {
            left: 88px;
            width: calc(100% - 88px);
        }

        .home-content {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            padding: 0 20px;
        }

        .home-content .bx-menu {
            font-size: 30px;
            cursor: pointer;
            color: var(--text-color);
            margin-right: 20px;
        }

        .home-content .text {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-color);
        }

        /* Main Content */
        .main-content {
            margin-top: 30px;
            padding: 20px;
            background: #FFF;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .content-header {
            margin-bottom: 30px;
        }

        .content-header h2 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #2c3e50, #4a6491);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-card i {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .stat-card h3 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 14px;
            opacity: 0.9;
        }

        .table-container {
            background: #FFF;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f1f1f1;
        }

        th {
            background-color: var(--primary-color-light);
            color: var(--primary-color);
            font-weight: 600;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: #34495e;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color-light);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 88px;
            }

            .sidebar.close {
                width: 0;
            }

            .home-section {
                left: 88px;
                width: calc(100% - 88px);
            }

            .sidebar.close~.home-section {
                left: 0;
                width: 100%;
            }

            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-dumbbell'></i>
            <span class="logo_name">Cosmos Gym</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="prueba.php">
                    <i class='bx bx-home'></i>
                    <span class="link_name">Inicio</span>
                </a>
            </li>
            <li>
                <div class="icon-link">
                    <a href="clientes.php">
                        <i class='bx bx-user'></i>
                        <span class="link_name">Clientes</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bx-dumbbell'></i>
                        <span class="link_name">Rutinas</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class='bx bx-bowl-rice'></i>
                        <span class="link_name">Nutrición</span>
                    </a>
                </div>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-credit-card'></i>
                    <span class="link_name">Pagos</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-bar-chart'></i>
                    <span class="link_name">Reportes</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Configuración</span>
                </a>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_1280.png" alt="profileImg">
                        <a href="logout.php" style="text-decoration: none; display: flex; align-items: center; color: var(--text-color); margin-left: 10px;">
                            <i class="fi fi-ts-arrow-left-from-arc" style="font-size: 15px;"></i>
                            <span class="link_name">Cerrar sesión</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
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