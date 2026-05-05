<h1>Editar Pokémon</h1>

<form 
    action="/pokemons/{{ $pokemon->id }}" 
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')

    <input type="text" name="nome" value="{{ $pokemon->nome }}">

    <input type="text" name="tipo" value="{{ $pokemon->tipo }}">

    <input type="number" name="nivel" value="{{ $pokemon->nivel }}">

    <input type="file" name="imagem">

    <button type="submit">
        Atualizar
    </button>

</form>