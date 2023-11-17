{{include('header.php', {title: 'Éditeur edit'})}}
        <div class="container_form">
            <form class="champ_formulaire" action="{{path}}livre/update" method="post">
                <input type="hidden" name="id" value="{{ livres.id }}">

                <label for="titre">{{lang.titre}}</label>
                <input type="text" name="titre" value="{{livres.titre}}" id="titre">

                <label for="date_de_publication">{{lang.date_de_publication}}</label>
                <input type="date" name="date_de_publication" value="{{livres.date_de_publication}}" id="date_de_publication">
                
                <label for="prix">{{lang.prix}} $</label>
                <input type="number" name="prix" value="{{livres.prix}}" id="prix">

                <label for="rabais">{{lang.rabais}}</label>
                <input type="number" name="rabais" value="{{livres.rabais}}" id="rabais">

                <label for="auteur">{{lang.auteur}}</label>
                <select name="Auteur_id" id="auteur">
                    {% for auteur in auteurs %}
                            <option value="{{ auteur.id }}" {% if auteur.id == livres.Auteur_id %} selected {% endif %}>{{ auteur.nom }}</option>
                    {% endfor %}
                </select>

                <label for="editeur">{{lang.editeur}}</label>
                <select name="Editeur_id" id="editeur">
                    {%for editeur in editeurs%}
                        <option value="{{ editeur.id }}" {% if editeur.id == livres.Editeur_id %} selected {% endif %}>{{ editeur.nom }}</option>
                    {% endfor %}
                </select>
                <input type="submit" value="{{lang.sauvegarder}}" class="btn">
            </form>
        </div>
    </body>
</html>