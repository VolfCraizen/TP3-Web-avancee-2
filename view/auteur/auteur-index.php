{{include('header.php', {title: 'Auteur'})}}
    <div class="page_name">
        <h2>{{lang.liste_auteur}}</h2>
        {% if session.privilege == 1 or session.privilege == 2 %}
            <a href="{{path}}auteur/create" class="btn"> {{lang.ajout_auteur}}</a> 
        {% endif %}
    </div>

    <section class="liste_index">
        {% for auteur in auteurs %}
        <div class="champ_index">
            <h3 class="nomChamp"><a href="{{path}}auteur/show/{{ auteur.id }}">{{ auteur.nom }}</a></h3>
            <p><strong>{{lang.naissance}}</strong> {{ auteur.date_de_naissance }}</p>

            {% if session.privilege == 1 %}
                <div class="gestion">
                    <a href="{{path}}auteur/edit/{{auteur.id}}" class="btn">{{lang.modifier}}</a>

                    <form action="{{path}}auteur/destroy" method="POST">
                        <input type="hidden" name="id" value="{{auteur.id}}">
                        <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                    </form>
                </div>
            {% endif %}
        </div>
        {% endfor %}        
    </section>       
</body>
</html>
