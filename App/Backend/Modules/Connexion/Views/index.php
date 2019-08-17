<?php $upTitle; ?>

<nav class="navbar" id="navbar-connexion" aria-label="main navigation">
	<a href="/">
		<div class="container-logo">
		    <img src="../../Web/img/blason.png" alt="blason" id="logo-img-bottom"/>
		    <div class="titre-logo-top">C3R</div>
		</div>
	</a>
</nav>

<div class="section connexion-form">

	<div class="container">

		<!-- error message -->

		<?php if(isset($errorMessage)) { ?>

			<article class="message is-danger" id="message-connexion">
			  <div class="message-body">
			  <?= $errorMessage ?>
			  </div>
			</article>

		<?php } else { ?>

			<div class="hiden-message"></div>

		<?php } ?>

		<form action="#" method="post" class="connexion">
		  <label class="label-auth">Pseudo</label>
		  <input class="input connect" id="pseudo" type="text" name="login" /><br />
		  
		  <label class="label-auth">Mot de passe</label>
		  <input class="input connect" id="mdp" type="password" name="password" /><br /><br />
		  
		  <input class="button button-connect is-danger" type="submit" value="Connexion" />
		</form>

		<div><span class="forgot">Mot de passe oublié ?</span><a href="/forgotten" id="connexion-link"> Cliquez ici </a> </div>

	</div>

</div>