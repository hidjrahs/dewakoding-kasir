<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class OrderList extends Component
{
    use WithPagination;

    protected $listeners=['setDate'];
    public $search = '';
    public $perPage = 5;
    public $dateRange;

    public function setDate($date){
        $this->dateRange = $date;
    }

    public function mount()
    {
        $this->dateRange = date('d/m/Y', strtotime('first day of this month')) . " - " . date('d/m/Y');
    }

    public function render()
    {
        $range = explode(' - ', $this->dateRange);
        $r1 = explode('/',$range[0]);
        $t1 = date($r1[2]."-".$r1[1]."-".$r1[0]);
        $r2 = explode('/',$range[1]);
        $t2 = date($r2[2]."-".$r2[1]."-".$r2[0]);
        return view('livewire.order-list', [
            'orders' => Order::search($this->search)
                        ->whereNotNull('done_at')
                        ->whereDate('done_at','>=',$t1)
                        ->whereDate('done_at','<=',$t2)
                        ->orderBy('done_at', 'DESC')
                        ->paginate($this->perPage)
        ]);
    }
}
