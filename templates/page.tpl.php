<?php
   //$base_path = base_path();
   global $user;

   if (!isset($account)) {
     $account = $user;
   }
    
    include ($directory . '/components/navigation.php'); 
?>
<main>
  <?php if (!$is_front): // Only effects the front page display ?>
    <div id="fixed-bg"></div>
  <?php endif; ?>

   <?php 
        print render($title_prefix);
        print render($title_suffix);
        print $messages;
        print render($page['help']);
        
        print render($page['content']);

        if ($action_links){
            print '<nav id="action-links" class="container"><ul>' . render($action_links) . '</ul></nav>';
        }
    ?>
</main>
<?php 
  include ($directory . '/components/footer.php'); 
  include ($directory . '/components/admin-menu.php'); 
?>

