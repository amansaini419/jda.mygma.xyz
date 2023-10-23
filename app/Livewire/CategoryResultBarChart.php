<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Nominee;
use Filament\Widgets\ChartWidget;

class CategoryResultBarChart extends ChartWidget
{
    public Category $category;
    public array $backgroundColor = [
        'rgba(255, 99, 132, 0.7)',
        'rgba(255, 159, 64, 0.7)',
        'rgba(255, 205, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(201, 203, 207, 0.7)'
    ];

    protected static ?string $heading = 'Chart';
    protected static ?string $pollingInterval = '30s';
    protected static ?string $maxHeight = '400px';
    protected static bool $isLazy = true;

    protected function getOptions(): array
    {
        return [
            'scale' => [
                'ticks' => [
                    'precision' => 0,
                ]
            ],
        ];
    }

    public function getHeading(): string
    {
        return strtoupper($this->category->name);
    }

    protected function getData(): array
    {
        $votingDetails = $this->getNomineesVotesDetails();
        //dd($votingDetails);
        return [
            'datasets' => [
                [
                    'backgroundColor' => $this->backgroundColor,
                    'barThickness' => 15,
                    //'borderColor' => $this->backgroundColor,
                    'borderSkipped' => true,
                    'clip' => false,
                    'data' => $votingDetails['votes'],
                    'label' => 'Votes Received',
                ],
            ],
            'labels' => $votingDetails['nominees'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getNomineesVotesDetails(): array
    {
        //dd($this->category->load('nominees.voters'));
        //dd(Nominee::where('category_id', $this->category->id)->withCount('voters')->get());
        $nominees = Nominee::where('category_id', $this->category->id)
            ->withCount('voters')
            ->get();
        //dd($nominees, $nominees->pluck('name')->toArray(), $nominees->pluck('voters_count'));
        return [
            'nominees' => $nominees->pluck('name')->toArray(),
            'votes' => $nominees->pluck('voters_count')->toArray(),
        ];
    }
}
