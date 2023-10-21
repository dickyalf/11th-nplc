<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Invoice;
use Livewire\Component;

class ChartsComponent extends Component
{
    public $chart = '';
    public $earningTotal = 0;
    public $earningCount = 0;
    public $earningChart = [
        'title' => ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
        'value' => [0, 0, 0, 0, 0, 0, 0],
    ];

    public function mount()
    {
        $this->chart = "Select One";
        //$this->setEarningChartWeek();
    }

    public function dehydrate()
    {
        $this->dispatchBrowserEvent('renderChart', $this->earningChart);
    }

    public function render()
    {
        return view('livewire.dashboard.charts-component');
    }

    private function setEarningChartWeek()
    {
        $this->chart = 'This Week';
        $this->earningTotal = 0;
        $this->earningCount = 0;
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $daysOfWeek = [];

        // Generate the days of the week labels
        for ($date = $startOfWeek; $date <= $endOfWeek; $date = $date->addDay()) {
            $daysOfWeek[] = $date->format('D');
        }

        // Retrieve invoice statistics for the current week
        $invoiceStats = Invoice::whereDate('created_at', '>=', now()->startOfWeek())
            ->whereDate('created_at', '<=', $endOfWeek)
            ->where(['payment_status' => '1'])
            ->get();

        // Initialize the values array with zeros
        $values = array_fill(0, 7, 0);

        // Update the values array with the earnings for each day
        foreach ($invoiceStats as $stat) {
            $dayOfWeekIndex = $stat->created_at->format('w');
            $values[$dayOfWeekIndex] += $stat->totalPrice;
            $this->earningTotal += $stat->totalPrice;
            $this->earningCount += 1;
        }

        $this->earningChart = [
            'title' => $daysOfWeek,
            'value' => $values,
        ];
    }

    public function week()
    {
        $this->setEarningChartWeek();
        $this->dispatchBrowserEvent('renderChart', $this->earningChart);
    }
    public function setEarningChartMonth()
    {
        $this->chart = 'This Month';
        $this->earningTotal = 0;
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $values = [];

        // Split the month into weeks
        $weeks = ceil($endOfMonth->diffInDays($startOfMonth) / 7);

        // Retrieve invoice statistics for each week of the current month
        for ($week = 1; $week <= $weeks; $week++) {
            $weekStartDate = $startOfMonth->addWeek()->startOfWeek();
            $weekEndDate = $weekStartDate->copy()->endOfWeek();

            $weekEarnings = Invoice::whereDate('created_at', '>=', $weekStartDate)
                ->whereDate('created_at', '<=', $weekEndDate)
                ->where(['payment_status' => '1'])
                ->sum('price');

            $this->earningTotal += $weekEarnings;

            $values[] = $weekEarnings;
        }

        $this->earningChart = [
            'title' => $this->generateWeekLabels($weeks),
            'value' => $values,
        ];
    }

    public function generateWeekLabels($weeks)
    {
        $weekLabels = [];

        for ($i = 1; $i <= $weeks; $i++) {
            $weekLabels[] = "Week $i";
        }

        return $weekLabels;
    }

    public function month()
    {
        $startOfMonth = now()
            ->startOfMonth()
            ->toDateString();
        $endOfMonth = now()
            ->endOfMonth()
            ->toDateString();
        $this->earningCount = Invoice::whereDate('created_at', '>=', $startOfMonth)
            ->whereDate('created_at', '<=', $endOfMonth)
            ->where(['payment_status' => '1'])
            ->count();
        $this->setEarningChartMonth();
        $this->dispatchBrowserEvent('renderChart', $this->earningChart);
    }
}
