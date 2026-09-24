<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Account details')
                    ->description('Login credentials for this user.')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g. Juan Dela Cruz'),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->placeholder('juan.delacruz@nmis.gov.ph'),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->placeholder('••••••••')
                            ->helperText('Only fill in if setting or changing the password.')
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation) => $operation === 'create'),
                    ]),

                Section::make('Role & assignment')
                    ->description('What this user can access and which office they belong to.')
                    ->columns(2)
                    ->components([
                        TextInput::make('employee_id')
                            ->unique(ignoreRecord: true)
                            ->placeholder('e.g. NMIS-2024-0142')
                            ->helperText('Optional internal HR reference.'),
                        Select::make('office_id')
                            ->label('Office')
                            ->relationship('office', 'name')
                            ->searchable()
                            ->preload()
                            ->placeholder('Select office')
                            ->helperText('Used for jurisdiction and record attribution.'),
                        Select::make('role')
                            ->options([
                                'System Admin' => 'System Admin',
                                'NMIS Central' => 'NMIS Central',
                                'NMIS Regional' => 'NMIS Regional',
                                'Inspector' => 'Inspector',
                                'Legal Officer' => 'Legal Officer',
                                'LGU Staff' => 'LGU Staff',
                                'Viewer' => 'Viewer',
                            ])
                            ->required()
                            ->placeholder('Select role'),
                        TextInput::make('position')
                            ->placeholder('e.g. Meat Inspector'),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Turn off to revoke access without deleting the account.'),
                    ]),
            ]);
    }
}
