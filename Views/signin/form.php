<?php
echo("<form class='sigin' method='post' action='#'>
        <label><b>Nom d'utilisateur</b></label>
        <input type='text' placeholder='Votre pseudo' name='username' required><br>

        <label><b>Mot de passe</b></label>
        <input type='password' placeholder='Entrer le mot de passe' name='password' required>

       <label><a href='./'><b>Mot de passe oublié?</b></a></label>

        <input type='submit' id='submit' value='Se connecter' >
        
        <label><a href='/signup'><b>Créer un compte</b></a></label>
    </form>");