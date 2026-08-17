<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <title>Installation — SkyITup SAS</title>
  <style>
    :root {
      --ink-950: #0b1220;
      --ink-700: #334155;
      --ink-500: #64748b;
      --ink-200: #e2e8f0;
      --ink-100: #f1f5f9;
      --ink-50: #f8fafc;
      --brand: #f59e0b;
      --brand-600: #d97706;
      --ok: #059669;
      --err: #dc2626;
      --white: #fff;
      --radius: 16px;
      --font: "Segoe UI", system-ui, -apple-system, sans-serif;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: var(--font);
      color: var(--ink-950);
      background:
        radial-gradient(1200px 600px at 10% -10%, rgba(245, 158, 11, 0.18), transparent 60%),
        radial-gradient(900px 500px at 100% 0%, rgba(15, 23, 42, 0.08), transparent 55%),
        var(--ink-50);
    }
    .wrap {
      width: min(920px, calc(100% - 2rem));
      margin: 2.5rem auto 3rem;
    }
    .brand {
      display: flex;
      align-items: center;
      gap: .75rem;
      margin-bottom: 1.5rem;
    }
    .brand-mark {
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 12px;
      background: var(--ink-950);
      color: var(--brand);
      display: grid;
      place-items: center;
      font-weight: 800;
      letter-spacing: -.03em;
    }
    .brand h1 {
      margin: 0;
      font-size: 1.25rem;
      letter-spacing: -.02em;
    }
    .brand p {
      margin: .15rem 0 0;
      color: var(--ink-500);
      font-size: .875rem;
    }
    .card {
      background: var(--white);
      border: 1px solid var(--ink-200);
      border-radius: calc(var(--radius) + 4px);
      box-shadow: 0 20px 50px rgba(15, 23, 42, 0.08);
      overflow: hidden;
    }
    .steps {
      display: flex;
      flex-wrap: wrap;
      gap: .5rem;
      padding: 1rem 1.25rem;
      border-bottom: 1px solid var(--ink-100);
      background: var(--ink-50);
    }
    .step-pill {
      font-size: .75rem;
      font-weight: 600;
      padding: .4rem .7rem;
      border-radius: 999px;
      color: var(--ink-500);
      background: var(--white);
      border: 1px solid var(--ink-200);
    }
    .step-pill.active {
      color: var(--ink-950);
      border-color: var(--brand);
      background: #fffbeb;
    }
    .step-pill.done {
      color: var(--ok);
      border-color: #a7f3d0;
      background: #ecfdf5;
    }
    .body { padding: 1.75rem 1.5rem 2rem; }
    h2 {
      margin: 0 0 .5rem;
      font-size: 1.35rem;
      letter-spacing: -.02em;
    }
    .lead {
      margin: 0 0 1.5rem;
      color: var(--ink-500);
      line-height: 1.55;
    }
    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
    }
    @media (max-width: 720px) {
      .grid { grid-template-columns: 1fr; }
    }
    .field { display: flex; flex-direction: column; gap: .35rem; }
    .field.full { grid-column: 1 / -1; }
    label {
      font-size: .8rem;
      font-weight: 600;
      color: var(--ink-700);
    }
    input, select {
      width: 100%;
      border: 1px solid var(--ink-200);
      border-radius: 12px;
      padding: .7rem .85rem;
      font: inherit;
      background: var(--white);
    }
    input:focus, select:focus {
      outline: 2px solid rgba(245, 158, 11, .35);
      border-color: var(--brand);
    }
    .hint { font-size: .75rem; color: var(--ink-500); }
    .checks { display: grid; gap: .55rem; }
    .check {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      padding: .75rem .9rem;
      border-radius: 12px;
      border: 1px solid var(--ink-200);
      background: var(--ink-50);
      font-size: .875rem;
    }
    .check.ok { border-color: #a7f3d0; background: #ecfdf5; }
    .check.bad { border-color: #fecaca; background: #fef2f2; }
    .badge {
      font-size: .7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .04em;
      color: var(--ok);
    }
    .check.bad .badge { color: var(--err); }
    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: .75rem;
      margin-top: 1.75rem;
      justify-content: flex-end;
    }
    .btn {
      appearance: none;
      border: 0;
      border-radius: 999px;
      padding: .75rem 1.25rem;
      font: inherit;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    .btn-primary { background: var(--brand); color: var(--ink-950); }
    .btn-primary:hover { background: var(--brand-600); color: var(--white); }
    .btn-primary:disabled { opacity: .5; cursor: not-allowed; }
    .btn-ghost {
      background: var(--white);
      color: var(--ink-700);
      border: 1px solid var(--ink-200);
    }
    .alert {
      border-radius: 12px;
      padding: .85rem 1rem;
      margin-bottom: 1rem;
      font-size: .875rem;
      line-height: 1.45;
    }
    .alert-ok { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .alert-err { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    .seed-list {
      margin: 0;
      padding-left: 1.1rem;
      color: var(--ink-700);
      font-size: .875rem;
      line-height: 1.6;
    }
    .toggle {
      display: flex;
      gap: .75rem;
      align-items: flex-start;
      padding: 1rem;
      border: 1px solid var(--ink-200);
      border-radius: 12px;
      background: var(--ink-50);
      margin-bottom: 1rem;
    }
    .toggle input { width: auto; margin-top: .2rem; }
    .footer-note {
      margin-top: 1rem;
      text-align: center;
      color: var(--ink-500);
      font-size: .75rem;
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="brand">
      <div class="brand-mark">SI</div>
      <div>
        <h1>SkyITup SAS — Installation</h1>
        <p>Assistant de déploiement du backend Laravel (API + admin Filament)</p>
      </div>
    </div>
    @yield('content')
    <p class="footer-note">Accessible uniquement tant que le fichier <code>storage/app/installed</code> n'existe pas.</p>
  </div>
</body>
</html>
