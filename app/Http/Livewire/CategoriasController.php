<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithPagination;

class CategoriasController extends Component
{
    use WithPagination;

    public  $categoria, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 7;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Categoria::where('categoria', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $data = Categoria::orderBy('categoria', 'asc')->paginate($this->pagination);

        return view('livewire.categorias.categorias', ['categorias' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        $rules = [
            'categoria' => 'required|unique:categorias|min:3'
        ];

        $messages = [
            'categoria.required' => 'Nombre de la Categoria es requerido',
            'categoria.unique' => 'Ya existe el nombre de la categoria',
            'categoria.min'=> 'El Nombre de la categoria debe tener mas de 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $category = Categoria::create(['categoria' => $this->categoria]);

        $this->resetUI();
        $this->emit('item-added', 'Categoria registrada');
    }

    public function Edit($id)
    {
        $record = Categoria::find($id);
        $this->categoria = $record->categoria;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show modal');
    }

    public function resetUI()
    {
        $this->categoria = '';
        $this->search = '';
        $this->selected_id = 0;
    }

    public function Update()
    {
        $rules = [
            'categoria' => 'required|unique:categorias|min:3'
        ];

        $messages = [
            'categoria.required' => 'Nombre de la Categoria es requerido',
            'categoria.unique' => 'Ya existe el nombre de la categoria',
            'categoria.min'=> 'El Nombre de la categoria debe tener mas de 3 caracteres'
        ];

        $this->validate($rules, $messages);
        $category = Categoria::find($this->selected_id);
        $category->update([
            'categoria' => $this->categoria
        ]);
        $this->resetUI();
        $this->emit('item-updated', 'Categoria Actualizada');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Categoria $category /*$id*/)
    {
        $category->delete();

        $this->resetUI();
        $this->emit('item-deleted', 'Categoria Eliminada');
    }
}
