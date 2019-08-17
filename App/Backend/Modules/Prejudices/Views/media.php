<div class="prejudices-child">

<?php if($mediaType == "video") { ?>

	<!-- video field -->

	<div class="panel-block" id="panel-block-child" style="display:block;">
								
		<label class="label" for="media-video"> Entrez l'iframe de la vidéo : <a href="https://www.youtube.com/watch?v=tAO86IUp9Vs&feature=youtu.be" target="_blank"><i class="far fa-question-circle"></i></a><br/><br/> <!-- popup video ou ecrit sur l'iframe -->
			<input type="text" class="input" name="video_url" id="video_url" /><br/><br/>
		</label>

		<?= $prejudices->Video_url(); ?>

	</div>

<?php } else { ?>

	<!-- slider fields -->

	<div class="panel-block" id="container-input-file">
							
		<fieldset class="fieldset-input-slider" id="prejudices-fieldset"> Ajoutez des images (3 minimum) : <br><br>

			<div class="fieldset-child" id="prejudices-field">

				<div class="panel container-height" id="prejudices-height"> 

					<?php foreach($slider as $slide) { ?>

					<div class="panel-block panel-slider" id="<?= "panel-slider-" . $slide->nb_picture() ?>">
						<div class="button-slider">
							<a class="delete delete-sliders" title="supprimer l'image" id="<?= "slider-" . $slide->nb_picture() ?>"></a>
							<input type="checkbox" class="delete-slider" name="<?= "empty-slider-" . $slide->nb_picture() ?>" value="<?= $slide->getId() ?>" id="<?= "delete-slider-" . $slide->nb_picture() ?>" />
							<label class="label"> <?= $slide->Picture_name() ?> </label>
							<button class="button is-success is-small is-outlined is-fullwidth add-slider" id="<?= "slider-" . $slide->nb_picture() ?>">
				  				Ajouter une image
				  			</button>		
							<input type="file" name="<?= "add-slider-" . $slide->nb_picture() ?>" id="<?= "add-slider-" . $slide->nb_picture() ?>" class="slider-preview"/>
						</div>
						<div class="card-image">
							<?php if($slide->Src() == NULL) { ?>
								<figure class="image is-64" style="">
									<img src="../img/grey.png" id="<?= "preview-add-slider-" . $slide->nb_picture() ?>" class="img-preview" />
								</figure>
							<?php } else { ?>
								<figure class="image is-64">
								<img src="<?= '../' . $slide->Src() ?>" id="<?= "preview-add-slider-" . $slide->nb_picture() ?>" class="img-preview"/>
								</figure>
							<?php } ?>
						</div>
					</div>

					<?php } ?>

				</div>

			</div>

		</fieldset>

	</div>

<?php } ?>

</div>