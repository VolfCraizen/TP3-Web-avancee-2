{{include('header.php', {title: 'Auteur create'})}}
    <div class="container_form">
        <form class="champ_formulaire" action="./store" method="post">
            <span class="danger">{{ errors | raw}}</span>

            <label for="nom">{{lang.nom}}</label>
            <input type="text" name="nom" value="{{auteurs.nom}}" id="nom" value="{{auteurs.nom}}">

            <label for="date_de_naissance">{{lang.date_de_naissance}}</label>
            <input type="date" name="date_de_naissance" value="{{auteurs.date_de_naissance}}" id="date_de_naissance" value="{{auteurs.date_de_naissance}}">

            <input type="submit" value="{{lang.sauvegarder}}" class="btn">
        </form>
    </div>
</body>
</html>
