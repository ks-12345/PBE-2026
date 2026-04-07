<?php

namespace App\Filament\Resources\Permissions;

use App\Filament\Resources\Permissions\Pages\CreatePermission;
<<<<<<< HEAD
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
=======
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
use App\Filament\Resources\Permissions\Pages\EditPermission;
use App\Filament\Resources\Permissions\Pages\ListPermissions;
use App\Filament\Resources\Permissions\Pages\ViewPermission;
use App\Filament\Resources\Permissions\Schemas\PermissionForm;
use App\Filament\Resources\Permissions\Schemas\PermissionInfolist;
use App\Filament\Resources\Permissions\Tables\PermissionsTable;
<<<<<<< HEAD
use Spatie\Permission\Models\Permission;
=======
use App\Models\Permission;
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
<<<<<<< HEAD
use Filament\Widgets\StatsOverviewWidget\Stat;
use PhpParser\Node\Stmt\Static_;
use UnitEnum;
=======
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Permissões';

<<<<<<< HEAD
    protected static ?string $modelLabe = 'Criar Permissao';

    protected static ?string $pluralModelLabel = 'Permissões';
    protected static string|UnitEnum|null $navigationGroup = 'Administração';

    public static function form(Schema $schema): Schema
    {
        // return PermissionForm::configure($schema);
        return $schema
            ->schema([
                \Filament\Forms\Components\TextInput::make('name')
                    ->label('Nome da Permissão')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->columnSpanFull(),

                \Filament\Forms\Components\TextInput::make('guard_name')
                    ->label('Nivel da Permissão')
                    ->required()
                    // ->maxLength(20)
                    ->columnSpanFull(),
            ]);
=======
    public static function form(Schema $schema): Schema
    {
        return PermissionForm::configure($schema);
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
    }

    public static function infolist(Schema $schema): Schema
    {
        return PermissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
<<<<<<< HEAD
        // return PermissionsTable::configure($table);
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Nome da Permissão')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('guard_name')
                    ->label('Nivel da Permissão')
                    ->searchable(),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
=======
        return PermissionsTable::configure($table);
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
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
            'index' => ListPermissions::route('/'),
            'create' => CreatePermission::route('/create'),
            'view' => ViewPermission::route('/{record}'),
            'edit' => EditPermission::route('/{record}/edit'),
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 5f54b34fedc523717f40e35a62a33d9cc716c1d4
