
<h1> {{ $modo }} establecimiento </h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
<ul>

    @foreach($errors->all() as $error)
    <li> {{ $error }}</li>    
    @endforeach
</ul>
    </div>
    
   
@endif

<div class="form-group">

<label for="Nombre"> Nombre </label>   
<input type="text" class="form-control" name="Nombre" value="{{ isset($establecimiento->Nombre)?$establecimiento->Nombre:old('Nombre') }}" id="Nombre">
<br>

</div>

<div class="form-group">
<label for="Foto"></label>  
@if(isset($establecimiento->Foto))
<img class="img-thumbnail img-flui" src="{{ asset('storage').'/'.$establecimiento->Foto }}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
<br>  
</div>


<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('establecimiento/') }}"> Regresar </a>

<br>