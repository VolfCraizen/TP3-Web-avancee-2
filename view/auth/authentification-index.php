{{include('header.php', {title: 'Log in'})}}

<div class="container_form">
        <form class="champ_formulaire" action="{{path}}login/auth" method="post">

            <h3>{{lang.connexion}}</h3>

            <span class="danger">{{ errors | raw}}</span>
            
            <label for="username">{{lang.username}}</label>
            <input type="text" name="username" value="{{usagers.username}}" id="username">

            <label for="password">{{lang.password}}</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="{{lang.connexion}}" class="btn">
        </form>
    </div>
</body>
</html>