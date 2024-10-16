<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    protected $guarded = [];
    use HasFactory;

    final public function prepareProduct(Request $request):array{
        return[
            "name"=>$request->input('name'),
            "description"=>$request->input('description'),
        ];
    }
    final public function productStore(Request $request):Model{
        return self::query()->create($this->prepareProduct($request));
    }

    final public function productUpdate(Request $request,Product|Model $product){
        return $product->update($this->prepareProduct($request));
    }

    final public function deleteProduct(Product $product){
        return $product->forceDelete();
    }
}
