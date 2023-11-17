{{include('header.php', {title: 'Éditeurs'})}}
    <div class="page_name">
        <h2>{{lang.liste_editeur}}</h2>
        {% if session.privilege == 1 or session.privilege == 2 %}
            <a href="{{path}}editeur/create" class="btn">{{lang.ajout_editeur}}</a>
        {% endif %}
    </div>
        
    <section class="liste_index">
        {% for editeur in editeurs %}
        <div class="champ_index">
            <h3 class="nomChamp"><a href="{{path}}editeur/show/{{ editeur.id }}">{{ editeur.nom }}</a></h3>
            <p><strong>{{lang.adresse}} : </strong> {{ editeur.adresse }}</p>
            <p><strong>{{lang.telephone}} : </strong> {{ editeur.telephone }}</p>
            <p><strong>{{lang.courriel}} : </strong> {{ editeur.courriel }}</p>

            {% if session.privilege == 1 %}
                <div class="gestion">
                    <a href="{{path}}editeur/edit/{{editeur.id}}" class="btn">{{lang.modifier}}</a>

                    <form action="{{path}}editeur/destroy" method="POST">
                        <input type="hidden" name="id" value="{{editeur.id}}" class="btn">
                        <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                    </form>
                </div>
            {% endif %}
        </div>
        {% endfor %}  
    </section>
</body>
</html>