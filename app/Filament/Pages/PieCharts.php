<?php

namespace App\Filament\Pages;

use App\Livewire\CategoryResultPieChart;
use App\Models\Category;
use Filament\Pages\Page;

class PieCharts extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.pie-charts';

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
            $data[] = CategoryResultPieChart::make([
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
        return 2;
    }
}
