<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Sale;

class UsuariosController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $phone, $email, $status, $image, $password, $fileLoeaded, $search, $selected_id, $pageTitle, $componentName, $profile;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
    }

    public function render()
    {
        if(strLen($this->search) > 0)
            $data = User::where('name', 'like', '%' . $this->search . '%')->select('*')->orderBy('name', 'asc')->paginate($this->pagination);
        else
            $data = User::select('*')->orderBy('name', 'asc')->paginate($this->pagination);

        return view('livewire.usuarios.usuarios',[
            'data' => $data,
            'roles' => Role::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->image = '';
        $this->status = 'Elegir';
        $this->search = '';
        $this->profile = 'Elegir';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password = '';

        $this->emit('show-modal', 'open');
    }
    protected $listeners = [
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Ingrese el Nombre',
            'name.min' => 'el nombre de usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingrese el Email',
            'email.email' => 'Ingresa un email Valido',
            'email.unique' => 'El email ya esta registrado',
            'status.required' => 'Selecciona el estatus del usuario',
            'status.not_in' => 'Selecciona un estatus diferente de Elegir',
            'profile.required' => 'Selecciona el perfil/role del usuario',
            'profile.not_in' => 'Selecciona un perfil/role diferente de Elegir',
            'password.required' => 'Ingrese el Password',
            'password.min' => 'El password debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile' => $this->profile,
            'status' => $this->status,
            'password' => bcrypt($this->password)
        ]);

        $user->syncRoles($this->profile);

        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();

            $this->resetUI();
            $this->emit('user-added', 'Usuario Registrado');
        }
    }

    public function Update(User $user)
    {
        $rules = [
            'email' => "required|email|unique:users,email,{{$this->selected_id}}",
            'name' => 'required|min:3',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:3'
        ];

        $messages = [
            'name.required' => 'Ingrese el Nombre',
            'name.min' => 'el nombre de usuario debe tener al menos 3 caracteres',
            'email.required' => 'Ingrese el Email',
            'email.email' => 'Ingresa un email Valido',
            'email.unique' => 'El email ya esta registrado',
            'status.required' => 'Selecciona el estatus del usuario',
            'status.not_in' => 'Selecciona un estatus diferente de Elegir',
            'profile.required' => 'Selecciona el perfil/role del usuario',
            'profile.not_in' => 'Selecciona un perfil/role diferente de Elegir',
            'password.required' => 'Ingrese el Password',
            'password.min' => 'El password debe tener al menos 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password)
        ]);

        $user->syncRoles($this->profile);

        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imagetemp = $user->image;
            $user->image = $customFileName;
            $user->save();

            if($imagetemp !=null)
            {
                if(file_exists('storage/users/' . $imagetemp)){
                    unlink('storage/users/' . $imagetemp);
                }
            }


            $this->resetUI();
            $this->emit('user-updated', 'Usuario Actualizado');
        }
    }

    public function destroy(User $user)
    {
        if($user)
        {
            $sales = Sale::Where('user_id', $user->id)->count();

            if($sales > 0)
            {
                $this->emit('user-withsales', 'No esposible elimier el usuario porque tiene ventas realizadas');
            }
            else
            {
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted', 'Usuario Eliminado');
            }
        }
    }
}
