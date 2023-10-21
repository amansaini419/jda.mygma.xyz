<?php

namespace App\Repositories;

use App\Interfaces\VotingRepositoryInterface;
use App\Models\Voting;
use Carbon\Carbon;

class VotingRepository implements VotingRepositoryInterface
{
    public function getVotingStatus(): string
    {
        $voting = Voting::latest()
            ->first();

        if(!$voting){
            return 'voitng inactive';
        }

        $startDate = Carbon::parse($voting->start_date);
        $endDate = Carbon::parse($voting->end_date);
        $dateNow = Carbon::now();

        if($dateNow < $startDate){
            return 'voting not started';
        }
        if($dateNow > $endDate){
            return 'voting closed';
        }
        return 'voting active';

        //dd($startDate <= $dateNow && $dateNow <= $endDate, $startDate, $endDate, $dateNow);
        /* if($startDate <= $dateNow && $dateNow <= $endDate)
        {
            return true;
        }
        return false; */

    }
}