<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Component;

class StatisticComponent extends Component
{
    public $statistic = 'Today';
    public $statistics;
    public $earning = 0;
    public $orders = 0;
    public $newUsers = 0;
    public $inShoppingCart = 0;

    public function mount()
    {
        $this->setToday();
    }
    public function render()
    {
        return view('livewire.dashboard.statistic-component');
    }

    private function setToday()
    {
        $invoiceStats = Invoice::whereDate('created_at', today())
            ->where(['payment_status' => '1'])
            ->get();
        $userStats = User::whereDate('created_at', today())->get();
        $this->earning = 0;
        $this->orders = 0;
        $this->newUsers = 0;
        foreach ($invoiceStats as $stat) {
            $this->earning += $stat->totalPrice;
            $this->orders += 1;
        }
        foreach ($userStats as $stat) {
            $this->newUsers += 1;
        }
    }

    public function today()
    {
        $this->setToday();
        $this->statistic = 'Today';
    }

    public function thisWeek()
    {
        $this->statistic = 'This Week';

        $startOfWeek = now()
            ->startOfWeek()
            ->toDateString();
        $endOfWeek = now()
            ->endOfWeek()
            ->toDateString();
        $invoiceStats = Invoice::whereDate('created_at', '>=', $startOfWeek)
            ->whereDate('created_at', '<=', $endOfWeek)
            ->where(['payment_status' => '1']) // payment_status = 1 means paid
            ->get();

        $userStats = User::whereDate('created_at', '>=', $startOfWeek)
            ->whereDate('created_at', '<=', $endOfWeek)
            ->get();

        $this->earning = 0;
        $this->orders = 0;
        $this->newUsers = 0;

        foreach ($invoiceStats as $stat) {
            $this->earning += $stat->totalPrice;
            $this->orders += 1;
        }

        foreach ($userStats as $stat) {
            $this->newUsers += 1;
        }
    }

    public function thisMonth()
    {
        $this->statistic = 'This Month';

        $startOfMonth = now()
            ->startOfMonth()
            ->toDateString();
        $endOfMonth = now()
            ->endOfMonth()
            ->toDateString();
        $invoiceStats = Invoice::whereDate('created_at', '>=', $startOfMonth)
            ->whereDate('created_at', '<=', $endOfMonth)
            ->where(['payment_status' => '1'])
            ->get();

        $userStats = User::whereDate('created_at', '>=', $startOfMonth)
            ->whereDate('created_at', '<=', $endOfMonth)
            ->get();

        $this->earning = 0;
        $this->orders = 0;
        $this->newUsers = 0;

        foreach ($invoiceStats as $stat) {
            $this->earning += $stat->totalPrice;
            $this->orders += 1;
        }

        foreach ($userStats as $stat) {
            $this->newUsers += 1;
        }
    }

    public function thisYear()
    {
        $this->statistic = 'This Year';
        $startOfYear = now()
            ->startOfYear()
            ->toDateString();
        $endOfYear = now()
            ->endOfYear()
            ->toDateString();
        $invoiceStats = Invoice::whereDate('created_at', '>=', $startOfYear)
            ->whereDate('created_at', '<=', $endOfYear)
            ->where(['payment_status' => '1'])
            ->get();

        $userStats = User::whereDate('created_at', '>=', $startOfYear)
            ->whereDate('created_at', '<=', $endOfYear)
            ->get();

        $this->earning = 0;
        $this->orders = 0;
        $this->newUsers = 0;

        foreach ($invoiceStats as $stat) {
            $this->earning += $stat->totalPrice;
            $this->orders += 1;
        }

        foreach ($userStats as $stat) {
            $this->newUsers += 1;
        }
    }

    public function allTime()
    {
        $this->statistic = 'All Time';
        $invoiceStats = Invoice::where(['payment_status' => '1'])
            ->get();

        $userStats = User::get();

        $this->earning = 0;
        $this->orders = 0;
        $this->newUsers = 0;

        foreach ($invoiceStats as $stat) {
            $this->earning += $stat->totalPrice;
            $this->orders += 1;
        }

        foreach ($userStats as $stat) {
            $this->newUsers += 1;
        }
    }
}
