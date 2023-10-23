<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Nominee;
use Filament\Widgets\ChartWidget;

class CategoryResultPieChart extends ChartWidget
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

    public function getHeading(): string
    {
        return strtoupper($this->category->name);
    }

    protected function getOptions(): array
    {
        return [
            /* 'scale' => [
                'ticks' => [
                    'precision' => 0,
                ]
            ], */
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }

    protected function getData(): array
    {
        $votingDetails = $this->getNomineesVotesDetails();
        //dd($votingDetails);
        return [
            'datasets' => [
                [
                    'backgroundColor' => $this->backgroundColor,
                    'data' => $votingDetails['votes'],
                    'label' => 'Votes Received',
                ],
            ],
            'labels' => $votingDetails['nominees'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    private function getNomineesVotesDetails(): array
    {
        $nominees = Nominee::where('category_id', $this->category->id)
            ->withCount('voters')
            ->get();
        return [
            'nominees' => $nominees->pluck('name')->toArray(),
            'votes' => $nominees->pluck('voters_count')->toArray(),
        ];
    }
}
