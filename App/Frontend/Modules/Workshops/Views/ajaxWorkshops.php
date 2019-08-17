<section class="info-ajax" id="<?= $workshops->Ajax_id() ?>">

	<h2 class="title is-1"><?= $workshops->Title() ?></h2>

	<?php if($user->isAuthenticated()) { ?>
	<div class="tabs is-toggle">
	  <ul>
	    <li>
	      <a href="/admin/workshops-modify-<?= $workshops->getId() ?>" id="modify-page" class="modify-class">
	        <span class="icon is-small"><i class="fas fa-wrench"></i></span>
	        <span>Modifier</span>
	      </a>
	    </li>
	  </ul>
	</div>
	<?php } ?>

	<?php if($workshops->media() == 'picture') { ?>

		<div class="frame-picture-top">

			<div class="frame-picture-middle">

				<div class="picture-show media-show">

					<img src="<?= $mainPicture->Src() ?>" alt="<?= $mainPicture->alt() ?>" style="width:100%;"/>

				</div>

			</div>

		</div>

	<?php } else if($workshops->media() == 'video') { ?>

		<div class="frame-picture-top">

			<div class="frame-picture-middle">

				<div class="picture-show video-show">

					<?= $workshops->video_url() ?>

				</div>
				
			</div>

		</div>

	<?php } 

	else if($workshops->Media() == 'slider') { ?>

	<div class="container-slider frame-picture-top">	

		<div class="frame-picture-middle">

			<div class="section media-show" id="section-slider">
		
				<div class="slider">

				 <?php $nb = 1; ?>

				 <?php foreach($pictureSlider as $slider) { ?>

				  <div class="slide slideshow" id="img<?= $nb++ ?>" style=""><img src="<?= $slider->Src() ?>" alt="<?= $slider->Alt() ?>" style="" /></div>

				  <?php } ?>

				  <div class="button-container">
					<button id="previous" class="arrow"><i class="fas fa-arrow-left"></i></button>
					<button id="next" class="arrow"><i class="fas fa-arrow-right"></i></button>
				   </div>

				</div>

			</div>

		</div>

	</div>

	<?php } ?>

	<div id="ajax-container">

		<section class="section description">

			<div class="content" id="content-text">

				<?= $workshops->Description() ?>
		
			</div>

			<a href="/workshops" class="button is-back" id="animationsBack">Retour aux Artisanats</a>

		</section>

	</div>

</section>