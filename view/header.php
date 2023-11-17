<!DOCTYPE html>
<html lang="fr_ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{path}}css//styles.css">
</head>

<body>
    <header>
        <h1>{{lang.logo}}</h1>
        
        <nav>
            <a href="{{path}}">{{lang.accueil}}</a>
            <a href="{{path}}livre">{{lang.livres}}</a>
            <a href="{{path}}auteur">{{lang.auteurs}}</a>
            <a href="{{path}}editeur">{{lang.editeurs}}</a>
            {% if guest %}
                <a href="{{path}}login">{{lang.connexion}}</a>
            {% else %}
                {% if session.privilege == 1 or session.privilege == 2 %}
                    <a href="{{path}}usager">{{lang.utilisateurs}}</a>
                {% endif %}

                {% if session.privilege == 1 %}
                    <a href="{{path}}journaldebord">{{lang.journal_de_bord}}</a>
                {% endif %}
                <a href="{{path}}login/logout">{{lang.deconnexion}}</a>
            {% endif %}
        </nav>

        <div class="langues">
            <a href="{{path}}lang/change/fr">{{lang.language_fr}}</a>
            <a href="{{path}}lang/change/en">{{lang.language_en}}</a>
        </div>
    </header>