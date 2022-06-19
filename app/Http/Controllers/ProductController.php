<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    public function simpan()
    {
        $simpan= new Product();
        $simpan->name=request()->name;
        $simpan->price=request()->price;
        $simpan->color=request()->color;
        $simpan->status=request()->status;
        $simpan->save();

        return response()->json(['message'=>'Data berhasil ditambah']);

    }
    public function ambil(){
        $data=Product::all();
        return response()->json($data); 
    }

    public function hapusProduct($id){
        $cari=Product::find($id);
        $cari->delete();
        return response()->json([
            'message'=>'Data berhasil dihapus'
        ]
            
        );
    }

    public function ambilDataUpdate($id){
        $cari=Product::find($id);
        return response()->json($cari);
    }

    public function updateProduct(){
        $product=Product::find(request()->id);
        $product->name=request()->name;
        $product->price=request()->price;
        $product->color=request()->color;
        $product->status=request()->status;
        $product->update();
        return response()->json([
            'message'=>'Data berhasil dihapus'
        ]
            
        );
    }
    public function showDataProduct($id){
        $cari=Product::find($id);
        return response()->json($cari);
    }
     public function cariStatus(){
     
        $cari=Product::where('status','non-active')->get();
       
        return response()->json($cari);
    }
}
