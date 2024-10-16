<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    final public function prepare_data(Request $request):array
    {
        return [
           "name" => $request->input('name'),
           "description" => $request->input('description'),
        ];
    }

    final public function storeCategory(Request $request): Model
    {
        return self::query()->create($this->prepare_data($request));
    }

    final public function updateCategory(Request $request, Category|Model $category)
    {
        return $category->update($this->prepare_data($request));
    }
    
    final public function deleteCategory(Category $category): bool
    {
        return $category->forceDelete();
    }



}
