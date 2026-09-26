<?php

namespace App\Providers\Filament;

use App\Filament\Pages\AnalyticsOverview;
use App\Filament\Pages\Auth\Login;
use Caresome\FilamentAuthDesigner\AuthDesignerPlugin;
use Caresome\FilamentAuthDesigner\Enums\MediaPosition;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Hammadzafar05\FilamentMobilePreset\FilamentMobilePresetPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use JohnRivera7\FilamentAntivirus\FilamentAntivirusPlugin;
use Openplain\FilamentShadcnTheme\Color as ShadcnColor;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->registration()
            ->brandName('NMIS RTOC 11')
            ->brandLogo('/images/ezracare_logo.png')
            ->brandLogoHeight('40px')
            ->font('Onest')
            ->colors([
                'primary' => ShadcnColor::Default,
                'secondary' => Color::Purple,
            ])
            ->plugins([
                FilamentMobilePresetPlugin::make(),
                AuthDesignerPlugin::make()
                    ->defaults(
                        fn($config) => $config
                            ->media(asset('images/auth_background_image.png'))
                            ->mediaPosition(MediaPosition::Left)
                            ->mediaSize('65%')
                    )
                    ->login()
                    ->registration()
                    ->passwordReset(),
                FilamentAntivirusPlugin::make()
                    ->navigationGroup('System Setup')
            ])
            ->sidebarWidth('18rem')
            ->collapsedSidebarWidth('5rem')
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth(true)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Regulated Entities'),
                NavigationGroup::make()
                    ->label('Enforcement'),
                NavigationGroup::make()
                    ->label('Enforcement Setup'),
                NavigationGroup::make()
                    ->label('System Setup')
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                AnalyticsOverview::class
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
