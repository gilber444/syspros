<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Medidas;
use Livewire\Component;
use App\Models\Producto;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

use function Ramsey\Uuid\v1;

class ProductosController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public  $producto, $search, $selected_id, $pageTitle, $componentName, $barcode, $exento, $marca, $costo, $stock, $alerts, $categoriaId, $pv1, $cant1, $pv2, $cant2, $medidaId, $pv3, $cant3, $pv4, $cant4, $image;

    private $pagination = 7;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->categoriaId = 'Elegir Categoria';
        $this->medidaId = 'Elegir Unidad Medida';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Producto::join('categorias as c', 'c.id', 'productos.categoria_id')
            ->join('medidas as m', 'm.id', 'productos.medidas_id')
            ->select('productos.*', 'c.categoria as categoria', 'm.medida')
            ->where('productos.producto', 'like', '%' . $this->search . '%')
            ->orWhere('productos.barcode', 'like', '%' . $this->search . '%')
            ->orWhere('c.categoria', 'like', '%' . $this->search . '%')
            ->orderBy('productos.producto', 'asc')
            ->paginate($this->pagination);
        else
            $data = Producto::join('categorias as c', 'c.id', 'productos.categoria_id')
            ->join('medidas as m', 'm.id', 'productos.medidas_id')
            ->select('productos.*', 'c.categoria as categoria', 'm.medida')
            ->orderBy('productos.producto', 'asc')
            ->paginate($this->pagination);

        return view('livewire.productos.productos', ['productos' => $data, 'categorias' => Categoria::orderBy('categoria', 'asc')->get(), 'medidas' => Medidas::orderBy('medida', 'asc')->get()])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store()
    {
        $rules = [
            'producto' => 'required|unique:productos|min:3',
            'costo' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'categoriaId' => 'required|not_in:Elegir Categoria',
            'pv1' => 'required',
            'cant1' => 'required',
            'medidaId' => 'required|not_in:Elegir Unidad Medida'
        ];
        $messages = [
            'name.required' => 'Nombre del producto requerido',
            'name.unique' => 'Ya existe el nombre del Producto',
            'name.min' => 'El nombre del producto tiene que tener al menos 3 caracteres',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingrese el valor minimo en existencia',
            'categoryId.not_in' => 'Elige un nombre de categoria diferente de Elegir',
            'pv1.required' => 'El precio de venta 1 es requerido',
            'cantidad.required' => 'la cantidad 1 del precio de venta es requerido',
            'medidaId.not_in' => 'Elige un nombre de Unidad de medida diferente de Elegir'

        ];

        $this->validate($rules, $messages);

        $product = Producto::create([
            'barcode' => $this->barcode,
            'producto' => $this->producto,
            'marca' => $this->marca,
            'costo' => $this->costo,
            'pv1' => $this->pv1,
            'cant1' => $this->cant1,
            'pv2' => $this->pv2,
            'cant2' => $this->cant2,
            'pv3' => $this->pv3,
            'cant3' => $this->cant3,
            'pv4' => $this->pv4,
            'cant4' => $this->cant4,
            'exento' => $this->exento,
            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'medidas_id' => $this->medidaId,
            'categoria_id' => $this->categoriaId,
        ]);

        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/productos', $customFileName);
            $product->img = $customFileName;
            $product->save();
        }

        $this->resetUI();
        $this->emit('item-added', 'Producto registrado');
    }

    public function Edit(Producto $product)
    {
        $this->selected_id = $product->id;
        $this->producto = $product->producto;
        $this->barcode = $product->barcode;
        $this->costo = $product->costo;
        $this->pv1 = $product->pv1;
        $this->stock = $product->stock;
        $this->alerts = $product->alerts;
        $this->categoriaId = $product->categoria_id;
        $this->medidaId = $product->medidas_id;
        $this->exento = $product ->exento;
        $this->marca = $product->marca;
        $this->cant1 = $product->cant1;
        $this->pv2 = $product->pv2;
        $this->cant2 = $product->cant2;
        $this->pv3 = $product->pv3;
        $this->cant3 = $product->cant3;
        $this->pv4 = $product->pv4;
        $this->cant4 = $product->cant4;
        $this->image = null;

        $this->emit('show-modal', 'Show Modal');
    }

    public function Update(Producto $product)
    {
        $rules = [
            'producto' => 'required|min:3',
            'costo' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'categoriaId' => 'required|not_in:Elegir Categoria',
            'pv1' => 'required',
            'cant1' => 'required',
            'medidaId' => 'required|not_in:Elegir Unidad Medida'
        ];
        $messages = [
            'name.required' => 'Nombre del producto requerido',
            'name.min' => 'El nombre del producto tiene que tener al menos 3 caracteres',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingrese el valor minimo en existencia',
            'categoryId.not_in' => 'Elige un nombre de categoria diferente de Elegir',
            'pv1.required' => 'El precio de venta 1 es requerido',
            'cantidad.required' => 'la cantidad 1 del precio de venta es requerido',
            'medidaId.not_in' => 'Elige un nombre de Unidad de medida diferente de Elegir'

        ];

        $this->validate($rules, $messages);

        $product = Producto::find($this->selected_id);
        $product->update([
            'barcode' => $this->barcode,
            'producto' => $this->producto,
            'marca' => $this->marca,
            'costo' => $this->costo,
            'pv1' => $this->pv1,
            'cant1' => $this->cant1,
            'pv2' => $this->pv2,
            'cant2' => $this->cant2,
            'pv3' => $this->pv3,
            'cant3' => $this->cant3,
            'pv4' => $this->pv4,
            'cant4' => $this->cant4,
            'exento' => $this->exento,
            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'medidas_id' => $this->medidaId,
            'categoria_id' => $this->categoriaId
        ]);

        if($this->image)
        {
            $customFileName = uniqid(). '_.' . $this->image->extension();
            $this->image->storeAs('public/productos', $customFileName);
            $imageTemp = $product->img; //imagen aterior
            $product->img = $customFileName;
            $product->save();

            if($imageTemp !=null)
            {
                if(file_exists('storage/productos' . $imageTemp))
                {
                    unlink('storage/productos' . $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('item-updated', 'Producto Actualizado');
    }

    public function resetUI()
    {
        $this->producto = '';
        $this->barcode = '';
        $this->costo = '';
        $this->pv1 = '';
        $this->pv2 = '';
        $this->pv3 = '';
        $this->pv4 = '';
        $this->cant1 = '';
        $this->cant2 = '';
        $this->cant3 = '';
        $this->cant4 = '';
        $this->stock = '';
        $this->alerts = '';
        $this->categoriaId = 'Elegir Categoria';
        $this->medidaId = 'Elegir Unidad Medida';
        $this->marca = '';
        $this->exento = 'No';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Producto $product)
    {
        $imageTemp = $product->img;
        $product->delete();

        if($imageTemp !=null)
        {
            if(file_exists('storage/productos' . $imageTemp))
            {
                unlink('storage/productos' . $imageTemp);
            }
        }

        $this->resetUI();
        $this->emit('item-deleted', 'Producto Eliminado');
    }
}
