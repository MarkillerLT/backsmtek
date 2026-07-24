<div class="admin-topbar">

    <div style="display:flex;align-items:center;gap:1.4rem;">

        <button
            class="sidebar-toggle-btn"
            id="sidebarToggle"
            aria-label="Menú">

            <span></span>
            <span></span>
            <span></span>

        </button>

        <div class="topbar-user">

            <div class="topbar-avatar">

                @if(Auth::user()->profile_photo_url)
                    <img src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                @endif

            </div>

            <div>

                <div class="topbar-username">
                    {{ Auth::user()->name }}
                </div>

                <div class="topbar-role">
                    Administrador
                </div>

            </div>

        </div>

    </div>

    <div class="topbar-title">
        {{ $title ?? 'Panel de Administración' }}
    </div>

    <div class="topbar-actions">
    <button
        id="dark-toggle"
        class="dark-toggle"
        aria-label="Cambiar modo de color"
        type="button"
      >
        <span class="toggle-icon" aria-hidden="true">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="1em"
            height="1em"
            viewBox="0 0 24 24"
          >
            <title xmlns="">dark</title>
            <path
              fill="currentColor"
              d="M12.741 20.917a9.4 9.4 0 0 1-1.395-.105a9.141 9.141 0 0 1-1.465-17.7a1.18 1.18 0 0 1 1.21.281a1.27 1.27 0 0 1 .325 1.293a8.1 8.1 0 0 0-.353 2.68a8.27 8.27 0 0 0 4.366 6.857a7.6 7.6 0 0 0 3.711.993a1.242 1.242 0 0 1 .994 1.963a9.15 9.15 0 0 1-7.393 3.738M10.261 4.05a.2.2 0 0 0-.065.011a8.137 8.137 0 1 0 9.131 12.526a.22.22 0 0 0 .013-.235a.23.23 0 0 0-.206-.136a8.6 8.6 0 0 1-4.188-1.116a9.27 9.27 0 0 1-4.883-7.7a9.1 9.1 0 0 1 .4-3.008a.29.29 0 0 0-.069-.285a.18.18 0 0 0-.133-.057"
            />
          </svg>
        </span>
        <span class="toggle-label">Modo Oscuro</span>
        <div class="toggle-track" aria-hidden="true">
          <div class="toggle-thumb"></div>
        </div>
      </button>



        <form method="POST"
            action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                class="topbar-logout">

                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><title xmlns="">logout</title><path fill="currentColor" d="M5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h7v2H5v14h7v2zm11-4l-1.375-1.45l2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5z"/>
                    </svg>
                </span>

                <span>Cerrar sesión</span>

            </button>

        </form>

    </div>

</div>
