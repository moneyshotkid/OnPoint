<?php if ( $form != null || $flash ) : ?>
$(function () {
			<?php if ( $flash ) : ?>  
					$.jGrowl('<? echo $flash;?> ', {sticky : true, header : '<?php echo $caption?>'  });
			<?php endif; ?>

			<?php if ( $form->hasErrors() ) : ?>
				<?php foreach ( $form->getErrors() as $field => $errors ) : ?>
					<?php foreach ( $errors as $error ) : ?>  
						$.jGrowl('<?php echo $error;?> ', {sticky : true, header : '<?php echo $caption?>' });
						<?php endforeach ; ?>
				<?php endforeach ; ?>
			<?php endif; ?>
})
<?php endif; ?> 
