<!-- preloader -->
<!-- <div class="preloader" id='preloader'>
  <img src="layout/imgs/courses/Hourglass.gif" alt="">
</div> -->
<!-- preloader -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light glass sticky-top">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
        <img
          src="layout/imgs/logo.webp"
          height="15"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
      <!-- Left links -->
      <ul class="navbar-nav 
        <?php if(!empty($_SESSION['info']) && isset($_SESSION['info'])): ?>
          me-5
        <?php endif;?>
        ms-auto
        mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./courses.php">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./blog.php">Articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Help ?</a>
        </li>
        <li class="nav-item">
          <i class="fa-solid fa-moon ms-md-2 mt-md-2" id='mode'></i>
        </li>
        <?php if(empty($_SESSION['info']) && !isset($_SESSION['info'])): ?>
          <li class="nav-item">
            <a class="nav-link btn-info btn px-3 ms-3" href="login.php">Login</a>
          </li>
        <?php endif;?>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <?php if(!empty($_SESSION['info']) && isset($_SESSION['info'])): ?>
      <div class="d-flex align-items-center">
        <!-- Icon -->
        <!-- Avatar -->
        <div class="dropdown">
          <a
            class="dropdown-toggle d-flex align-items-center hidden-arrow"
            href="#"
            id="navbarDropdownMenuAvatar"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              src="<?php
              if(empty($_SESSION['info']['img'])){
                echo 'layout/imgs/users/AvatarMaker.png';
              }else{
                echo $_SESSION['info']['img'];
              }
              ?>"
              class="rounded-circle"
              height="25"
              alt="Black and White Portrait of a Man"
              loading="lazy"
            />
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuAvatar"
          >
            <li>
              <a class="dropdown-item" href="./profile.php">My profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    <?php endif;?>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->