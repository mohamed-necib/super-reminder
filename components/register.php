 <!-- formulaire d'inscription et de connexion -->
 <script defer src="./Js/register.js"></script>


 <form method="post" id="register">
    <div class="row-wrap">
       <input type="text" name="login" placeholder="Pseudo" required>
       <input type="text" name="firstname" placeholder="Firstname" required>
    </div>

    <div class="row-wrap">
       <input type="text" name="lastname" placeholder="Lastname" required>
       <input type="password" name="password" placeholder="Mot de passe" required>
    </div>
    <div class="col">
       <input type="password" class="conf-password" name="password_confirm" placeholder="Confirmation du mot de passe" required>
       <input type="submit" class="authentication" name="submit" value="S'inscrire">
    </div>
 </form>