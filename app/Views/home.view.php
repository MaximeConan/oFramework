<h1>Bienvenue sur oFramework</h1>

<form
    action="<?= $router->generate('list_create'); ?>"
    method="post"
>
    <input type="text" name="name" />
    <input type="number" name="order" />
    <button type="submit">Créer</button>
</form>
