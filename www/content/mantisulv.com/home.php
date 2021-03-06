 <div class="padContent">

 <?php

    switch ($mankarMain->lang) {
    
    case LANGUAGE_SPANISH:

      echo NO_SPANISH;
      break;
  }

  switch ($mankarMain->lang) {

    case LANGUAGE_FRENCH:
      ?>
        <h1>Le système de pulvérisation MANTIS-ULV pour l'industrie </h1>
        <h2>Des buses rotatives efficaces et un système de dosage permettant une utilisation réduite de produits liquides</h2>
          <p><strong>Système de dosage ULV</strong></p>
        <a href="<?php echo PICTURES_LOCATION; ?>mantisulv1.jpg" rel="lightbox[mantis1]" title="Here is one possible configuration with 4 atomizers mounted above a conveyor."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>mantisulv1.jpg" alt=""></a>
          <p>"ULV" signifie Ultra Low Volume, c'est-à-dire quantité d'épandage particulièrement faible. Le système de dosage ULV permet, combiné avec les buses rotatives de Mantis, un spectre de gouttelettes idéal d'environ 35-45 microns assurant ainsi un humectage optimal de la surface.</p>
        <a href="<?php echo PICTURES_LOCATION; ?>bema1000.jpg" rel="lightbox[mantis1]" title="The BEMA-1000 is a handheld option for smaller operations and maximum flexibility."><img class="pleft" src="<?php echo THUMBS_LOCATION; ?>bema1000.jpg" alt=""></a>  
          <p>Avec la buse industrielle type BL de Mantis, il est possible de créer à partir d'un millilitre de liquide près de 30 millions de gouttelettes. La buse rotative fonctionne sans pression, la pulvérisation a lieu par force centrifuge grâce à un disque spécialement conçu à cet effet. Les gouttelettes se déposent uniformément sur la surface desmoules grâce à l’écoulement vertical généré par le disque rotatif et à la gravité.</p>     
      <?php
      break;

    default:
      ?>
        <h1>MANTIS ULV Industrial Applicators</h1>
        <h2>Efficient rotary atomizers and metering systems for the economical application of form release for the concrete industry</h2>
        <h3>ULV technology</h3>
        <a href="<?php echo PICTURES_LOCATION; ?>mantisulv1.jpg" rel="lightbox[mantis1]" title="Here is one possible configuration with 4 atomizers mounted above a conveyor."><img class="pright" src="<?php echo THUMBS_LOCATION; ?>mantisulv1.jpg" alt=""></a>
        <p>"ULV" stands for Ultra Low Volume, meaning particularly small output quantities.The ULV metering technology, in conjunction with Mantis rotary atomizers, achieves an ideal narrow droplet spectrum of 35-45 um, ensuring optimum surface wetting.</p>
        <p>With the BL industrial atomizer from Mantis, it is possible to generate approx. 30 million droplets from 1 ml of liquid (900 million droplets from one ounce). The rotary atomizer works without pressure, and the spray pattern is created by means of centrifugal force and using a specially developed atomizer disc. The droplets are deposited evenly on the surface of the mold by means of the vertical air stream generated by the rotation disc and gravity.</p>
        <a href="<?php echo PICTURES_LOCATION; ?>bema1000.jpg" rel="lightbox[mantis1]" title="The BEMA-1000 is a handheld option for smaller operations and maximum flexibility."><img class="pleft" src="<?php echo THUMBS_LOCATION; ?>bema1000.jpg" alt=""></a>  
        <p>Due to these technical advancements, and the precision metering control, you can greatly reduce the amount of release agent needed to coat your forms.  You can reduce eliminate dripping and streaking due to the large droplets that come out of a pressurized system.</p>
        <br><br><br><br>
      <?php
      break;
  }

?>

  <div id="homeProducts">

  <div class="productTypeListWrapper">
    <?php foreach ($mankarMain->totalProductTypes as $type)
    { 
        ?>
        <div class="productTypeWrapper">
          <div class="productType">

            <div class="productImage">
              <?php
              echo '<a href="'.$type['pretty_url'].'" title="'.$type['name'].'">';
              if (!isset($type['is_product'])) {
                echo '<img src="'.THUMBS_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'" />';
              } else {
                echo '<img src="'.PICTURES_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'" />';
              }
              echo '</a>';
            ?>  
            </div>
            <div class="productName">

              <a class="navLink" href="<?php echo $type['pretty_url']; ?>"><?php echo $type['name']; ?></a>

            </div>
          </div>
        </div>

    <?php 
    } 
    ?>
  </div>
  <br class="clear" />
  </div>
</div>
