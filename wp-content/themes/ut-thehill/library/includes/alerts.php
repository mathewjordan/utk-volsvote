<?php
  /*

  The UT alerts system, now in PHP!! CE::05.27.15 and also not used!! Keeping it just in case we need a backup php option

  */
  function getAlertFeed() {
      // Grab the latest timestamp, in order to bust any caching on the request
      $seconds = time();
      // Add seconds to the end of the feed url
      $feed_url = "https://www.utk.edu/rssfeeds/utalert.xml?cachebust=".$seconds;
      // Grab the xml content from the page
      $content = file_get_contents($feed_url);
      // Load that up in an object
      $x = new SimpleXmlElement($content);
      // Set an iteration var, just to make sure we only go through the loop once
      $i = 1;
        // Loop though the object to extract the data
        foreach($x->channel->item as $entry): 
          
          if($i == 1) :
            
            $title = $entry->title;
              
              if($title != "No Current Alerts"): ?>
                
                <div id='utsafe'>
                  <div class="alert-icon">
                    <i class="fa fa-exclamation-circle"></i>
                  </div>
                  <div class="message">
                    <h1><?php echo $title ?></h1>
                    <p class="alert-copy"><?php echo $entry->description ?></p>
                    <a class="alertButton" href="<?php echo $entry->link ?>">Read More</a>
                  </div>
                </div>
              
              <?php endif ?>

          <?php endif; $i++; ?>

        <?php endforeach; 
        unset($title);  
  } ?>