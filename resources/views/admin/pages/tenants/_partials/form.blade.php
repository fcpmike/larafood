@include('admin.includes.alerts')

<div class="form-group">
    <label>* CNPJ:</label>
    <input type="text" name="cnpj" class="form-control" placeholder="CNPJ:" value="{{ $tenant->cnpj ?? old('cnpj') }}" autofocus>
</div>
<div class="form-group">
    <label>* Razão Social:</label>
    <input type="text" name="name" class="form-control" placeholder="Razão Social:" value="{{ $tenant->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>* Logo:</label>
    <input type="file" name="logo" class="form-control">
</div>
<div class="form-group">
    <label>* E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ $tenant->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>* Activo?</label>
    <select name="active" class="form-control" >
        <option value="Y" @if(isset($tenant) && $tenant->active =='Y') selected @endif >SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active =='N') selected @endif >Não</option>
    </select>
</div>
<hr>
<h3>Assinatura</h3>
<div class="form-group">
    <label>* Data Assinatura (início):</label>
    <input type="date" name="subscription" class="form-control" value="{{ $tenant->subscription ?? old('expires_at') }}">
</div>
<div class="form-group">
    <label>* Expira (final):</label>
    <input type="date" name="expires_at" class="form-control" value="{{ $tenant->expires_at ?? old('expires_at') }}">
</div>
<div class="form-group">
    <label>* Identificador:</label>
    <input type="text" name="subscription_id" class="form-control" placeholder="Identificador:" value="{{ $tenant->subscription_id ?? old('subscription_id') }}">
</div>
<div class="form-group">
    <label>* Assinatura Ativa?</label>
    <select name="subscription_active" class="form-control" >
        <option value="1" @if(isset($tenant) && $tenant->subscription_active) selected @endif >SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_active) selected @endif >Não</option>
    </select>
</div>
<div class="form-group">
    <label>* Assinatura Cancelada?</label>
    <select name="subscription_suspended" class="form-control" >
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended) selected @endif >SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_suspended) selected @endif >Não</option>
    </select>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Salvar</button>
</div>
