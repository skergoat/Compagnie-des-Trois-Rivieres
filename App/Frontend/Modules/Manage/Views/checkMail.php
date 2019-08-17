<?php $upTitle; ?>

<section class="section section-forgotten">
	
	<div class="container container-forgotten">
		
		<div class="container-recover">

			<!-- error message -->

			<?php if(isset($errorMessage)) { ?>

				<article class="message is-danger recover" id="message-recover-code">
				  <div class="message-body">
				  <?= $errorMessage ?>
				  </div>
				</article>

			<?php } else { ?>

				<article class="hiden-message"></article>

			<?php } ?>

			<h2 class="title is-5">Entrez le code de verification :</h2>
			
			<form method="post" action="">
				
				<input type="text" class="input" name="code" /><br><br>

				<input type="submit" class="button is-info" value="Envoyer" id="recover-button-2"/>

			</form>

		</div>

	</div>

</section>