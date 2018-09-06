<?php

if($_SESSION['account_expiration'] < date("Y-m-d")){
?>
<div style="position: fixed; left:0;top:0;right:0;bottom:0;background-color:black;width:100%;z-index: 10;opacity:0.4;cursor:no-drop">qweeee</div>
<?php
}
?>