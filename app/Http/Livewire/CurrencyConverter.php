<?php

namespace App\Http\Livewire;

use App\Helpers\HelpersInventario;
use App\Models\Empresa;
use Livewire\Component;

class CurrencyConverter extends Component
{

    public $usd;
    public $bolivares;
    public $exchangeRate;
    // Ejemplo de tasa de cambio
    public $result_bs = 0;
    public $result_usd = 0;

    public function mount()
    {
        $TASA = Empresa::first()->precio_dolar;
        $this->exchangeRate = $TASA;
    }
    public function convertToBolivares()
    {

        $this->result_bs = number_format(HelpersInventario::convertir($this->usd));
    }

    public function convertToUsd()
    {
        $this->result_usd = HelpersInventario::convertir_BS($this->bolivares);
    }
    public function render()
    {
        return view('livewire.currency-converter');
    }
}
