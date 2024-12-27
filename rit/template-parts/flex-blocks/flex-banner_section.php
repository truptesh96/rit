<?php
	$section_id = get_sub_field('section_id') ? get_sub_field('section_id') : 'sec-'.get_row_index();
	$section_class = get_sub_field('section_class');
	$section_color_schema = get_sub_field('section_color_schema');

	if(have_rows('banner_slides')): 
?>
<section class="heroBanner hasBg <?php echo $section_class.' '.$section_color_schema; ?>" id="<?php echo $section_id; ?>">
	<?php while (have_rows('banner_slides')) { the_row(); ?>

		<?php 
			$media_type = get_sub_field('media_type');
			$image = get_sub_field('image');
		?>
		
		<div class="mediaWrap bgItem <?php echo $media_type; ?> ">
			<?php echo ($media_type == "image") ? wp_get_attachment_image($image, 'full' ) : ''; ?>
			
			<?php if($media_type == "video"): ?>
				
			<?php endif; ?>

			<?php 
				if($media_type == "thirdParty"):
					echo get_sub_field('third_party_url') ? get_sub_field('third_party_url') : '';
				endif; 
			?>

		</div>



		<div class="contWrap z2">
			<?php get_template_part('template-parts/common-fields/get_headers'); ?>
		</div>
		 
	
	<?php } ?>
</section>
<?php endif; ?>
