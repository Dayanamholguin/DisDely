@extends('perfil.app')
@section('content-perfil')
<form id="form" action="/perfil/recibirFoto/{{$usuario->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mt-1 text-center">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div><img src="" id="img-foto" class="rounded-circle mt-5" width="150" ></div>
                
                <div class="form-group mt-3">
                    <label for="">Imagen</label>
                    <input type="file" class="form-control-file @error('imagen') is-invalid @enderror" name="imagen" id="imagen" onchange="vista_preliminar(event)">
                    @error('imagen')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="col-12 centrado">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
let vista_preliminar = (event) =>{
    let leer_img = new FileReader();
    let id_img = document.getElementById('img-foto');
    leer_img.onload=()=>{
        if (leer_img.readyState ==2) {
            id_img.src=leer_img.result
        }
    }
    leer_img.readAsDataURL(event.target.files[0])
}
</script>
@endsection