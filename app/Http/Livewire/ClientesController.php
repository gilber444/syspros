<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Clientes;
use Livewire\WithPagination;

class ClientesController extends Component
{
    use WithPagination;

    public  $nombreCliente, $dui, $nit, $homologado, $registro, $giro, $direccion, $telefono, $tipo = 'CLIENTE', $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 7;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Clientes';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Clientes::where('nombreCliente', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Clientes::orderBy('nombreCliente', 'asc')->paginate($this->pagination);

        return view('livewire.clientes.clientes', ['clientes' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        $rules = [
            'nombreCliente' => 'required|unique:clientes|min:3'
        ];

        $messages = [
            'nombreCliente.required' => 'Nombre del Cliente es requerido',
            'nombreCliente.unique' => 'Ya existe el nombre del Cliente',
            'nombreCliente.min'=> 'El Nombre del Cliente debe tener mas de 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $cliente = Clientes::create([
            'nombreCliente' => $this->nombreCliente,
            'dui' => $this->dui,
            'nit' => $this->nit,
            'homologado' => $this->homologado,
            'registro' => $this->registro,
            'giro' => $this->giro,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'tipo' => $this->tipo
        ]);

        $this->resetUI();
        $this->emit('item-added', 'Cliente registrado');
    }

    public function Edit($id)
    {
        $record = Clientes::find($id);
        $this->nombreCliente = $record->nombreCliente;
        $this->dui = $record->dui;
        $this->nit = $record->nit;
        $this->homologado = $record->homologado;
        $this->registro = $record->registro;
        $this->giro = $record->giro;
        $this->direccion = $record->direccion;
        $this->telefono = $record->telefono;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show modal');
    }

    public function resetUI()
    {
        $this->nombreCliente = '';
        $this->dui = '';
        $this->nit = '';
        $this->homologado = 'SI';
        $this->registro = '';
        $this->giro = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    public function Update()
    {
        $rules = [
            'nombreCliente' => 'required|min:3'
        ];

        $messages = [
            'nombreCliente.required' => 'Nombre del Cliente es requerido',
            'nombreCliente.min'=> 'El Nombre del Cliente debe tener mas de 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $cliente = Clientes::find($this->selected_id);
        $cliente->update([
            'nombreCliente' => $this->nombreCliente,
            'dui' => $this->dui,
            'nit' => $this->nit,
            'homologado' => $this->homologado,
            'registro' => $this->registro,
            'giro' => $this->giro,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono
        ]);
        $this->resetUI();
        $this->emit('item-updated', 'Cliente Actualizado');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Clientes $cliente /*$id*/)
    {
        $cliente->delete();

        $this->resetUI();
        $this->emit('item-deleted', 'Cliente Eliminada');
    }
}
