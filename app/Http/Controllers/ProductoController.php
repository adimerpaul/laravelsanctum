<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Producto::with(['user:id,email,name'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|string|max:255',
            'precio'=>'required|numeric|max:255',
            'cantidad'=>'required|numeric|max:255',
            'photo'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($request->hasFile('photo')){
            $image=$request->file('photo');
            $name=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('imagen'),$name);
            $input=$request->all();
            $input['user_id']=$request->user()->id;
            $input['photo']=$name;
            $producto=Producto::create($input);
//            return response()->json(['res'=>true,'message'=>'insertado correctamente'],200);
            return  $producto;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'=>'required|string',
            'precio'=>'required|numeric',
            'cantidad'=>'required|numeric',
        ]);
        $producto->update($request->all());
//        return response()->json(['res'=>true,'message'=>'modificado'],200);
        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        try {
//            $producto->delete();
//            return $producto;
//        }catch (\Exception $e){
//            return response()->json(['res'=>true,'message'=>$e->getMessage(),200]);
//        }
        $producto=Producto::where('id',$id);
//        return $producto->count();
        if ($producto->count()==0){
            return response()->json(['res'=>true,'message'=>'No se encontro el producto'],200);
        }else{
            $producto=Producto::find($id);
            $producto->delete();
            return $producto;
        }
    }
}
