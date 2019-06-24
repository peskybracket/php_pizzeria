<?php
    $id="";
    $naam="";
    $voornaam="";
    $straat="";
    $huisnr="";
    $bus="";
    $postcode="";
    $woonplaats="";
    $telefoon="";
    $email="";
    $heeftKorting="";
    $isSuperUser="";

    if(isset($formUser)){

        $id=$formUser->getId();
        $naam=$formUser->getNaam();
        $voornaam=$formUser->getVoornaam();
        $telefoon=$formUser->getTelefoon();
        $email=$formUser->getEmail();
        $straat=$formUser->getStraat();
        $huisnr=$formUser->getHuisnr();
        $bus=$formUser->getBus();
        $woonplaats=$formUser->getGemeente();
        $postcode=$formUser->getPostcode();


    $heeftKorting=$formUser->heeftKorting();
    $isSuperuser=$formUser->isSuperuser();
    $isTijdelijkeUser=$formUser->isTijdelijkeUser();

    }
?>
<div id="userForm" >

<form method="post" action="objectController.php">
    <div class="row">
        <input type="text" name="object" value="user" hidden>
        <input name="userId" type="hidden" value="<?php print($id); ?>">
        <div class="col"><label  for="naam" >Naam</label></div>
        <div class="col"><input name="naam" type="text" value="<?php print($naam); ?>" ></div>
    </div>
    <div class="row">
        <div class="col"><label  for="email" >E-mail</label></div>
        <div class="col"><input name="email" type="text" value="<?php print($email); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="voornaam" >Voornaam</label></div>
        <div class="col"><input name="voornaam" type="text" value="<?php print($voornaam); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="straat" >Straat</label></div>
        <div class="col"> <input name="straat" type="text" value="<?php print($straat); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="huisnr" >Huisnummer</label></div>
        <div class="col"><input name="huisnr" type="text" value="<?php print($huisnr); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="bus" >Bus</label></div>
        <div class="col"><input name="bus" type="text" value="<?php print($bus); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="postcode" >Postcode</label></div>
        <div class="col"><input name="postcode" type="text"  value="<?php print($postcode); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="gemeente" >Gemeente</label></div>
        <div class="col"><input name="gemeente" type="text"  value="<?php print($woonplaats); ?>"></div>
    </div>
    <div class="row">
        <div class="col"><label  for="isSuperUser" >Superuser?</label></div>
        <div class="col"><input name="isSuperUser" id="isSuperuser" type="checkbox" <?php if($isSuperuser){print("checked");} ?> ></div>
    </div>
    <div class="row">
        <div class="col"><label  for="heeftKorting" >Heeft korting?</label></div>
        <div class="col"><input name="heeftKorting" id="heeftKorting" type="checkbox" <?php if($heeftKorting){print("checked");} ?>></div>
    </div>
    <div class="row">
        <div class="col"><label  for="isTijdelijkeUser" >Is tijdelijke user?</label></div>
        <div class="col"><input name="isTijdelijkeUser" id="isTijdelijkeUser" type="checkbox" disabled <?php if($isTijdelijkeUser){print("checked");} ?>></div>
    </div>

    <div class="row">
        <div class="col"><label  for="email" class="showOnJoin">e-mail</label></div>
        <div class="col"><input name="email" class="showOnJoin" type="text"  value="<?php print($email); ?>"></div>
    </div>
    <div class="row">
        <input type="submit" name="annuleerWijziging" value="Annuleer">
        <?php
            if(!$isTijdelijkeUser){
                if($id!=""){ ?>
                    <input type="submit" name="updateEntity" value="Opslaan">
                    <input type="submit" name="deleteEntity" value="Verwijder">
                <?php }else{ ?>
                    <input type="submit" name="insertEntity" value="Toevoegen">
                <?php }
                }
            else{?>
                <input type="submit" name="deleteEntity" value="Verwijder">
        <?php
                print("'tijdelijke' klanten kunnen niet aangepast worden");
          }?>

    </div>
</form>
</div>
