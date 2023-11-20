{{include('header.php', {title: lang.editeur_edit})}}
    <div class="container_form">
        <form class="champ_formulaire" action="{{path}}editeur/update" method="post">
            <span class="danger">{{ errors | raw}}</span>
            <input type="hidden" name="id" value="{{ editeurs.id }}">

            <label for="nom">{{lang.nom}} </label>
            <input type="text" name="nom" value="{{editeurs.nom}}" id="nom">

            <label for="adresse">{{lang.adresse}}</label>
            <input type="text" name="adresse" value="{{editeurs.adresse}}" id="adresse">
            
            <label for="telephone">{{lang.telephone}}</label>
            <input type="text" name="telephone" value="{{editeurs.telephone}}" id="telephone">

            <label for="courriel">{{lang.courriel}}</label>
            <input type="email" name="courriel" value="{{editeurs.courriel}}" id="courriel">

            <input type="submit" value="save" class="btn">
        </form>
    </div>
</body>
</html>