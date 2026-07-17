@extends('install.layout')

@section('content')
  @php
    $order = array_keys($steps);
    $currentIndex = array_search($step, $order, true);
  @endphp

  <div class="card">
    <div class="steps">
      @foreach ($steps as $key => $label)
        @php
          $idx = array_search($key, $order, true);
          $class = $key === $step ? 'active' : ($idx < $currentIndex ? 'done' : '');
        @endphp
        <span class="step-pill {{ $class }}">{{ $idx + 1 }}. {{ $label }}</span>
      @endforeach
    </div>

    <div class="body">
      @if (session('success'))
        <div class="alert alert-ok">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert alert-err">
          <ul style="margin:0;padding-left:1.1rem;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if ($step === 'requirements')
        <h2>Prérequis serveur</h2>
        <p class="lead">Vérifiez que l'hébergement est prêt avant de configurer l'application.</p>

        <div class="checks">
          @foreach ($checks as $check)
            <div class="check {{ $check['ok'] ? 'ok' : 'bad' }}">
              <div>
                <strong>{{ $check['label'] }}</strong>
                <div class="hint">{{ $check['detail'] }}</div>
              </div>
              <span class="badge">{{ $check['ok'] ? 'OK' : 'KO' }}</span>
            </div>
          @endforeach
        </div>

        <div class="actions">
          @if ($requirementsOk)
            <a class="btn btn-primary" href="{{ route('install.index', ['step' => 'environment']) }}">Continuer</a>
          @else
            <button class="btn btn-primary" type="button" disabled>Corrigez les points en échec</button>
            <a class="btn btn-ghost" href="{{ route('install.index', ['step' => 'requirements']) }}">Relancer le contrôle</a>
          @endif
        </div>
      @endif

      @if ($step === 'environment')
        <h2>Paramètres de base</h2>
        <p class="lead">Ces valeurs sont écrites dans le fichier <code>.env</code>. La connexion BDD est testée avant de continuer.</p>

        <form method="post" action="{{ route('install.environment') }}">
          @csrf
          <div class="grid">
            <div class="field">
              <label for="APP_NAME">Nom de l'application</label>
              <input id="APP_NAME" name="APP_NAME" value="{{ old('APP_NAME', $values['APP_NAME']) }}" required>
            </div>
            <div class="field">
              <label for="APP_URL">URL backend (admin / API)</label>
              <input id="APP_URL" name="APP_URL" type="url" value="{{ old('APP_URL', $values['APP_URL']) }}" required>
              <span class="hint">Ex. https://admin.skyitupsas.org</span>
            </div>
            <div class="field">
              <label for="APP_ENV">Environnement</label>
              <select id="APP_ENV" name="APP_ENV">
                @foreach (['production', 'staging', 'local'] as $env)
                  <option value="{{ $env }}" @selected(old('APP_ENV', $values['APP_ENV']) === $env)>{{ $env }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label for="APP_DEBUG">Mode debug</label>
              <select id="APP_DEBUG" name="APP_DEBUG">
                <option value="false" @selected(old('APP_DEBUG', $values['APP_DEBUG']) === 'false')>false (recommandé en prod)</option>
                <option value="true" @selected(old('APP_DEBUG', $values['APP_DEBUG']) === 'true')>true</option>
              </select>
            </div>
            <div class="field">
              <label for="APP_LOCALE">Langue par défaut</label>
              <select id="APP_LOCALE" name="APP_LOCALE">
                <option value="fr" @selected(old('APP_LOCALE', $values['APP_LOCALE']) === 'fr')>Français</option>
                <option value="en" @selected(old('APP_LOCALE', $values['APP_LOCALE']) === 'en')>English</option>
              </select>
            </div>
            <div class="field full">
              <label for="FRONTEND_URLS">Origines frontend autorisées (CORS)</label>
              <input id="FRONTEND_URLS" name="FRONTEND_URLS" value="{{ old('FRONTEND_URLS', $values['FRONTEND_URLS']) }}" required>
              <span class="hint">Séparées par des virgules — ex. https://skyitupsas.org,https://www.skyitupsas.org</span>
            </div>

            <div class="field">
              <label for="DB_CONNECTION">Type de base</label>
              <select id="DB_CONNECTION" name="DB_CONNECTION">
                @foreach (['mysql', 'pgsql', 'sqlite'] as $driver)
                  <option value="{{ $driver }}" @selected(old('DB_CONNECTION', $values['DB_CONNECTION']) === $driver)>{{ $driver }}</option>
                @endforeach
              </select>
            </div>
            <div class="field">
              <label for="DB_HOST">Hôte BDD</label>
              <input id="DB_HOST" name="DB_HOST" value="{{ old('DB_HOST', $values['DB_HOST']) }}">
            </div>
            <div class="field">
              <label for="DB_PORT">Port BDD</label>
              <input id="DB_PORT" name="DB_PORT" value="{{ old('DB_PORT', $values['DB_PORT']) }}">
            </div>
            <div class="field">
              <label for="DB_DATABASE">Nom de la base / chemin SQLite</label>
              <input id="DB_DATABASE" name="DB_DATABASE" value="{{ old('DB_DATABASE', $values['DB_DATABASE']) }}" required>
            </div>
            <div class="field">
              <label for="DB_USERNAME">Utilisateur BDD</label>
              <input id="DB_USERNAME" name="DB_USERNAME" value="{{ old('DB_USERNAME', $values['DB_USERNAME']) }}" autocomplete="off">
            </div>
            <div class="field">
              <label for="DB_PASSWORD">Mot de passe BDD</label>
              <input id="DB_PASSWORD" name="DB_PASSWORD" type="password" value="{{ old('DB_PASSWORD', $values['DB_PASSWORD']) }}" autocomplete="new-password">
            </div>

            <div class="field">
              <label for="MAIL_MAILER">Mailer</label>
              <input id="MAIL_MAILER" name="MAIL_MAILER" value="{{ old('MAIL_MAILER', $values['MAIL_MAILER']) }}" required>
            </div>
            <div class="field">
              <label for="MAIL_HOST">Hôte SMTP</label>
              <input id="MAIL_HOST" name="MAIL_HOST" value="{{ old('MAIL_HOST', $values['MAIL_HOST']) }}">
            </div>
            <div class="field">
              <label for="MAIL_PORT">Port SMTP</label>
              <input id="MAIL_PORT" name="MAIL_PORT" value="{{ old('MAIL_PORT', $values['MAIL_PORT']) }}">
            </div>
            <div class="field">
              <label for="MAIL_USERNAME">Utilisateur SMTP</label>
              <input id="MAIL_USERNAME" name="MAIL_USERNAME" value="{{ old('MAIL_USERNAME', $values['MAIL_USERNAME']) }}">
            </div>
            <div class="field">
              <label for="MAIL_PASSWORD">Mot de passe SMTP</label>
              <input id="MAIL_PASSWORD" name="MAIL_PASSWORD" type="password" value="{{ old('MAIL_PASSWORD', $values['MAIL_PASSWORD']) }}" autocomplete="new-password">
            </div>
            <div class="field">
              <label for="MAIL_FROM_ADDRESS">E-mail expéditeur</label>
              <input id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" type="email" value="{{ old('MAIL_FROM_ADDRESS', $values['MAIL_FROM_ADDRESS']) }}" required>
            </div>
            <div class="field">
              <label for="MAIL_FROM_NAME">Nom expéditeur</label>
              <input id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" value="{{ old('MAIL_FROM_NAME', $values['MAIL_FROM_NAME']) }}" required>
            </div>
          </div>

          <div class="actions">
            <a class="btn btn-ghost" href="{{ route('install.index', ['step' => 'requirements']) }}">Retour</a>
            <button class="btn btn-primary" type="submit">Enregistrer et tester la BDD</button>
          </div>
        </form>
      @endif

      @if ($step === 'database')
        <h2>Base de données &amp; services</h2>
        <p class="lead">Cette étape lance les migrations, crée le lien storage, génère les permissions Shield, et peut exécuter les seeders de démonstration.</p>

        <form method="post" action="{{ route('install.database') }}">
          @csrf

          <div class="toggle">
            <input id="run_seeders" name="run_seeders" type="checkbox" value="1" @checked(old('run_seeders', true))>
            <div>
              <label for="run_seeders">Exécuter les seeders de contenu</label>
              <p class="hint" style="margin:.25rem 0 .5rem;">Utile pour un premier déploiement de démo. Décochez pour une production vide.</p>
              <ul class="seed-list">
                @foreach ($seeders as $seeder)
                  <li>{{ $seeder }}</li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="checks">
            <div class="check ok">
              <div><strong>Migrations</strong><div class="hint">Crée toutes les tables (contenu, permissions Spatie, sessions…)</div></div>
              <span class="badge">Auto</span>
            </div>
            <div class="check ok">
              <div><strong>storage:link</strong><div class="hint">public/storage → storage/app/public</div></div>
              <span class="badge">Auto</span>
            </div>
            <div class="check ok">
              <div><strong>Permissions Shield</strong><div class="hint">Génère les permissions Filament + rôles super_admin / panel_user</div></div>
              <span class="badge">Auto</span>
            </div>
          </div>

          <div class="actions">
            <a class="btn btn-ghost" href="{{ route('install.index', ['step' => 'environment']) }}">Retour</a>
            <button class="btn btn-primary" type="submit">Lancer l'installation BDD</button>
          </div>
        </form>
      @endif

      @if ($step === 'finalize')
        <h2>Compte administrateur</h2>
        <p class="lead">Ce compte aura le rôle <code>super_admin</code> et pourra se connecter sur <code>/admin</code>.</p>

        <form method="post" action="{{ route('install.finish') }}">
          @csrf
          <div class="grid">
            <div class="field">
              <label for="name">Nom</label>
              <input id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="field">
              <label for="email">E-mail</label>
              <input id="email" name="email" type="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
              <label for="password">Mot de passe</label>
              <input id="password" name="password" type="password" minlength="8" required autocomplete="new-password">
            </div>
            <div class="field">
              <label for="password_confirmation">Confirmation</label>
              <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" required autocomplete="new-password">
            </div>
          </div>

          <div class="actions">
            <a class="btn btn-ghost" href="{{ route('install.index', ['step' => 'database']) }}">Retour</a>
            <button class="btn btn-primary" type="submit">Créer l'admin</button>
          </div>
        </form>
      @endif

      @if ($step === 'complete')
        <h2>Installation prête</h2>
        <p class="lead">
          L'application est configurée.
          @if (!empty($adminEmail))
            Connectez-vous avec <strong>{{ $adminEmail }}</strong>.
          @endif
          Cliquez ci-dessous pour verrouiller le wizard et ouvrir l'admin.
        </p>

        <div class="checks">
          <div class="check ok"><div><strong>Paramètres .env</strong></div><span class="badge">OK</span></div>
          <div class="check ok"><div><strong>Migrations + storage + Shield</strong></div><span class="badge">OK</span></div>
          <div class="check ok"><div><strong>Compte administrateur</strong></div><span class="badge">OK</span></div>
        </div>

        <form method="post" action="{{ route('install.lock') }}">
          @csrf
          <div class="actions">
            <button class="btn btn-primary" type="submit">Verrouiller et ouvrir /admin</button>
          </div>
        </form>
      @endif
    </div>
  </div>
@endsection
