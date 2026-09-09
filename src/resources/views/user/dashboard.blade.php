<x-app-layout>
    <style>
        body { overflow: hidden; }
        .admin-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: var(--bg-body);
        }
        .admin-sidebar {
            width: 26rem;
            flex-shrink: 0;
            background-color: var(--bg-nav);
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
            z-index: 50;
            transition: width var(--transition), background-color var(--transition);
            overflow: hidden;
        }
        .sidebar-nav {
            flex: 1;
            padding: 2rem 0;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }
        .sidebar-label {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 0 2rem 1rem;
            margin-top: 1rem;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            padding: 1.3rem 2rem;
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 1.45rem;
            font-weight: 500;
            transition: background-color var(--transition), color var(--transition), padding-left var(--transition);
            border-left: 3px solid transparent;
        }
        .sidebar-link .s-icon {
            font-size: 1.8rem;
            width: 2.4rem;
            text-align: center;
            flex-shrink: 0;
        }
        .sidebar-link:hover {
            background-color: rgba(255,255,255,0.07);
            color: var(--blanco);
            padding-left: 2.6rem;
        }
        .sidebar-link.activo {
            background-color: rgba(33, 150, 186, 0.2);
            color: var(--blanco);
            border-left-color: var(--AzulSmtek);
            font-weight: 700;
        }
        .sidebar-link.activo .s-icon { color: var(--AzulSmtek); }
        .sidebar-footer {
            padding: 1.8rem 2rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-footer .sidebar-link {
            border-radius: var(--radius-sm);
            padding: 1.2rem 1.6rem;
            border-left: none;
            color: rgba(255,100,100,0.8);
        }
        .sidebar-footer .sidebar-link:hover {
            background-color: rgba(226, 75, 74, 0.12);
            color: #ff7070;
            padding-left: 1.6rem;
        }
        .admin-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .admin-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 3rem;
            height: 7rem;
            background-color: var(--bg-header);
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
            z-index: 40;
            gap: 2rem;
            transition: background-color var(--transition);
        }
        .topbar-user {
            display: flex;
            align-items: center;
            gap: 1.4rem;
            flex-shrink: 0;
        }
        .topbar-avatar {
            width: 4.2rem;
            height: 4.2rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid var(--AzulSmtek);
            box-shadow: var(--shadow-sm);
            background-color: var(--AzulClaro);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: var(--AzulOscuro);
            font-weight: 700;
            overflow: hidden;
            flex-shrink: 0;
        }
        .topbar-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .topbar-username { font-size: 1.5rem; font-weight: 700; color: var(--text-heading); }
        .topbar-role { font-size: 1.2rem; color: var(--text-muted); font-weight: 400; }
        .topbar-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: 0.02em;
            text-align: center;
            flex: 1;
        }
        .topbar-actions { display: flex; align-items: center; gap: 1.6rem; flex-shrink: 0; }
        .topbar-logout {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.9rem 1.8rem;
            background-color: rgba(226, 75, 74, 0.1);
            border: 1px solid rgba(226, 75, 74, 0.25);
            color: var(--error);
            border-radius: var(--radius-sm);
            font-size: 1.4rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background-color var(--transition), transform var(--transition);
            font-family: "Inter", sans-serif;
        }
        .topbar-logout:hover { background-color: rgba(226, 75, 74, 0.2); transform: translateY(-1px); }
        .admin-content {
            flex: 1;
            overflow-y: auto;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2.8rem;
        }
        /* ══════════════════════════════════════════════════
           DASHBOARD DE USUARIO — sencillo
        ══════════════════════════════════════════════════ */
        .user-hero {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            padding: 3rem 3.4rem;
            display: flex;
            align-items: center;
            gap: 2.4rem;
        }
        .user-hero-avatar {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--AzulSmtek);
            box-shadow: var(--shadow-sm);
            background-color: var(--AzulClaro);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.2rem;
            color: var(--AzulOscuro);
            font-weight: 800;
            flex-shrink: 0;
            overflow: hidden;
        }
        .user-hero-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .user-hero-info h1 {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--text-heading);
            margin: 0 0 0.4rem;
        }
        .user-hero-info p {
            font-size: 1.4rem;
            color: var(--text-muted);
            margin: 0 0 0.8rem;
        }
        .user-hero-id {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.2rem;
            font-weight: 700;
            padding: 0.4rem 1.2rem;
            border-radius: 2rem;
            background-color: var(--AzulClaro);
            color: var(--AzulOscuro);
        }
        body.dark-mode .user-hero-id {
            background-color: rgba(33,150,186,0.2);
            color: var(--AzulSmtek);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .kpi-card {
            background-color: var(--bg-section);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 2.2rem 2.4rem;
            display: flex;
            align-items: center;
            gap: 1.8rem;
            border: 1px solid var(--border-color);
            transition: box-shadow var(--transition), transform var(--transition), background-color var(--transition);
        }
        .kpi-card:hover { box-shadow: var(--shadow-md); transform: translateY(-2px); }
        .kpi-icon {
            width: 5.4rem;
            height: 5.4rem;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            flex-shrink: 0;
        }
        .kpi-icon.azul    { background-color: var(--AzulClaro); }
        .kpi-icon.amarillo{ background-color: rgba(240,165,0,0.12); }
        .kpi-icon.verde   { background-color: rgba(29,158,117,0.12); }
        body.dark-mode .kpi-icon.azul     { background-color: rgba(33,150,186,0.15); }
        body.dark-mode .kpi-icon.amarillo { background-color: rgba(240,165,0,0.15); }
        body.dark-mode .kpi-icon.verde    { background-color: rgba(29,158,117,0.18); }
        .kpi-valor { font-size: 2.6rem; font-weight: 800; color: var(--text-heading); line-height: 1; margin-bottom: 0.4rem; }
        .kpi-label { font-size: 1.3rem; color: var(--text-muted); font-weight: 500; }

        @media (max-width: 900px) {
            .kpi-grid { grid-template-columns: 1fr; }
            .user-hero { flex-direction: column; text-align: center; }
        }
        @media (max-width: 768px) {
            .admin-sidebar {
                position: fixed;
                left: -26rem;
                height: 100%;
                z-index: 200;
                transition: left var(--transition);
            }
            .admin-sidebar.abierto { left: 0; }
            .admin-topbar { padding: 0 2rem; }
            .admin-content { padding: 2rem; }
            .topbar-title { display: none; }
            .sidebar-toggle-btn { display: flex !important; }
        }
        .sidebar-toggle-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem;
        }
        .sidebar-toggle-btn span {
            display: block;
            width: 2.2rem;
            height: 0.2rem;
            background-color: var(--text-heading);
            border-radius: 2px;
            transition: transform var(--transition), opacity var(--transition);
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 150;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.activo { display: block; }
    </style>

    <x-user.layout title="Dashboard">

        {{-- ── Tarjeta de usuario activo ── --}}
        <div class="user-hero">
            <div class="user-hero-avatar">
                @if($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div class="user-hero-info">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->email }}</p>
                <span class="user-hero-id">🆔 ID #{{ $user->id }}</span>
            </div>
        </div>

        {{-- ── KPIs: cotizaciones hechas vs respondidas ── --}}
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-icon azul">📋</div>
                <div>
                    <div class="kpi-valor">{{ $cotizacionesHechas }}</div>
                    <div class="kpi-label">Cotizaciones hechas</div>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon amarillo">⏳</div>
                <div>
                    <div class="kpi-valor">{{ $cotizacionesPendientes + $cotizacionesEnProceso }}</div>
                    <div class="kpi-label">En espera de respuesta</div>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon verde">✅</div>
                <div>
                    <div class="kpi-valor">{{ $cotizacionesRespondidas }}</div>
                    <div class="kpi-label">Respondidas</div>
                </div>
            </div>
        </div>

    </x-user.layout>
</x-app-layout>
