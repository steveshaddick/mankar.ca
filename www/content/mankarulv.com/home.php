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
      
      
        <h1>Herbicide contribuant au respect de l'environnement.</h1>
        <a href="<?php echo PICTURES_LOCATION; ?>benefits1.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pright" src="<?php echo PICTURES_LOCATION; ?>benefits1.jpg" alt=""></a>
        <p>Les syst&egrave;mes de pulv&eacute;risation Mankar vous proposent une technique d'application d' herbicide bonne pour l'environnement. L&eacute;gers et pratiques, gagnez du temps et all&eacute;gez votre travail gr&acirc;ce aux mod&egrave;les portables MANKAR&reg;.</p>

        <p>Tous les syst&egrave;mes de vaporisation Mankar sont &eacute;quip&eacute;s d'une buse rotative brevet&eacute;e &agrave; secteur r&eacute;glable. Facile &agrave; utiliser, c'est id&eacute;al pour appliquer aux endroits qui n&eacute;cessitent une certaine vigilance, par exemple: entre les rang&eacute;es de r&eacute;colte, le long des cl&ocirc;tures et des lignes s&eacute;paratives d'une propri&eacute;t&eacute;, entre et sous les arbres et fleurs, autour des immeubles...Gr&acirc;ce &agrave; l'application d'herbicide g&eacute;n&eacute;ralement non dilu&eacute;, c'est-&agrave;-dire sans addition d'eau,  vous b&eacute;n&eacute;ficiez d'une charge moins lourde, vous pouvez commencer le travail imm&eacute;diatement sans &ecirc;tre oblig&eacute; de l'interrompre par des remplissages fastidieux et prises de mesure inutiles, et vous minimisez le risque de d&eacute;rive! Par exemple, un pulv&eacute;risateur portable conventionnel n&eacute;cessite des quantit&eacute;s beaucoup plus &eacute;lev&eacute;es et p&egrave;se en moyenne 20kg . En revanche, un r&eacute;servoir Mini Mantis Plus p&egrave;se &agrave; peine 3.3 kg! En somme, il vous est donc possible d'utiliser plusieurs sortes d'herbicides, d'en faire l'application &agrave; plusieurs endroits, et ce, tout en respectant l'environnement.</p>
        <a href="<?php echo PICTURES_LOCATION; ?>benefits2.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pleft" src="<?php echo PICTURES_LOCATION; ?>benefits2.jpg" alt=""></a>
        <p>Bien que cet appareil fut initialement con&ccedil;u  pour l'utilisation d'herbicides tels que Roundup et d'autres produits glyphosates, ce pulv&eacute;risateur peut facilement s'adapter au traitement des cultures les plus vari&eacute;es. Nous testons continuellement cette machine et la consid&eacute;rons tr&egrave;s efficace puisqu'elle peut s'utiliser avec plusieurs sortes d'herbicides.</p>
        <br />
      
      <?php
      break;

    default:
      ?>

        <h1>Chemical weed control with the lowest possible environmental impact.</h1>
        <a href="<?php echo PICTURES_LOCATION; ?>benefits1.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pright" src="<?php echo PICTURES_LOCATION; ?>benefits1.jpg" alt=""></a>
        <p>The Mankar line of sprayers offer chemical weed control with the lowest possible environmental impact.  In particular, the Mankar-Carry line are small, hand-held units that are convenient, light, and time-saving. </p>
        <p>Mankar's patented segment rotation nozzle is the primary element in all our spraying systems.  It is ideal for targeted applications such as between crops, along fence or property lines, between or under trees, or around buildings.  As you don't need to mix the chemical with any water you benefit from carrying a lot less weight, less downtime (no filling the tanks with water, measuring, etc) and virtually no drift!  For example an average backpack sprayer easily exceeds 20 kg, while a fully-loaded <a href="mini-mantra-plus_ULV_sprayer.php">Mini Mantra Plus</a> weighs only 3.3 kg!  

        This allows for the efficient application of different preparations in a wide range of areas and in a way that protects resources and the environment. </p>
        <a href="<?php echo PICTURES_LOCATION; ?>benefits2.jpg" rel="lightbox[benefits]" title="Mankar-P"><img class="pleft" src="<?php echo PICTURES_LOCATION; ?>benefits2.jpg" alt=""></a>
        <p>While this unit's basic purpose is for Roundup or other glyphosate products, it easily can handle a variety of chemicals - we are continually testing this machine and are finding it very effective with a wide range of preparations.</p>
        
        <br />

      <?php
      break;
  }

?>

  <div id="homeProducts">

  <div class="productTypeListWrapper">
    <?php foreach ($mankarMain->productTypes as $type)
    { 
        ?>
        <div class="productTypeWrapper">
          <div class="productType">

            <div class="productImage">
              <?php
              echo '<a href="'.$type['pretty_url'].'" title="'.$type['name'].'">';
              echo '<img src="'.THUMBS_LOCATION.$type['thumbnail'].'" alt="'.$type['name'].'">';
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


  <p>Mankar Distributing Inc. is a member of the <a href="http://www.canadanursery.com/" target="_blank"><img src="<?php echo IMAGES_LOCATION; ?>CNLA.png" alt="Canadian Nursery Landscape Association"></a></p>

</div>
