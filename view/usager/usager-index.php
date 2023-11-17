{{ include ('header.php', {title: 'User list'}) }}

    <div class="page_name">
        <h2>{{lang.liste_usager}}</h2>
        {% if session.privilege == 1 %}
            <a href="{{path}}usager/create" class="btn">{{lang.ajout_usager}}</a>
        {% endif %}
    </div>

    <section class="liste_index">
        {% for usager in usagers %}
        <div class="champ_index">
            <h3 class="nomChamp">{{ usager.username }}</h3>
            <p><strong>{{lang.privilege}} : </strong> {{ usager.Privilege_id }}</p>

            {% if session.privilege == 1 %}
                <div class="gestion">
                    <form action="{{path}}usager/destroy" method="POST">
                        <input type="hidden" name="id" value="{{usager.id}}">
                        <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                    </form>
                </div>
            {% endif %}
        </div>
        {% endfor %}        
    </section>
</body>
</html>