<?php

namespace App\Filament\Pages;

use App\Livewire\CategoryResultBarChart;
use App\Models\Category;
use Filament\Pages\Page;

class BarCharts extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.bar-charts';

    protected function getHeaderWidgets(): array
    {
        /* return [
            CategoryResultChart::make([
                'category' => Category::first(),
            ]),
        ]; */
        return $this->getCategoryResultChart();
    }

    public function getCategoryResultChart()
    {
        $categories = Category::all();
        $data = [];
        foreach($categories as $category)
        {
            $data[] = CategoryResultBarChart::make([
                'category' => $category,
            ]);
        }
        return $data;
    }

    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 1;
    }
}
