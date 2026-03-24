<?php

namespace App\Filament\Resources\Insumos;

use App\Filament\Resources\Insumos\Pages\CreateInsumos;
use App\Filament\Resources\Insumos\Pages\EditInsumos;
use App\Filament\Resources\Insumos\Pages\ListInsumos;
use App\Filament\Resources\Insumos\Pages\ViewInsumos;
use App\Filament\Resources\Insumos\Schemas\InsumosForm;
use App\Filament\Resources\Insumos\Schemas\InsumosInfolist;
use App\Filament\Resources\Insumos\Tables\InsumosTable;
use App\Models\Insumo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InsumosResource extends Resource
{
    protected static ?string $model = Insumo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nome';

    protected static ?string $navigationLabel = 'Insumos';

    public static function form(Schema $schema): Schema
    {
        return InsumosForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InsumosInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InsumosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInsumos::route('/'),
            'create' => CreateInsumos::route('/create'),
            'view' => ViewInsumos::route('/{record}'),
            'edit' => EditInsumos::route('/{record}/edit'),
        ];
    }
}
