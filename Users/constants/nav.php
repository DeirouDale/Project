<?php
?>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-success">
    <i class='bx bx-menu'></i>
    <form class="form-inline my-2 my-lg-0 d-none">
        <div class="form-input">
            <input class="form-control mr-sm-2" type="search" placeholder="Search here" aria-label="Search">
        </div>
    </form>
    
    <!-- Profile and Settings Dropdown -->
    <div class="ml-auto d-flex align-items-center">
        <!-- Settings Dropdown -->
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="settingsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class='bx bx-cog'></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="settingsDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <!-- Profile Picture and Name -->
        <div class="d-flex align-items-center mr-3">
            <img src="../styles/profile-picture.jpg" alt="Profile Picture" class="profile-img">
            <div class="ml-2">
                <span class="d-block">John Doe</span>
                <small class="text-muted">Position</small>
            </div>
        </div>
    </div>
</nav>


		<!-- NAVBAR -->