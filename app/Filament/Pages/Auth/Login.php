<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Callout;
use Filament\Support\Icons\Heroicon;

class Login extends BaseLogin
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Callout::make('Welcome to CRHEIS-NMIS-RTOCXI')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->description('Login with your email and password')
                    ->color('info'),
                $this->getEmailFormComponent()
                    ->placeholder(__('Enter email address')),
                $this->getPasswordFormComponent()
                    ->placeholder(__('Enter password')),
                $this->getRememberFormComponent(),
            ]);
    }
}
