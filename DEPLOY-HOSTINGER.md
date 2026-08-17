# Déploiement via Hostinger Connector (Cursor)

Domaines cibles :

| Rôle | Domaine | Dépôt Git | Branche |
|------|---------|-----------|---------|
| Site public (Next.js) | `https://skyitupsas.org` | `silasmas/skyitupsas-front` | `main` |
| Admin + API (Laravel) | `https://admin.skyitupsas.org` | `silasmas/skyitupsas_v3` | `backend` |

---

## Étape 0 — Connecter l’extension Hostinger (obligatoire)

L’extension est installée, mais **Cursor n’est pas encore connecté à Hostinger** (aucun fichier `~/.cursor/mcp.json` détecté).

1. Ouvrir la barre latérale **Hostinger** dans Cursor (icône Hostinger à gauche).
2. Cliquer **Connect** / **Se connecter** et suivre l’authentification :
   - **OAuth** (recommandé), ou
   - **Token API** : hPanel → **Profil → API** (ou Dev tools) → créer un token.
3. Si token manuel : définir la variable d’environnement Windows **avant** de relancer Cursor :
   ```powershell
   [System.Environment]::SetEnvironmentVariable("HOSTINGER_API_TOKEN", "VOTRE_TOKEN", "User")
   ```
   Puis **redémarrer Cursor**.
4. Dans la sidebar Hostinger, activer au minimum :
   - **Websites** (déploiement Node.js + PHP)
   - **Domains** (DNS pour `admin.skyitupsas.org`)
5. Vérifier que Cursor affiche les serveurs MCP Hostinger comme **connectés** (Settings → MCP).

Une fois connecté, redemandez dans le chat :

> « Déploie le backend sur admin.skyitupsas.org et le frontend sur skyitupsas.org via Hostinger »

---

## Étape 1 — DNS (Domains MCP ou hPanel)

Créer / vérifier :

| Enregistrement | Type | Cible |
|----------------|------|--------|
| `@` ou `skyitupsas.org` | A ou CNAME | hébergement **Node.js** (frontend) |
| `www` | CNAME | `skyitupsas.org` |
| `admin` | A ou CNAME | hébergement **PHP/Laravel** (backend) |

Activer **SSL** sur les deux domaines.

---

## Étape 2 — Backend Laravel (`admin.skyitupsas.org`)

### Déploiement Git (hPanel ou MCP)

- Dépôt : `https://github.com/silasmas/skyitupsas_v3.git`
- Branche : **`backend`**
- **Document root** : dossier `public/` du projet Laravel

### Commandes post-déploiement (terminal SSH / hPanel)

```bash
composer install --no-dev --optimize-autoloader
cp .env.example .env
chmod -R ug+rwx storage bootstrap/cache
```

### Wizard d’installation

Ouvrir : **`https://admin.skyitupsas.org/install`**

| Champ | Valeur |
|-------|--------|
| APP_URL | `https://admin.skyitupsas.org` |
| FRONTEND_URLS | `https://skyitupsas.org,https://www.skyitupsas.org` |
| DB_* | identifiants MySQL Hostinger |

Étapes wizard : migrations → seeders (optionnel) → storage:link → Shield → compte admin → verrouiller.

### Vérifications

- `https://admin.skyitupsas.org/api/v1/services` → JSON
- `https://admin.skyitupsas.org/admin` → login Filament

---

## Étape 3 — Frontend Next.js (`skyitupsas.org`)

### App Node.js Hostinger

- Dépôt : `https://github.com/silasmas/skyitupsas-front.git`
- Branche : **`main`**
- Fichier de démarrage : **`server.js`**
- Node.js : **20+**

### Variables d’environnement (AVANT `npm run build`)

```env
NODE_ENV=production
API_BASE_URL=https://admin.skyitupsas.org/api/v1
NEXT_PUBLIC_API_BASE_URL=https://admin.skyitupsas.org/api/v1
OPENAI_API_KEY=votre_cle
OPENAI_BASE_URL=https://api.openai.com/v1
OPENAI_MODEL=gpt-4o-mini
```

### Build

```bash
npm install
npm run build
```

Redémarrer l’app Node + SSL sur `skyitupsas.org`.

---

## Étape 4 — Tests finaux

- [ ] Accueil `https://skyitupsas.org/fr`
- [ ] Page détail réalisation (plus de 404)
- [ ] Formulaire contact (CORS OK)
- [ ] Chatbot + bandeau cookies
- [ ] Admin `https://admin.skyitupsas.org/admin`

---

## Prompts utiles (une fois MCP connecté)

```
Liste mes sites Hostinger et mes domaines skyitupsas.org
```

```
Configure le sous-domaine admin.skyitupsas.org pour le dépôt GitHub silasmas/skyitupsas_v3 branche backend, document root public/
```

```
Déploie l'app Node.js depuis silasmas/skyitupsas-front branche main sur skyitupsas.org avec server.js
```

```
Ajoute un enregistrement DNS admin.skyitupsas.org pointant vers l'hébergement backend
```

---

## Dépannage

| Problème | Solution |
|----------|----------|
| MCP Hostinger absent dans Cursor | Connecter via sidebar + redémarrer Cursor |
| 404 sur pages détail | Frontend Next pas déployé sur le bon domaine |
| CORS / formulaires bloqués | `FRONTEND_URLS` dans `.env` Laravel |
| Wizard `/install` inaccessible | Supprimer `storage/app/installed` (urgence seulement) |
| Build Next échoue | Variables `NEXT_PUBLIC_*` définies **avant** `npm run build` |
