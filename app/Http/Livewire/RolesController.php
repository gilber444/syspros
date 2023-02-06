<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;


class RolesController extends Component
{
    use WithPagination;

    public $name, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $roles = Role::where('name', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }
        else
        {
            $roles = Role::orderBy('name', 'asc')->paginate($this->pagination);
        }

        return view('livewire.roles.roles', ['roles' => $roles])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function CreateRole()
    {
        $rules = ['name' => 'required|min:2|unique:roles,name'];

        $messages = [
            'name.required' => 'El nombre del rol es requerido',
            'name.unique' => 'El Rol ya existe',
            'name.min' => 'El Rol debe tener al menos dos caracteres'
        ];
        $this->validate($rules, $messages);

        Role::create(['name' => $this->name]);

        $this->emit('item-added', 'Se registro el rol con exito');
        $this->resetUI();
    }

    public function Edit(Role $role)
    {
        $this->selected_id = $role->id;
        $this->name = $role->name;

        $this->emit('show-modal','Editar Rol');
    }

    public function UpdateRole()
    {
        $rules = ['name' => 'required|min:2'];

        $messages = [
            'name.required' => 'El nombre del rol es requerido',
            'name.min' => 'El Rol debe tener al menos dos caracteres'
        ];
        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->name;
        $role->save();

        $this->emit('item-update', 'Se actualizo el rol con exito');
        $this->resetUI();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();

        if($permissionsCount > 0)
        {
            $this->emit('item-error', 'No se puede eliminar el rol porque tiene permisos asociados');
            return;
        }

        Role::find($id)->delete();
        $this->emit('item-deleted', 'Se elimino el rol con exito');
        $this->resetUI();
    }

    public function resetUI()
    {
        $this->name = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
    }
}
