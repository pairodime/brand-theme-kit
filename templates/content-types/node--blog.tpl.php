<?php
  // Define Render Array
  hide($content['field_blog_teaser_video']);
  hide($content['field_blog_teaser_photo']);
  hide($content['field_blog_poster_photo']);

  hide($content['field_blog_image']);
  hide($content['body']);
  hide($content['comments']);
  hide($content['links']);
  hide($content['language']);
  print render($content);

  $teaserVideo = field_get_items('node', $node, 'field_blog_teaser_video');
  $teaserPhoto = field_get_items('node', $node, 'field_blog_teaser_photo');
  $posterPhoto = field_get_items('node', $node, 'field_blog_poster_photo');
?>

<?php if ($view_mode == 'teaser') { ?>
  <article class="news news-teaser">
    <a href="<?php print $node_url; ?>">
      <div class="article-title">
        <h3><?php print $title ?></h3>
      </div>
      <?php

        if($teaserVideo){
          print '<video autoplay loop muted playsinline>
                    <source src="https://res.cloudinary.com/capita/video/upload/ac_none,c_crop,du_20,f_auto,g_center,h_560,so_1,w_350/v1496781419/' . $node->field_blog_teaser_video['und'][0]['value'] . '.mp4" type="video/mp4">
                    <source src="https://res.cloudinary.com/capita/video/upload/ac_none,c_crop,du_20,f_auto,g_center,h_560,so_1,w_350/v1496781419/' . $node->field_blog_teaser_video['und'][0]['value'] . '.ogg" type="video/ogg">
                    <img src="https://res.cloudinary.com/capita/video/upload/vs_25,dl_200,w_350,h_560,c_fill,g_center,e_loop/' . $node->field_blog_teaser_video['und'][0]['value'] . '.gif">
    </video>';
        } elseif ($teaserPhoto) {
          print '<img class="preview"  src="' . image_style_url('350_x_560_manual_crop', $node->field_blog_teaser_photo['und'][0]['uri']) . '">';
        } else {
          print '<img class="preview"  src="' . image_style_url('350_x_560_manual_crop', $node->field_blog_image['und'][0]['uri']) . '">';
        }
      ?>
    </a>
  </article>
<?php }; // END TEASER VIEW ?>

<?php if ($view_mode == 'full') { // FULL VIEW ?>


<article class=" blog blogFull">
	<h1 class="blogTitle"><?php print $title ?></h1>
	<span class="blogDate">Posted: <?php $formatted_date = format_date($node->created, 'custom', 'D, n/j/y'); ?><?php print $formatted_date; ?></span>
	<?php if ($node->field_blog_image['und'][0] > '' ) { ?>
		<img id="blog-image" src="<?php print image_style_url('blog_width', $node->field_blog_image['und'][0]['uri']) ?>" class="blogMainImage" />
	<?php } ?>
	<div class="blogContent">
	<?php print render($content['body']); ?>
	</div>
</article>

<?php }; // END FULL VIEW ?>