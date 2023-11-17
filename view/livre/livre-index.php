{{include('header.php', {title: 'Livres'})}}
    <div class="page_name">
        <h2>{{lang.liste_livre}}</h2>
        {% if session.privilege == 1 or session.privilege == 2 %}
        <a href="{{path}}livre/create" class="btn">{{lang.ajout_livre}}</a>  
        {% endif %}
    </div>
        
    <section class="liste_index">
        {% for livre in livres %}
        <div class="champ_index">
            <h3 class="nomChamp"><a href="{{path}}livre/show/{{ livre.id }}">{{ livre.titre }}</a></h3>
            <p><strong>{{lang.publier}}</strong> {{ livre.date_de_publication }}</p>
            <p><strong>{{lang.prix_avec_rabais}} {{ livre.rabais }} % : </strong> {{ livre.prixRabais }} $</p>
            <p><strong>{{lang.auteur}} :</strong> <a href="{{path}}auteur/show/{{ livre.livreAuteur.id }}">{{ livre.livreAuteur.nom }}</a></p>
            <p><strong>{{lang.editeur}} :</strong> <a href="{{path}}editeur/show/{{ livre.livreAuteur.id }}">{{ livre.livreEditeur.nom }}</a></p>
               
            {% if session.privilege == 1 %}
                <div class="gestion">
                    <a href="{{path}}livre/edit/{{livre.id}}" class="btn">{{lang.modifier}}</a>

                    <form action="{{path}}livre/destroy" method="POST">
                        <input type="hidden" name="id" value="{{livre.id}}">
                        <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                    </form>
                </div>
            {% endif %}
        </div>
        {% endfor %}
    </section>  
</body>
</html>