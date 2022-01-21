<?php

namespace App\Http\Controllers;

use App\Models\Establecimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EstablecimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
       // $texto=trim($request->get('texto'));
        //$datos['establecimientos']=Establecimiento::paginate(1);
        $datos['establecimientos']=Establecimiento::paginate(1);
        return view('establecimiento.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('establecimiento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto requerida'
        ];

        $this->validate($request, $campos, $mensaje);


       // $datosEstablecimiento = request()->all();
       $datosEstablecimiento = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosEstablecimiento['Foto']=$request->file('Foto')->store('uploads','public');
        }

       Establecimiento::insert($datosEstablecimiento);

        //return response()->json($datosEstablecimiento);
        return redirect('establecimiento')->with('mensaje','Establecimiento agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Establecimiento $establecimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $establecimiento=Establecimiento::findOrFail($id);
        return view('establecimiento.edit',compact('establecimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        if($request->hasFile('Foto')){
           $campos=[ 'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
           $mensaje=['Foto.required'=>'La foto requerida'];
        }
        $this->validate($request, $campos, $mensaje);


        //
        $datosEstablecimiento = request()->except('_token', '_method');

        if($request->hasFile('Foto')){
            $establecimiento=Establecimiento::findOrFail($id);
            Storage::delete('public/'.$establecimiento->Foto);
            $datosEstablecimiento['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Establecimiento::where('id','=',$id)->update($datosEstablecimiento);
        $establecimiento=Establecimiento::findOrFail($id);
        //return view('establecimiento.edit',compact('establecimiento'));
        return redirect('establecimiento')->with('mensaje','Empelado modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establecimiento  $establecimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $establecimiento=Establecimiento::findOrFail($id);

        if(Storage::delete('public/'.$establecimiento->Foto)){
            Establecimiento::destroy($id);
        }

        
        return redirect('establecimiento')->with('mensaje','Empelado borrado');
    }
}
