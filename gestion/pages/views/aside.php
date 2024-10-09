<!-- ASIDE -->
<div class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar navbar-light">
      <div class="container-fluid">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link" href="../views/principal.php" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
              </span>
              <span class="nav-link-title">
                PÁGINA PRINCIPAL
              </span>
            </a>
          </li>
          <!-- MENÚ RECURSOS HUMANOS -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
              </span>
              <span class="nav-link-title">
                RECURSOS HUMANOS
              </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <?php if ($nivel <= 3){ ?>
                  <a class="dropdown-item" href="../grids/trabajadores.php" >
                    TRABAJADORES
                  </a>
                  <a class="dropdown-item" href="../grids/registro_trabajo.php" >
                    REGISTRO HORARIO
                  </a>
                <?php } ?>
                </div>
              </div>
            </div>
          </li>


          <!-- MENÚ ADMINISTRACION -->
          <?php if ($nivel <= 4){ ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
              <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="4" width="6" height="5" rx="2" /><rect x="4" y="13" width="6" height="7" rx="2" /><rect x="14" y="4" width="6" height="7" rx="2" /><rect x="14" y="15" width="6" height="5" rx="2" /></svg>
              </span>
              <span class="nav-link-title">
                ADMINISTRACION
              </span>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <?php if ($nivel <= 3){ ?>
                  <a class="dropdown-item" href="../grids/obras.php" >
                    OBRAS
                  </a>
                  <a class="dropdown-item" href="../grids/maquinaria.php" >
                    MAQUINARIA
                  </a>
                  <a class="dropdown-item" href="../grids/personal.php" >
                    PERSONAL
                  </a>
                <?php } ?>
                </div>
              </div>
            </div>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- FIN ASIDE -->
