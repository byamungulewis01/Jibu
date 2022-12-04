<?php require '../Config/conn.php'; ?>
<?php 
if (!isset($_SESSION['admin']) or empty($_SESSION['admin'])) {
    echo"<script>window.location=' index.php?session'</script>";
}
 ?>
               <!-- Topbar -->
                <nav class="navbar navbar-expand topbar static-top shadow">
                    <a href="dashboard.php">  <img src="../Images/Logo.png" style="width: 80px; height: 40px;"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="order.php">Order </a>

                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="submited.php">submited</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Store.php">Store</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="message.php">Clients Chart</a>
                            </li>
                        
                          
                        </ul>
                    </div>
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['admin']; ?></span>
                               
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="Administration.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Administration
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>