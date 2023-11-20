{{include('header.php', {title: lang.editeur_create})}}
    <div class="container_form">
        <form class="champ_formulaire" action="./store" method="post">
            <span class="danger">{{ errors | raw}}</span>
            <label for="nom">{{lang.nom}}</label>
            <input type="text" name="nom" value="{{editeurs.nom}}">

            <label for="adresse">{{lang.adresse}}</label>
            <input type="text" name="adresse" value="{{editeurs.adresse}}" id="adresse">

            <label for="telephone">{{lang.telephone}}</label>
            <input type="text" name="telephone" value="{{editeurs.telephone}}" id="telephon">

            <label for="courriel">{{lang.courriel}}</label>
            <input type="email" name="courriel" value="{{editeurs.courriel}}" id="courriel">

            <input type="submit" value="{{lang.sauvegarder}}" class="btn">
        </form>
    </div>
</body>
</html>