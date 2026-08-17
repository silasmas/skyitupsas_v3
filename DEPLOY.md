# Déploiement production — SkyITup SAS v3

Architecture cible :

| Composant | URL | Projet |
|-----------|-----|--------|
| Frontend Next.js | `https://skyitupsas.org` | `skyitupsas-front` |
| Backend Laravel (API + Filament) | `https://admin.skyitupsas.org` | `skyitupsas_v3` (branche `backend`) |

---

## A. Éléments à préparer avant le déploiement

### A.1 — Hébergement Hostinger

- [ ] Sous-domaine `admin.skyitupsas.org` créé, SSL activé
- [ ] Domaine `skyitupsas.org` (et éventuellement `www`) prêt pour l’app Node
- [ ] Base MySQL créée (nom, utilisateur, mot de passe) — noter les identifiants
- [ ] PHP ≥ 8.3 avec extensions : `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, `curl`, `bcmath`
- [ ] Accès SSH ou terminal hPanel
- [ ] Node.js 20+ pour le frontend (app Node Hostinger)

### A.2 — Secrets / comptes

- [ ] Clé OpenAI (`OPENAI_API_KEY`) pour le chatbot Next.js
- [ ] Identifiants SMTP (mails contact, newsletter, candidatures)
- [ ] Accès GitHub aux dépôts `skyitupsas_v3` et `skyitupsas-front`

### A.3 — Variables d’environnement clés (backend)

| Variable | Exemple production |
|----------|-------------------|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://admin.skyitupsas.org` |
| `FRONTEND_URLS` | `https://skyitupsas.org,https://www.skyitupsas.org` |
| `DB_*` | identifiants MySQL Hostinger |
| `MAIL_*` | SMTP réel |
| `FILESYSTEM_DISK` | `public` |

Ces valeurs peuvent être saisies **dans le wizard `/install`** (recommandé) ou manuellement dans `.env`.

### A.4 — Variables frontend Next.js

| Variable | Exemple |
|----------|---------|
| `API_BASE_URL` | `https://admin.skyitupsas.org/api/v1` |
| `NEXT_PUBLIC_API_BASE_URL` | `https://admin.skyitupsas.org/api/v1` |
| `OPENAI_API_KEY` | clé secrète |
| `OPENAI_BASE_URL` | `https://api.openai.com/v1` |
| `OPENAI_MODEL` | `gpt-4o-mini` |

Voir aussi `skyitupsas-front/.env.production.example`.

---

## B. Déploiement du backend Laravel (admin + API)

### Étape 1 — Déployer le code

```bash
# Sur le serveur, dans le dossier du sous-domaine admin
git clone -b backend https://github.com/silasmas/skyitupsas_v3.git .
# ou : git pull origin backend

composer install --no-dev --optimize-autoloader
cp .env.example .env
# Document root Apache/Nginx = dossier public/
```

Permissions (Linux) :

```bash
chmod -R ug+rwx storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache   # adapter l'utilisateur web
```

### Étape 2 — Wizard d’installation (recommandé)

1. Ouvrir **`https://admin.skyitupsas.org/install`**
2. **Prérequis** — corriger tout point en échec
3. **Configuration** — APP_*, DB_*, MAIL_*, `FRONTEND_URLS` (test BDD inclus)
4. **Base de données** — migrations + `storage:link` + permissions Shield  
   - cocher les **seeders** seulement si vous voulez du contenu de démo
5. **Administrateur** — créer le compte `super_admin`
6. **Terminé** — « Verrouiller et ouvrir /admin »

Le fichier `storage/app/installed` est alors créé : le wizard devient inaccessible.

### Étape 3 — Vérifications backend

- [ ] `https://admin.skyitupsas.org/admin` → login Filament OK
- [ ] `https://admin.skyitupsas.org/api/v1/services` → JSON
- [ ] Upload média → fichier visible via `/storage/...`
- [ ] Menu Shield (rôles / permissions) visible dans l’admin

### Alternative CLI (sans wizard)

```bash
php artisan key:generate
# Éditer .env manuellement
php artisan migrate --force
php artisan db:seed --force          # optionnel
php artisan storage:link
php artisan shield:generate --all --option=permissions -n
php artisan make:filament-user     # puis assigner super_admin
php artisan app:mark-installed
php artisan optimize
```

### Environnement déjà en place (avant le wizard)

```bash
php artisan app:mark-installed
```

---

## C. Déploiement du frontend Next.js

Voir aussi la procédure Hostinger Node (fichier `server.js` + Git hPanel) :

1. Cloner / pull `skyitupsas-front` branche `main`
2. Créer l’app Node (démarrage : `server.js`, Node 20+)
3. Définir les variables d’environnement **avant** le build
4. `npm install && npm run build`
5. Redémarrer l’app Node + SSL sur `skyitupsas.org`

Contrôles :

- [ ] Accueil `/fr` OK
- [ ] Pages détail (services, réalisations, équipe, blog, actualités)
- [ ] Formulaires contact / newsletter (CORS via `FRONTEND_URLS`)
- [ ] Chatbot + bandeau cookies

---

## D. Ordre recommandé le jour J

1. Backend sur `admin.skyitupsas.org` + wizard `/install`  
2. Vérifier l’API  
3. Frontend Next sur `skyitupsas.org`  
4. Pointer le DNS / document root si bascule depuis l’ancien site  
5. Tests bout-en-bout (formulaire, médias, admin)

---

## E. Sécurité post-installation

- [ ] `APP_DEBUG=false`
- [ ] `storage/app/installed` présent (wizard fermé)
- [ ] Mot de passe admin fort
- [ ] Ne jamais committer `.env` ni `OPENAI_API_KEY`
- [ ] Sauvegardes MySQL + `storage/app` planifiées
- [ ] Pour réouvrir le wizard (urgence) : supprimer `storage/app/installed` — **à éviter en prod**

---

## F. Mises à jour ultérieures

```bash
# Backend
git pull origin backend
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize

# Frontend
git pull origin main
npm install
npm run build
# Redémarrer l'app Node Hostinger
```
