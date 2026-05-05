<h1>Cadastrar Pokémon</h1>

<form action="/pokemons" method="POST" enctype="multipart/form-data">

    @csrf

    <input type="text" name="nome" placeholder="Nome">

    <input type="text" name="tipo" placeholder="Tipo">

    <input type="number" name="nivel" placeholder="Nível">

    <input type="file" name="imagem">

    <button type="submit">
        Salvar
    </button>

</form>