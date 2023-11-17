{{include('header.php', {title: 'Editeurs show'})}}
    <section class="sujet_show">
        <h2 class="nomShow">{{ editeurs.nom }}</h2>
        <p><strong>{{lang.adresse}} : </strong> {{ editeurs.adresse }}</p>
        <p><strong>{{lang.telephone}} : </strong> {{ editeurs.telephone }}</p>
        <p><strong>{{lang.courriel}} :</strong> {{ editeurs.courriel }}</p>

        {% if session.privilege == 1 %}
            <div class="gestion">
                <a href="{{path}}editeur/edit/{{editeurs.id}}" class="btn">{{lang.modifier}}</a>

                <form action="{{path}}editeur/destroy" method="POST">
                    <input type="hidden" name="id" value="{{editeurs.id}}">
                    <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                </form>
            </div>
        {% endif %}
    </section>
    
    <h2 class="label_liste_show">{{lang.livres_publies}}</h2>
    <section class="liste_article_show">
        {% for livre in livres %}
            {% if editeurs.id == livre.Editeur_id %} 
                <div class="champ">
                    <h3 class="nomChamp"><a href="{{path}}livre/show/{{ livre.id }}">{{ livre.titre }}</a></h3>
                    <p><strong>{{lang.publier}}</strong> {{ livre.date_de_publication }}</p>
                </div>
            {% endif %}
        {% endfor %}
    </section>
</body>
</html>