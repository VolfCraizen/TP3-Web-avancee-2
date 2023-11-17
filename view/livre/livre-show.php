{{include('header.php', {title: 'Livre show'})}} 
    <section class="sujet_show">
        <h2 class="nomShow">{{ livres.titre }}</h2>
        <p><strong>{{lang.publier}}</strong> {{ livres.date_de_publication }}</p>
        <p><strong>{{lang.prix_avec_rabais}} {{ livres.rabais }} % : </strong> {{ livres.prixRabais }} $</p>
        <p><strong>{{lang.auteur}} :</strong> <a href="{{path}}auteur/show/{{ auteurs.id }}">{{ auteurs.nom }}</a></p>
        <p><strong>{{lang.editeur}} :</strong> <a href="{{path}}editeur/show/{{ editeurs.id }}">{{ editeurs.nom }}</a></p>

        {% if session.privilege == 1 %}
            <div class="gestion">
                <a href="{{path}}livre/edit/{{livres.id}}" class="btn">{{lang.modifier}}</a>

                <form action="{{path}}livre/destroy" method="POST">
                    <input type="hidden" name="id" value="{{livres.id}}">
                    <input type="submit" value="{{lang.effacer}}" class="btn_danger">
                </form>
            </div>
        {% endif %}
    </section>   
</body>
</html>