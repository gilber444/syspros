<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Medidas;
use Livewire\WithPagination;

class MedidasController extends Component
{
    use WithPagination;

    public  $medida, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 7;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Unidad de Medidas';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Medidas::where('medida', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Medidas::orderBy('medida', 'asc')->paginate($this->pagination);

        return view('livewire.medidas.medidas', ['medidas' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        $rules = [
            'medida' => 'required|unique:medidas|min:3'
        ];

        $messages = [
            'medida.required' => 'Nombre de la U. Medida es requerido',
            'medidas.unique' => 'Ya existe el nombre de la Unidad de Medida',
            'medidas.min'=> 'El Nombre de la Unidad de Medida debe tener mas de 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $medis = Medidas::create(['medida' => $this->medida]);

        $this->resetUI();
        $this->emit('item-added', 'Unidad de Medida Registrada');
    }

    public function Edit($id)
    {
        $record = Medidas::find($id);
        $this->medida = $record->medida;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show modal');
    }

    public function resetUI()
    {
        $this->medida = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    public function Update()
    {
        $rules = [
            'medida' => 'required|unique:medidas|min:3'
        ];

        $messages = [
            'medida.required' => 'Nombre de la Unidad de Medida es requerido',
            'medida.unique' => 'Ya existe el nombre de la Unidad de Medida',
            'medida.min'=> 'El Nombre de la Unidad de Medida debe tener mas de 3 caracteres'
        ];

        $this->validate($rules, $messages);
        $medis = Medidas::find($this->selected_id);
        $medis->update([
            'medida' => $this->medida
        ]);
        $this->resetUI();
        $this->emit('item-updated', 'Unidad de Medida Actualizada');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Medidas $medi /*$id*/)
    {
        $medi->delete();

        $this->resetUI();
        $this->emit('item-deleted', 'Unidad de Medida Eliminada');
    }
}
