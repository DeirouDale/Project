<!-- sidebar.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>SDO Batac LRMS</title>
</head>
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bx-school'><img class="logo-img" src="../Img/icon.png" width="60px" height="60px"></i>
        <span class="text">SGOD Batac</span>
    </a>
    <ul class="side-menu top">
        <?php
        // Get the current page name
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>
        <li class="menu-label">Main Menu</li>
        <li class="<?= $current_page == 'index.php' ? 'active' : '' ?>">
            <a href="index.php">
                <i class='bx bx-home'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="<?= $current_page == 'Tasks.php' ? 'active' : '' ?>">
            <a href="Tasks.php">
                <i class='bx bx-file'></i>
                <span class="text">Tasks</span>
            </a>
        </li>

        <!-- Management Section -->
        <li class="menu-label">School Managment</li>
        <li class="<?= $current_page == 'Schools.php' ? 'active' : '' ?>">
            <a href="Schools.php">
                <i class='bx bx-building'></i>
                <span class="text">Schools</span>
            </a>
        </li>
        <li class="<?= $current_page == 'Tables.php' ? 'active' : '' ?>">
            <a href="Tables.php">
                <i class='bx bx-table'></i>
                <span class="text">Tables</span>
            </a>
        </li>
        <li class="<?= $current_page == 'Boxes.php' ? 'active' : '' ?>">
            <a href="Boxes.php">
                <i class='bx bx-box'></i>
                <span class="text">Boxes</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li class="menu-label">Settings</li>
        <li>
            <a href="../login_employee/emp_logout.php" class="logout">
                <i class='bx bx-log-out'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
