<?php
if(isset($_POST['go'])){
  if( isset($_POST['fruit']) && is_array($_POST['fruit']) ) {
    foreach($_POST['fruit'] as $fruit) {
        // eg. "I have a grapefruit!"
        echo "I have a {$fruit}!";
        // -- insert into database call might go here
    }
   // if you selected apple and grapefruit it would display apple,grapefruit
}

}?>
<form method="post">
Select your favorite fruit:<br />
<input type="checkbox" name="fruit[]" value="apple" id="apple" /><label for="apple">Apple</label><br />
<input type="checkbox" name="fruit[]" value="pinapple" id="pinapple" /><label for="pinapple">Pinapple</label><br />
<input type="checkbox" name="fruit[]" value="grapefruit" id="grapefruit" /><label for="grapefruit">Grapefruit</label><br />
<input type="submit" name="go" />
</form>
