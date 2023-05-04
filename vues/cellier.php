<div class="cellier">
<?php
foreach ($data as $cle => $bouteille) {

    ?>
    <div class="bouteille" data-quantite="">
        <div class="img">

            <img src="https:<?php echo $bouteille['image'] ?>">
        </div>
        <div class="description">
            <p class="nom">Nom : <?php echo $bouteille['nom'] ?> </p>
            <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
            <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
            <p class="type">Type : <?php echo $bouteille['type'] ?></p>
            <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
            <p class="prix">Prix : <?php echo $bouteille['prix'] ?></p>
            <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
        </div>
        <div class="options" data-id="<?php echo $bouteille['id_bouteille_cellier'] ?>">
            <a class="btnModifier" href="?requete=modifierBouteilleCellier&id=<?= $bouteille['id_bouteille_cellier'] ?>">Modifier</a>
            <button class='btnAjouter' data-js-qte='1'>Ajouter</button>
            <button class='btnBoire' data-js-qte='-1'>Boire</button>

        </div>
    </div>
<?php


}

?>
</div>


