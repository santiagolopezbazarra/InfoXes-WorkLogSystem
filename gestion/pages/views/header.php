<!-- HEADER -->
<header class="navbar navbar-expand-md navbar-light d-print-none">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      <a href="../views/principal.php.">
        <img src="../../img/logo_principal.png" width="130" height="45" alt="Tabler" class="navbar-brand-image">
      </a>
    </h1>
    <?php
      include("aside.php");
    ?>
    <div class="navbar-nav flex-row order-md-last">
      <div class="nav-item d-none d-md-flex me-3">
        <div class="btn-list">
        </div>
      </div>
      <!-- ICONO DE USUARIO -->
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <circle cx="9" cy="7" r="4"></circle>
          <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
          <path d="M16 11l2 2l4 -4"></path>
        </svg>
        <div class="d-none d-xl-block ps-2">
          <div><?php echo $_SESSION['USUARIO']['nombre']; ?></div>
          <?php
            switch ($nivel) {
            case "1":
              echo "<div class='mt-1 small text-muted'>ADMINISTRADOR</div>";
              break;
            case "3":
              echo "<div class='mt-1 small text-muted'>GESTOR</div>";
              break;
          }
          ?>

        </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="#" class="dropdown-item">Datos del usuario</a>
          <div class="dropdown-divider"></div>
          <a href="../views/logout.php" class="dropdown-item">Logout</a>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- FIN HEADER -->
