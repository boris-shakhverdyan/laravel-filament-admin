<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Traits\HasRoleBasedAccess;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ActivityResource extends Resource
{
    use HasRoleBasedAccess;

    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()->maxLength(50),

                Forms\Components\Textarea::make('description')->nullable()->maxLength(800),

                Forms\Components\Textarea::make('short_description')->nullable()->maxLength(200),

                Forms\Components\TextInput::make('registration_url')->url()->nullable(),

                Forms\Components\Select::make('activity_type_id')
                    ->relationship('type', 'name')->required(),

                Forms\Components\Textarea::make('location')
                    ->label('Location (Polygon Coordinates)')
                    ->json()
                    ->rows(6)
                    ->nullable()
                    ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
                    ->dehydrateStateUsing(fn ($state) => json_decode($state, true))
                    ->hint('Enter an array of coordinates: [{"lat": ..., "lng": ...}, ...]')
                    ->columnSpanFull(),

                Forms\Components\Select::make('partner_id')
                    ->relationship('partner', 'name')
                    ->preload()->searchable()->nullable(),

                Forms\Components\Hidden::make('created_by')
                    ->default(fn () => auth()->id())
                    ->required(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                    ->collection('images')->mimeTypeMap(["image/jpeg" => "jpg", "image/png" => "png"])
                    ->multiple(),

                Forms\Components\SpatieMediaLibraryFileUpload::make('videos')
                    ->collection('videos')->mimeTypeMap(["video/mp4" => "mp4"])
                    ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type.name')->label('Type'),
                Tables\Columns\TextColumn::make('partner.name')->label('Partner'),
                Tables\Columns\TextColumn::make('creator.name')->label('Creator'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
