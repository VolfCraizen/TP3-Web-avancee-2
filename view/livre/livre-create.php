{{include('header.php', {title: 'Livre create'})}}
    <div class="container_form">
        <form class="champ_formulaire" action="./store" method="post">
            <span class="danger">{{ errors | raw}}</span>
            
            <label for="titre">{{lang.titre}}</label>
            <input type="text" name="titre" value="{{livres.titre}}" id="titre">

            <label for="date_de_publication">{{lang.date_de_publication}}</label>
            <input type="date" name="date_de_publication" value="{{livres.date_de_publication}}" id="date_de_publication">

            <label for="prix">{{lang.prix}} $</label>
            <input type="number" name="prix" value="{{livres.prix}}" id="prix">

            <label for="rabais">{{lang.rabais}}</label>
            <input type="number" name="rabais" value="{{livres.rabais}}" id="rabais">

            <label for="auteur">{{lang.auteur}}</label>
            <select name="auteur_id" id="auteur">
                <option value="">{{lang.select_auteur}}</option>
                {%for auteur in auteurs %}
                    <option value="{{ auteur.id }}" {% if auteur.id == id_auteur %} selected {% endif%}>{{ auteur.nom }}</option>
                {% endfor %}
            </select>

            <label for="editeur">{{lang.editeur}}</label>
            <select name="editeur_id" id="editeur">
                <option value="">{{lang.select_editeur}}</option>
                {%for editeur in editeurs %}
                    <option value="{{ editeur.id }}" {% if editeur.id == id_editeur %} selected {% endif%}>{{ editeur.nom }}</option>
                {% endfor %}
            </select>
            </label>

            <input type="submit" value="{{lang.sauvegarder}}" class="btn">
        </form>
    </div>
</body>
</html>