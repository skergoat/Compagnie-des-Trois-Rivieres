<?php $upTitle; ?>

<?php $recapcha ?>

<div class="section section-show  section-show-contact">

  <div class="container" id="welcome-index">

    <!-- top message -->
    
    <div class="section" id="welcome-content">

      <div class="welcome-comic-frame welcome-comic-frame-contact">

        <div class="container-text-welcome-contact">

          <div class="welcome-comic-frame-contact-bis">

            <div class="container-text-welcome container-text-welcome-contact-bis">

              <p>Nous avons beau etre scrupuleux sur la reconstitution historique, nous n'utilisons quand meme plus de pigeons voyageurs pour communiquer (En plus un pigeon ca mange comme 4, je vous raconte pas les frais d'entretient... )</p><br>
              <p> Si donc vous souhaitez nous contacter n'hesitez pas a remplir le formulaire ci-dessous. Nous repondrons aussi vite que possible !  </p>
                  
            </div>

          </div>

          <!-- form -->

          <div class="media-show show-form">

            <div class="container-sonneur"><img src="img/sonneur-2.png" alt="sonneur" class="illustre-contact"/></div>

                <div class="container-messages">
                  <!-- success message -->

                  <?php if($user->hasFlash() && !isset($errorMessage)) {  ?>

                  <article class="message is-success success-modify <?php if($user->hasFlash() && !isset($errorMessage)) {  ?> hide-message <?php } ?>" id="success-animations">
                    <div class="message-body">
                   <?= $user->getFlash(); ?>
                    </div>
                  </article>

                  <?php } ?>

                  <!-- error message -->

                  <?= isset($errorMessage) ? '<article class="message is-danger error-modify <?php if(isset($errorMessage)) {  ?> hide-message <?php } ?>" style=";text-align:center;" id="error-animations"><div class="message-body">' . $errorMessage . '</div></article>': '' ?>

                </div>

                <form method="post" action="" class="sendMail">

                  <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                      <input class="input" name="name" id="sendName" type="text" required>
                    </div>
                  </div>

                  <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                      <input class="input" name="email" id="sendMail" type="email" required>
                    </div>
                  </div>

                  <div class="field">
                    <label class="label">Message</label>
                    <div class="control">
                      <textarea class="textarea" name="message" id="sendMessage" required></textarea>
                    </div>
                  </div>

                   <div class="g-recaptcha" data-sitekey="6LdtSKQUAAAAAF5G3ErXBmgQd-nVl6NJS17WRLJE" style="margin-bottom:10px;"></div>

                  <div class="field is-grouped">
                    <div class="control">
                      <input type="submit" class="button is-back is-back-contact" value="Envoyer">
                    </div>
                  </div>

              </form>

          </div>
     
        </div>

      </div>

    </div>

    <!-- circle with castle at the bottom -->

   <div class="circle-bottom"></div>

  </div>

</div>

<!-- castle container -->

<div class="container container-castle-contact" id="welcome">

    <img src="img/chateau.png" alt="" class="castle-contact"/>
    <div class="section section-bottom-contact" id="#welcome-content-contact"></div>

</div>