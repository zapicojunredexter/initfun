<?php

session_start();
require_once '../Owner/php_action/db_connect.php'; 
//require_once '../functions.php';
?>
<link rel="stylesheet" href="css/mobiscroll.javascript.min.css">
    <script src="js/mobiscroll.javascript.min.js"></script>
    
    <?php
    
        $cartItemsId=array();
        $cartItemNames=array();
        foreach($_SESSION as $name => $value){
            if(substr($name, 0, 5) == 'cart_'){
                $id = substr($name, 5, (strlen($name)-5));
                echo "naa SI".$id;
                $query3 = mysqli_query($connect, "SELECT * from product WHERE id = $id");
                $data3 = mysqli_fetch_array($query3); 
                array_push($cartItemsId,$data3['id']);
                array_push($cartItemNames,$data3['product_name']);
            }
        }   
        $jsonString = "[";
        for($i = 0;$i<count($cartItemsId);$i++){
            echo $i;
            $jsonString = $jsonString.'{'.'"name":"'.$cartItemNames[$i].'","id":'.$cartItemsId[$i].'},';
        }
        $jsonString = substr($jsonString, 0, -1);
        $jsonString = $jsonString."]";
	?>
							
<div mbsc-page class="demo-multiday">
    <div mbsc-form>
        <div class="mbsc-form-group">
            <label>
                Counter
                <input onchange="handleChangeDates(this.value)" id="count" placeholder="Please Select..." />
            </label>
            
            


<div id="dates-quantity"></div>

        </div>
    </div>
</div>
<?php echo $jsonString;?>
<script>

    mobiscroll.settings = {
        theme: 'ios',                    // Specify theme like: theme: 'ios' or omit setting to use default
        lang: 'en'                       // Specify language like: lang: 'pl' or omit setting to use default
    };
    mobiscroll.calendar('#count', {
        select: 'multiple',              // More info about select: https://docs.mobiscroll.com/4-3-2/javascript/calendar#opt-select
        counter: true                    // More info about counter: https://docs.mobiscroll.com/4-3-2/javascript/calendar#opt-counter
    });

    function handleChangeDates(values){
        document.getElementById('dates-quantity').innerHTML = "";
        var dates = values.replace(/\s/g, '');
        var datesArray = dates.split(',');
        
        var cartItems = `<?php echo $jsonString;?>`;
        var cartJSON = JSON.parse(cartItems);
        console.log(cartItems,cartJSON);


        for(let i = 0; i < datesArray.length; i++ ){

            let inputDate = document.createElement("input");
            inputDate.type = "text";
            inputDate.name = "date-"+i;
            inputDate.value = datesArray[i];


            let inputSelect = document.createElement("select");
            inputSelect.name = "product-id-"+i;
            for(let j = 0; j< cartJSON.length;j++){
                let inputSelectOption = document.createElement("option");
                inputSelectOption.value = cartJSON[j].id;
                inputSelectOption.innerHTML = cartJSON[j].name;
                inputSelect.appendChild(inputSelectOption);
            }

            let inputQuantity = document.createElement("input");
            inputQuantity.type = "number";
            inputQuantity.name = "product-quantity-"+i;
            
            document.getElementById('dates-quantity').appendChild(inputDate);
            document.getElementById('dates-quantity').appendChild(inputSelect);
            document.getElementById('dates-quantity').appendChild(inputQuantity);
            document.getElementById('dates-quantity').appendChild(document.createElement("br"));
        }  
    }
</script>

