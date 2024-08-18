<!-- sidebar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>SDO Batac LRMS</title>
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs'><img class="logo-img" src="../Img/icon.png" width="60px" height="60px"></i>
            <span class="text">SGOD Batac</span>
        </a>
        <ul class="side-menu top">
        <li class="menu-label">Main Menu</li>
            <?php
            // Get the current page name
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            <li class="<?= $current_page == 'index.php' ? 'active' : '' ?>">
                <a href="index.php">
                    <i class='bx bxs-home'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="<?= $current_page == 'Tables.php' ? 'active' : '' ?>">
                <a href="Tables.php">
                    <i class='bx bxs-check-square'></i>
                    <span class="text">Tables</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li class="menu-label">Settings</li>
            <li>
                <a href="../logout.php" class="logout">
                    <i class='bx bxs-log-out'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
</body>
</html>
