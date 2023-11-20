{{include('header.php', {title: lang.auteur_edit})}}
    <div class="container_form">
        <form class="champ_formulaire" action="{{path}}auteur/update" method="post">
            <span class="danger">{{ errors | raw}}</span>
            <input type="hidden" name="id" value="{{ auteurs.id }}">

            <label for="nom">{{lang.nom}}</label>
            <input type="text" name="nom" value="{{auteurs.nom}}" id="nom">

            <label for="date_de_naissance">{{lang.date_de_naissance}}</label>
            <input type="date" name="date_de_naissance" value="{{auteurs.date_de_naissance}}" id="date_de_naissance">
            
            <input type="submit" value="{{lang.sauvegarder}}" class="btn">
        </form>
    </div>
</body>
</html>