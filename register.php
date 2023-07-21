<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body style="background: #000000; color:#fff;">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Compte Utilisateur</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">S'enregister <span class="sr-only"></span></a></li>
                <li><a href="#">Se Connecter</a></li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Rechercher</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-8 col-md-offset-2" >
            <h1 style="color:#fff;">S'inscrire</h1>

            <form action="" method="post">
                <fieldset>
                    <div class="form-group">
                        <label for="pseudo">Nom d'utilisateur</label>
                        <input type="text" id="pseudo" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de Passe</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label for="password">Confirmation du Mot de Passe</label>
                        <input type="password" id="password" class="form-control" name="password_confirm">
                    </div>
                    <input type="submit" class="btn btn-primary" value="S'inscrire">
                </fieldset>
            </form> 
        </div>
    </div>
    

</body>
</html>