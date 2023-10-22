<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoteResource\Pages;
use App\Filament\Resources\VoteResource\RelationManagers;
use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class VoteResource extends Resource
{
    protected static ?string $model = Voter::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Votes';

    /* public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    } */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('S.N.')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('user_name')
                    ->label('Voter')
                    ->extraAttributes(['class' => 'capitalize'])
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominee_name')
                    ->label('Nominee')
                    ->extraAttributes(['class' => 'capitalize'])
                    ->searchable()
                    ->sortable(),
                /* Tables\Columns\TextColumn::make('nominee_id.category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(), */
                Tables\Columns\TextColumn::make('voting_date')
                    ->searchable()
                    ->sortable()
                    ->dateTime('d-M-Y h:i a'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                /* Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]), */
            ])
            ->emptyStateActions([
                //Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVotes::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        /* dd(User::query()
        ->join('votes', 'votes.user_id', 'users.id')
        ->join('nominees', 'nominees.id', 'votes.nominee_id')
        ->select('users.name AS user_name', 'nominees.name AS nominee_name', 'votes.voting_date')
        ->orderBy('votes.voting_date', 'desc')); */
        return User::query()
                ->join('votes', 'votes.user_id', 'users.id')
                ->join('nominees', 'nominees.id', 'votes.nominee_id')
                ->select('users.*', 'users.name AS user_name', 'nominees.name AS nominee_name', 'nominees.id AS nominee_id', 'votes.voting_date')
                ->orderBy('votes.voting_date', 'desc');
    }
}
