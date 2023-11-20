{{include('header.php', {title: 'Usager create'})}}
    <div class="container_form">
        <form class="champ_formulaire" action="./store" method="post">
            <span class="danger">{{ errors | raw}}</span>
            
            <label for="username">{{lang.username}}</label>
            <input type="text" name="username" value="{{usagers.username}}" id="username">

            <label for="password">{{lang.password}}</label>
            <input type="text" name="password" id="password">

            <label for="privilege">{{lang.privilege}}</label>
            <select name="Privilege_id" id="privilege">
                <option value="{{usagers.privilege}}">{{lang.select_privilege}}</option>
                {%for privilege in privileges %}
                    <option value="{{ privilege.id }}" {% if privilege.id == id_privilege %} selected {% endif%}>{{ privilege.nom }}</option>
                {% endfor %}
            </select>

            <input type="submit" value="{{lang.sauvegarder}}" class="btn">
        </form>
    </div>
</body>
</html>