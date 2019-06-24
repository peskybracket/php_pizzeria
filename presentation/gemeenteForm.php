<?php
    $id="";
    $naam="";
    $postcode="";
    $isLeveringMogelijk="";
    if(isset($gemeente)){
        $id=$gemeente->getId();
        $naam=$gemeente->getNaam();
        $postcode=$gemeente->getPostcode();
        $isLeveringMogelijk=$gemeente->isLeveringMogelijk();
    }
?>
<div id="gemeenteForm" >
    <form  action="objectController.php" method="post" >
        <input type="text" name="object" value="gemeente" hidden>
        <input type="text" name="gemeenteId" value="<?php print($id); ?>" hidden>
        <label for="gemeenteNaam">Gemeente</label>
        <input type="text" name="gemeenteNaam" value="<?php print($naam); ?>">
        <label for="postcode">Postcode</label>
        <input type="text" name="postcode" value="<?php print($postcode); ?>">
        <label for="isLeveringMogelijk">Levering mogelijk?</label>
        <select type="text" name="isLeveringMogelijk" >
            <option value="1" <?php if($isLeveringMogelijk){print("selected");} ?>>Ja</option>
            <option value="0" <?php if(!$isLeveringMogelijk){print("selected");} ?>>Nee</option>
        </select>
        <input type="submit" name="annuleerWijziging" value="Annuleer">
        <?php
            if($id!=""){ ?>
                <input type="submit" name="updateEntity" value="Opslaan">
                <input type="submit" name="deleteEntity" value="Verwijder">
            <?php }else{ ?>
                <input type="submit" name="insertEntity" value="Opslaan">
            <?php } ?>
    </form>
</div>
