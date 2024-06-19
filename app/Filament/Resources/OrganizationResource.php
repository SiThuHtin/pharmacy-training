<?php

namespace App\Filament\Resources;

use App\Filament\Exports\OrganizationExporter;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Organization;
use Filament\Resources\Resource;
use App\Services\Components\Appicons;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = Appicons::ORGANIZATION_ICON;

    protected static ?string $navigationGroup = 'Demographic Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Organizations and Abbreviations')
                ->schema([
                    TextInput::make('name'),
                    TextInput::make('abbr'),

                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('abbr')
                ->label('Abbreviation')
                ->color('success')
                ->badge(),
                TextColumn::make('editable')
                ->badge()
                ->formatStateUsing(fn ($state)=> $state == true?'Editable':'Non-editable')
                ->color(fn($state)=>$state==true?'primary':'success'),
                
                TextColumn::make('user.name'),
                
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
           
            ])
            ->headerActions([
                ExportAction::make()
                ->icon(Appicons::DOWNLOAD_ICONS)
                ->exporter(OrganizationExporter::class)
                ->label('Download Excel')
                ->fileName(fn():string=> date('d-M-Y') . '-organization-export')
                ->columnMapping(false),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
