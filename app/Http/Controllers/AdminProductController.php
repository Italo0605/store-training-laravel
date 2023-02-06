<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products', compact('products')); //o campact pega o valor de uma variavel que tenha o mesmo nome que uma string
    }

    //Mostrar a pagina de editar
    public function edit(Product $product){
        return view('admin.productEdit', [
            'product' => $product
        ]);
    }

    //Recebe a requisição para dar update PUT
    public function update(ProductStoreRequest $request, Product $product){
        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        if(!empty($input['cover']) && $input['cover']->isValid()){
            Storage::delete($product->cover ?? '' );
            $file = $input['cover'];
            $path = $file->store('products');
            $input['cover'] = $path;
        }
        $product->fill($input);
        $product->save();
        return Redirect::route('admin.product');
    }


    //Mostrar pagina e criar
    public function create(){
        return view('admin.productCreate');
        
    }

    // receber requisição de criar POST
    public function store(ProductStoreRequest $request){

        $input = $request->validated();
        $input['slug'] = Str::slug($input['name']);

        if(!empty($input['cover']) && $input['cover']->isValid()){
            
            $file = $input['cover'];
            $path = $file->store('products');
            $input['cover'] = $path;
        }
        Product::create($input);
        return Redirect::route('admin.product');
    }

    public function delete(Product $product){
        $product->delete();
        Storage::delete($product->cover ?? '');
        return Redirect::route('admin.product');
    }
    public function deleteImage(Product $product){
        Storage::delete($product->cover ?? '' );
        $product->cover = null;
        $product->save();
        return Redirect::back();
    }
}
