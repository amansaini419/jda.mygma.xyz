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
                Tables\Columns\TextColumn::make('voter.fullname')
                    ->label('Voter Name')
                    ->extraAttributes(['class' => 'capitalize'])
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('voter.mdc_number')
                    ->label('MDC number')
                    ->searchable(['voters.mdc_number'])
                    ->sortable(['voters.mdc_number']),
                Tables\Columns\TextColumn::make('nominee_name')
                    ->label('Nominee Name')
                    ->extraAttributes(['class' => 'capitalize'])
                    ->searchable(['nominees.name'])
                    ->sortable(['nominees.name']),
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
                //->join('voters', 'voters.user_id', 'users.id')
                ->select('users.*', 'nominees.name AS nominee_name', 'nominees.id AS nominee_id', 'votes.voting_date')
                ->orderBy('votes.voting_date', 'desc');
    }
}
