<aside>
                <div class="top">

                    <div class="logo">
                        <h2 class="text-muted">INVEN<span class="danger"></span>TARIO</h2>
                    </div>

                    <div class="close" id="close-btn">
                        <span class="material-symbols-outlined">close</span>
                    </div>
                </div>

                <div class="sidebar">

                    <a href="dashboard-final.php">
                        <span class="material-symbols-outlined">grid_view</span>
                        <h3>Menú</h3>
                    </a>

                    <a href="crear-venta-final.php">
                        <span class="material-symbols-outlined">receipt</span>
                        <h3>Registrar Venta</h3>
                    </a>

                    <a href="mostrar-ventas-final.php">
                        <span class="material-symbols-outlined">inventory</span>
                        <h3>Mostrar Ventas</h3>
                    </a>

                    <a href="registrar-producto-final.php">
                        <span class="material-symbols-outlined">box_add</span>
                        <h3>Registrar Producto</h3>
                    </a>

                    <a href="mostrar-productos-final.php">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <h3>Mostrar Productos</h3>
                    </a>

                    <a href="mostrar-usuario-final.php">
                        <span class="material-symbols-outlined">assignment_ind</span>
                        <h3>Usuarios</h3>
                        <span class="message-count">
                            <?php include('database/menu/sql-contar-usuarios.php') ?>
                        </span>
                    </a>

                    <a href="registrar-usuario-final.php">
                        <span class="material-symbols-outlined">inventory</span>
                        <h3>Registrar Usuarios</h3>
                    </a>

                    <a href="mostrar-historial-final.php">
                        <span class="material-symbols-outlined">receipt_long</span>
                        <h3>Mostrar Historial</h3>
                    </a>

                    <a href="database/logout.php">
                        <span class="material-symbols-outlined">logout</span>
                        <h3>Cerrar Sesión</h3>
                    </a>
                </div>
            </aside>