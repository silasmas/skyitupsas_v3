<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\JobOffer;
use App\Models\Partner;
use App\Models\Realisation;
use App\Models\Service;
use App\Models\ServiceModule;
use App\Models\ServicePillar;
use App\Models\TeamMember;
use App\Services\FrontendCacheInvalidator;
use App\Services\InstallService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Modèles de contenu public dont la modification doit invalider le cache front.
     *
     * @var list<class-string<Model>>
     */
    private const CMS_MODELS = [
        About::class,
        Blog::class,
        Contact::class,
        JobOffer::class,
        Partner::class,
        Realisation::class,
        Service::class,
        ServiceModule::class,
        ServicePillar::class,
        TeamMember::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Avant l'installation, force session/cache fichier pour que le wizard
     * fonctionne même si les tables BDD n'existent pas encore.
     */
    public function boot(): void
    {
        if (! app(InstallService::class)->isInstalled()) {
            config([
                'session.driver' => 'file',
                'cache.default' => 'file',
            ]);
        }

        $this->registerFrontendCacheInvalidation();
    }

    /**
     * Branche l'invalidation du cache Next.js sur les événements Eloquent CMS.
     */
    private function registerFrontendCacheInvalidation(): void
    {
        $invalidate = static function (): void {
            app(FrontendCacheInvalidator::class)->invalidate();
        };

        foreach (self::CMS_MODELS as $modelClass) {
            $modelClass::saved($invalidate);
            $modelClass::deleted($invalidate);
        }
    }
}
