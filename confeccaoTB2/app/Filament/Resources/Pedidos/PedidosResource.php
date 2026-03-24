<?php

namespace App\Filament\Resources\Pedidos;

use App\Filament\Resources\Pedidos\Pages\CreatePedidos;
use App\Filament\Resources\Pedidos\Pages\EditPedidos;
use App\Filament\Resources\Pedidos\Pages\ListPedidos;
use App\Filament\Resources\Pedidos\Pages\ViewPedidos;
use App\Filament\Resources\Pedidos\RelationManagers\ItensRelationManager;
use App\Filament\Resources\Pedidos\Schemas\PedidosForm;
use App\Filament\Resources\Pedidos\Schemas\PedidosInfolist;
use App\Filament\Resources\Pedidos\Tables\PedidosTable;
use App\Models\Pedido;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PedidosResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $navigationLabel = 'Pedidos';

    protected static ?string $modelLabel = 'Pedido';

    protected static ?string $pluralModelLabel = 'Pedidos';

    public static function form(Schema $schema): Schema
    {
        return PedidosForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PedidosInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PedidosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItensRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPedidos::route('/'),
            'create' => CreatePedidos::route('/create'),
            'view' => ViewPedidos::route('/{record}'),
            'edit' => EditPedidos::route('/{record}/edit'),
        ];
    }
}
