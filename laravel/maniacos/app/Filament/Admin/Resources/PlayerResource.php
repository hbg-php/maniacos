<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PlayerResource\Pages;
use App\Models\Player;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                                1 => 'Sub-14',
                                2 => 'Sub-16',
                                3 => 'Sub-18',
                                4 => 'Sub-21',
                                5 => 'Adulto',
                            ]),

                        Forms\Components\CheckboxList::make('positions')
                            ->label('Posição')
                            ->required()
                            ->options([
                                1 => 'Armador (Point Guard)',
                                2 => 'Ala-armador (Shooting Guard)',
                                3 => 'Ala (Small Forward)',
                                4 => 'Ala-pivô (Power Forward)',
                                5 => 'Pivô (Center)',
                            ])
                            ->columns(),

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
                    ])->columns()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Categoria')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        1 => 'Sub-14',
                        2 => 'Sub-16',
                        3 => 'Sub-18',
                        4 => 'Sub-21',
                        5 => 'Adulto',
                        default => 'Desconhecida',
                    }),

                Tables\Columns\TextColumn::make('height')
                    ->label('Altura (cm)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('weight')
                    ->label('Peso (kg)')
                    ->sortable(),

                Tables\Columns\IconColumn::make('isSuspended')
                    ->label('Suspenso')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
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
