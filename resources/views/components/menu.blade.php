


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{setActiveMenu(['home'])}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Accueil
              </p>
            </a>
          </li>
          @can("manager")
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Vue globale</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-swatchbook"></i>
                  <p>Locations</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can("admin")

          <li
            class="nav-item
                {{setRootMenu(
                [
                    'admin.habilitations.'
                ], 'menu-open')}}"
          >
            <a href="#" class="nav-link {{setRootMenu(['admin.habilitations.'], 'active')}}">
              <i class=" nav-icon fas fa-user-shield"></i>
              <p>
                Habilitations
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item {{setActiveMenu(['admin.habilitations.utilisateurs.index'])}}">
                <a
                href="{{ route('admin.habilitations.utilisateurs.index') }}"
                class="nav-link {{setActiveMenu(['admin.habilitations.utilisateurs.index'])}}"
                >
                  <i class=" nav-icon fas fa-users-cog"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-fingerprint"></i>
                  <p>Roles et permissions</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Gestion articles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="nav-icon far fa-circle"></i>
                  <p>Type d'articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-list-ul"></i>
                  <p>Articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-sliders-h"></i>
                  <p>Tarifications</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can("employe")
          <li class="nav-header">LOCATION</li>
          <li class="nav-item">
            <a href="{{ route('employe.clients.index') }}" class="nav-link {{setActiveMenu(['employe.clients.index'])}}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Gestion des clients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Gestion des locations
              </p>
            </a>
          </li>

          <li class="nav-header">CAISSE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Gestion des paiements
              </p>
            </a>
          </li>
          @endcan
        </ul>
      </nav>

