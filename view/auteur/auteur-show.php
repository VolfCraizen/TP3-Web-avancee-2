{{include('header.php', {title: lang.auteur_show})}}
    <section class="sujet_show">
        <h2 class="nomShow">{{ auteurs.nom }}</h2>
        <p><strong>{{lang.naissance}}</strong> {{ auteurs.date_de_naissance }}</p>

        {% if session.privilege == 1 %}
            <div class="gestion">
                <a href="{{path}}auteur/edit/{{auteurs.id}}" class="btn">{{lang.modifier}}</a>

                <form action="{{path}}auteur/destroy" method="POST">
                    <input type="hidden" name="id" value="{{auteurs.id}}">
                    <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                </form>
            </div>
        {% endif %}
    </section>
      
    <h2 class="label_liste_show">{{lang.livres_ecrits}}</h2>
    <section class="liste_article_show">
        {% for livre in livres %}
            {% if auteurs.id == livre.Auteur_id %}
                <div class="champ">
                    <h3 class="nomChamp"><a href="{{path}}livre/show/{{ livre.id }}">{{ livre.titre }}</a></h3>
                    <p><strong>{{lang.publier}}</strong> {{ livre.date_de_publication }}</p>
                </div>
            {% endif %}
        {% endfor %}
    </section> 
</body>
</html>