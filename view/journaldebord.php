{{include('header.php', {title: 'journal de bord'})}}
    <div class="page_name">
        <h2>{{lang.journal_de_bord}}</h2>
    </div>
        
    <section class="liste_index">
        {% for journaldebord in logs %}
            <div class="champ_index">
                <p><strong>{{lang.nom_utilisateur}} </strong> {{ journaldebord.nom_utilisateur }}</p>
                <p><strong>{{lang.url}}</strong> {{ journaldebord.page }}</p>
                <p><strong>{{lang.date}} </strong> {{ journaldebord.date }}</p>
                <p><strong>{{lang.adresse_ip}}</strong> {{ journaldebord.adresse_ip }}</p>

            </div>
        {% endfor %}
    </section>  
</body>
</html>