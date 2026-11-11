<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul', 'Data Siswa')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #e6dffb; --ink: #2b2442; --muted: #8a82a6; --line: #ece8f7;
            --brand: #8b5cf6; --brand-dark: #6d3fe0; --brand-soft: #f1ebff;
            --danger: #d64545; --ok-bg: #e5f6ee; --err-bg: #fdecec;
        }
        * { box-sizing: border-box; }
        body { margin: 0; padding: 2rem 1rem; background: var(--bg); color: var(--ink);
               font-family: "Poppins", system-ui, "Segoe UI", sans-serif; line-height: 1.5; }
        .ic { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2;
              stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }

        /* Kerangka */
        .shell { max-width: 1180px; margin: 0 auto; background: #fff; border-radius: 24px; padding: 1.25rem;
                 display: grid; grid-template-columns: 220px 1fr; gap: 1.5rem;
                 box-shadow: 0 20px 50px rgba(109, 63, 224, .15); }
        .content { min-width: 0; }

        /* Sidebar */
        .side { background: linear-gradient(180deg, #9d70fb, #7c4dec); border-radius: 18px; padding: 1.5rem 1rem;
                color: #fff; min-height: 560px; }
        .logo { width: 64px; height: 64px; margin: 0 auto 1.75rem; border-radius: 16px;
                background: rgba(255,255,255,.2); display: grid; place-items: center; }
        .logo .ic { width: 32px; height: 32px; }
        .menu a { display: flex; align-items: center; gap: .75rem; padding: .7rem .9rem; margin-bottom: .3rem;
                  border-radius: 10px; color: rgba(255,255,255,.85); text-decoration: none; font-size: .9rem; }
        .menu a:hover { background: rgba(255,255,255,.15); }
        .menu a.aktif { background: #fff; color: var(--brand-dark); font-weight: 600; }

        /* Bar atas */
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.25rem; }
        .topbar form { flex: 1; max-width: 340px; }
        .topbar input { width: 100%; padding: .65rem 1.1rem; border: 0; border-radius: 999px; background: #fff;
                        box-shadow: 0 4px 16px rgba(139,92,246,.12); font: inherit; font-size: .9rem; color: var(--ink); }
        .user { display: flex; align-items: center; gap: .6rem; }
        .user .foto { width: 38px; height: 38px; border-radius: 50%; background: var(--brand-soft); color: var(--brand-dark);
                      display: grid; place-items: center; font-weight: 700; }
        .user small { display: block; color: var(--muted); font-size: .75rem; line-height: 1.2; }
        .user b { font-size: .85rem; line-height: 1.2; }

        /* Banner */
        .banner { background: linear-gradient(100deg, #8b5cf6, #ac8cf9); color: #fff; border-radius: 18px;
                  padding: 1.75rem 2rem; display: flex; justify-content: space-between; align-items: center;
                  gap: 1rem; overflow: hidden; margin-bottom: 1.5rem; }
        .banner small { opacity: .85; }
        .banner h2 { margin: .35rem 0; font-size: 1.6rem; line-height: 1.25; }
        .banner p { margin: 0; opacity: .85; font-size: .9rem; }
        .banner svg { width: 150px; flex-shrink: 0; }

        /* Kartu statistik */
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
        .stat { background: #fff; border: 1px solid var(--line); border-radius: 14px; padding: 1.1rem; text-align: center;
                box-shadow: 0 4px 14px rgba(139,92,246,.08); }
        .stat.sorot { border: 2px solid var(--brand); }
        .stat .ikon { width: 46px; height: 46px; margin: 0 auto .5rem; border-radius: 50%; background: var(--brand-soft);
                      color: var(--brand); display: grid; place-items: center; }
        .stat strong { display: block; font-size: 1.6rem; line-height: 1.2; }
        .stat span { color: var(--muted); font-size: .85rem; }

        /* Kartu umum */
        .card { background: #fff; border: 1px solid var(--line); border-radius: 14px; padding: 1.25rem;
                box-shadow: 0 4px 14px rgba(139,92,246,.06); }
        .card-head { display: flex; justify-content: space-between; align-items: center; gap: .75rem;
                     flex-wrap: wrap; margin-bottom: 1rem; }
        .card-head h2 { margin: 0; font-size: 1.1rem; }

        /* Tombol */
        .btn { display: inline-block; padding: .5rem 1.1rem; border-radius: 999px; border: 1px solid var(--brand);
               background: var(--brand); color: #fff; text-decoration: none; font: inherit; font-size: .88rem; cursor: pointer; }
        .btn:hover { background: var(--brand-dark); border-color: var(--brand-dark); }
        .btn:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible
            { outline: 3px solid #c7b0fb; outline-offset: 2px; }
        .btn.ghost { background: transparent; color: var(--brand-dark); }
        .btn.ghost:hover { background: var(--brand-soft); }
        .btn.danger { background: transparent; color: var(--danger); border-color: var(--danger); }
        .btn.danger:hover { background: var(--err-bg); }
        .btn.small { padding: .25rem .75rem; font-size: .8rem; }

        /* Tabel */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .9rem; }
        th, td { text-align: left; padding: .7rem .5rem; border-bottom: 1px solid var(--line); vertical-align: middle; }
        th { color: var(--muted); font-weight: 500; font-size: .82rem; }
        .nama { display: flex; align-items: center; gap: .6rem; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--brand-soft); color: var(--brand-dark);
                  display: grid; place-items: center; font-weight: 600; font-size: .85rem; flex-shrink: 0; }
        .chip { padding: .15rem .6rem; border-radius: 999px; font-size: .78rem; background: var(--brand-soft); color: var(--brand-dark); }
        .chip.p { background: #fde8f3; color: #b8337f; }
        .aksi { display: flex; gap: .4rem; white-space: nowrap; }
        .aksi form { margin: 0; }
        .kosong { text-align: center; color: var(--muted); padding: 2rem 0; }
        .paging { display: flex; justify-content: space-between; align-items: center; gap: .5rem; flex-wrap: wrap;
                  margin-top: 1rem; color: var(--muted); font-size: .85rem; }

        /* Form & notifikasi */
        label { display: block; font-weight: 500; font-size: .88rem; margin-bottom: .25rem; }
        input, select, textarea { width: 100%; padding: .6rem .8rem; border: 1px solid #ddd5f3; border-radius: 10px;
                                  background: #fff; color: var(--ink); font: inherit; font-size: .9rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; }
        .field { margin-bottom: 1rem; }
        .error { color: var(--danger); font-size: .82rem; margin-top: .25rem; }
        .alert { padding: .75rem 1rem; border-radius: 10px; margin-bottom: 1rem; font-size: .9rem; }
        .alert.ok { background: var(--ok-bg); }
        .alert.err { background: var(--err-bg); }
        .alert.err ul { margin: .25rem 0 0; padding-left: 1.1rem; }

        @media (max-width: 860px) {
            .shell { grid-template-columns: 1fr; }
            .side { min-height: 0; padding: 1rem; }
            .logo { display: none; }
            .menu { display: flex; gap: .5rem; flex-wrap: wrap; }
            .menu a { margin: 0; }
            .banner svg { display: none; }
        }
        @media (max-width: 560px) {
            .stats { grid-template-columns: 1fr; }
            .user div { display: none; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <aside class="side">
            <div class="logo">
                <svg class="ic" viewBox="0 0 24 24"><path d="M2 9l10-5 10 5-10 5z"/><path d="M6 11v5c0 1.5 3 3 6 3s6-1.5 6-3v-5"/></svg>
            </div>
            <nav class="menu">
                <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.index') ? 'aktif' : '' }}">
                    <svg class="ic" viewBox="0 0 24 24"><path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('siswa.create') }}" class="{{ request()->routeIs('siswa.create') ? 'aktif' : '' }}">
                    <svg class="ic" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M19 8v6M22 11h-6"/></svg>
                    Tambah siswa
                </a>
            </nav>
        </aside>

        <div class="content">
            <div class="topbar">
                <form method="GET" action="{{ route('siswa.index') }}">
                    <input type="search" name="cari" value="{{ request('cari') }}" placeholder="Cari nama, NIS, atau kelas" aria-label="Cari siswa">
                </form>
                <div class="user">
                    <span class="foto">A</span>
                    <div><b>Admin</b><small>Pengelola data</small></div>
                </div>
            </div>

            @if (session('sukses'))
                <div class="alert ok" role="status">{{ session('sukses') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert err" role="alert">
                    <strong>Data belum bisa disimpan. Perbaiki isian berikut:</strong>
                    <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            @yield('isi')
        </div>
    </div>
</body>
</html>