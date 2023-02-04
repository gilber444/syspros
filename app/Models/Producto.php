<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['barcode', 'producto', 'marca', 'costo', 'pv1', 'cant1', 'pv2', 'cant2', 'pv3', 'cant3', 'pv4', 'cant4', 'exento', 'stock', 'alerts', 'img', 'medida_id', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getImagenAttribute()
    {
        if($this->img != null)
        {
            return(file_exists('storage/productos/' . $this->img) ? $this->img : 'noimagen.png');
        }
        else
        {
            return 'noimagen.png';
        }

    }
}
