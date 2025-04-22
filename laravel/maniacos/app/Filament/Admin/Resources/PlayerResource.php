<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PlayerResource\Pages;
use App\Filament\Admin\Resources\PlayerResource\RelationManagers;
use App\Models\Player;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'Jogador';

    protected static ?string $pluralModelLabel = 'Jogadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\DatePicker::make('birthdate')
                            ->label('Data de Nascimento')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y'),

                        Forms\Components\Select::make('category')
                            ->label('Categoria')
                            ->required()
                            ->options([
                                'Sub-13' => 'Sub-13',
                                'Sub-15' => 'Sub-15',
                                'Sub-17' => 'Sub-17',
                                'Adulto' => 'Adulto',
                            ]),

                        Forms\Components\TextInput::make('height')
                            ->label('Altura (cm)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(300),

                        Forms\Components\TextInput::make('weight')
                            ->label('Peso (kg)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(300),

                        Forms\Components\Toggle::make('isSuspended')
                            ->label('Suspenso')
                            ->default(false)
                            ->onColor('danger')
                            ->offColor('success'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
