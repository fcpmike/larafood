@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" class="form-control" name="name" value="{{ $detail->name ?? old('name') }}" placeholder="Nome" >
</div>
<div class="form-group">
    <button type="submit" class="btn btn-info">Salvar</button>
</div>
