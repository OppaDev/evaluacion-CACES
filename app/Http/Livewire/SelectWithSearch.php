<?php
namespace App\Http\Livewire;

use Livewire\Component;

class SelectWithSearch extends Component
{
    public $search = '';
    public $items = []; // Lista completa de elementos
    public $filteredItems = [];

    public function mount()
    {
        // Inicializa tu lista de elementos
        $this->items = [
            'Elemento 1',
            'Elemento 2',
            'Elemento 3',
            'Elemento 4',
            'Elemento 5',
            // Agrega más elementos según sea necesario
        ];

        $this->filteredItems = $this->items; // Inicialmente, muestra todos los elementos
    }

    public function updatedSearch()
    {
        $this->filteredItems = collect($this->items)->filter(function ($item) {
            return stripos($item, $this->search) !== false; // Filtra según la búsqueda
        })->values()->all();
    }

    public function render()
    {
        return view('livewire.select-with-search');
    }
}
