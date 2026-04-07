<?php

namespace App\Filament\Resources\Roles;

use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Filament\Resources\Roles\Pages\ViewRole;
use App\Filament\Resources\Roles\Schemas\RoleForm;
use App\Filament\Resources\Roles\Schemas\RoleInfolist;
use App\Filament\Resources\Roles\Tables\RolesTable;
<<<<<<< HEAD
use Spatie\Permission\Models\Role;
use App\Models\User;
=======
use App\Models\Role;
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

<<<<<<< HEAD
public static function canAccess(): bool
{
    $user = Auth::user();

    if (! $user instanceof User) {
        return false;
    }

    return $user->hasRole('Estoque')
        && $user->can('Admin');
}

=======
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Cargos e Funções';

    public static function form(Schema $schema): Schema
    {
<<<<<<< HEAD
        return $schema
        ->schema([
            \Filament\Forms\Components\TextInput::make('name')
                ->label('Cargo')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255)
                ->columnSpanFull(),

            \Filament\Forms\Components\Select::make('permissions')
                ->label('Permissões de acesso')
                ->multiple()
                ->relationship('permissions', 'name')
                ->columnSpanFull(),
        ]);
=======
        return RoleForm::configure($schema);
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
    }

    public static function infolist(Schema $schema): Schema
    {
        return RoleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view' => ViewRole::route('/{record}'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
