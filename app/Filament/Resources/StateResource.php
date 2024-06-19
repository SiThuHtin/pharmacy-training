<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\State;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Services\Components\Appicons;
use App\Filament\Exports\StateExporter;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ExportAction;
use Illuminate\Database\Eloquent\Builder;
use App\Services\Components\FormComponents;
use App\Filament\Resources\StateResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StateResource\RelationManagers;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = Appicons::STATE_ICON;

    protected static ?string $navigationGroup ='Demographic Settings';

    protected static ?string $navigationLabel ='State/Division/Province';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormComponents::countrySelect(),
                FormComponents::stateInput(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('country')->searchable()->sortable()
                ->badge()
                ,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
            ])
            ->headerActions([
                ExportAction::make()
                ->exporter(StateExporter::class)
                ->label('Download Excel')
                ->color('primary')
                ->outlined()
                ->icon(Appicons::DOWNLOAD_ICONS)
                ->fileName(fn():string => date('d-M-Y') .'-state-export')
                ->columnMapping(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(null);
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
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
