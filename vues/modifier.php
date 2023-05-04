<div class="modifier">
<?php
$bouteille = $data;
var_dump($bouteille);
?>
    <div class="nouvelleBouteille" vertical layout>
        <form >
            <h3><?php echo $bouteille['nom'] ?> </h3>
            <p>Millesime : <input name="millesime" value="<?php echo $bouteille['millesime'] ?> " required></p>
            <p>Quantite : <input name="quantite"  value="<?php echo $bouteille['quantite'] ?> " required></p>
            <p>Date achat : <input name="date_achat" type="date" value="<?php echo $bouteille['date_achat'] ?>" required></p>
            <p>Garde : <input name="garde_jusqua" type="date" value="<?php echo $bouteille['garde_jusqua'] ?>" required></p>
            <p>Prix : <input name="prix" value="<?php echo $bouteille['prix'] ?> " required></p>
            <p>Note : <input name="notes" value="<?php echo $bouteille['notes'] ?> " required></p>
            <input type="hidden" name="id_cellier" value="<?php echo $bouteille['id'] ?>">
            <input type="hidden" name="id_bouteille" value="<?php echo $bouteille['id_bouteille'] ?>">
        </form>
        <button name="modifierBouteilleCellier">Modifer la bouteille (champs tous obligatoires)</button>
    </div>
</div>
<?php

?>
