jQuery(document).ready(function($) {

  // Header fixed and Back to top button
  var dates = [];
    
    $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
      $('#header').addClass('header-fixed');
    } else {
      $('.back-to-top').fadeOut('slow');
      $('#header').removeClass('header-fixed');
    }
  });
  $('.back-to-top').click(function(){
    $('html, body').animate({scrollTop : 0},1500, 'easeInOutExpo');
    return false;
  });

  // Initiate the wowjs
  new WOW().init();

  // Initiate superfish on nav menu
  $('.nav-menu').superfish({
    animation: {opacity:'show'},
    speed: 400
  });
    $('#calendar').datepicker({
        todayHighlight: true,
        multidate: true,
        multidateSeparator: ","
    });
    $('#calendar').on('changeDate', function() {
       $('#dates').val(
           $('#calendar').datepicker('getFormattedDate')
       );
        
        if($('#dates').val()=="") {
            $('#calendarConf').attr('disabled', 'disabled');
        }else{
            $('#calendarConf').removeAttr('disabled');
        }
    });
    
    $('#confPurchase').hide();
    $('#calendar').hide();
    
    $('#showCalendar').click(function(){
        $('#confPurchase').show();
        $('#calendar').show();
    })
    
   $(':checkbox').change(function(){
       var count = (this.id).split('_')[1];
       var idx = (this.id).split('.')[0];
       var itemName = (this.value);
       var inputbox = document.getElementById(idx+'.qty_'+count);
       if($(inputbox).val() === ""){
           $(inputbox).removeAttr('style disabled');
           $(inputbox).val(1);
           dates.push({
               date: $('#'+idx).text(),
               item: itemName,
               qty: 1,
               price: 0
           });
       }else{
           $(inputbox).attr({
               disabled: 'disabled',
               style: 'cursor:not-allowed;'
           });
           $(inputbox).val("");
           for(var i = 0 ; i < dates.length && dates[i].item !== itemName ; i++){}
           dates.splice(i, 1);
       }
   });
    
    $('#checkout').attr('disabled', 'disabled');
    
    function computeGrandTotal(){
        var grandTotal = 0;
        var result = true;
        
        for(var i = 0 ; result === true ; i++){
            if($('#'+i+'_total').text() !== ""){
                var total = document.getElementById(i+'_total');
                grandTotal += parseInt($(total).text().replace('P', ''));
            }else{
                result = false;
            }
        }
        
        $('#tax').val(grandTotal);
        $('#grand_total').text('P'+(grandTotal + (grandTotal * 0.13)));
        
        if($('#grand_total').text() !== 'P0'){
            $('#checkout').removeAttr('disabled');
        }else{
            $('#checkout').attr('disabled', 'disabled');
        }
    }
    
   $('.purchasing').click(function(){
       var count = (this.id).split('_')[1];
       var idx = (this.id).split('.')[0];
       var total = 0;
       var price = 0;
       var qty = 0;
       var grandTotal = 0;
       
       for(var i = 0 ; i < count ; i++){
           var priceInpt = document.getElementById(idx+'.price_'+i);
           var qtyInpt = document.getElementById(idx+'.qty_'+i);
           price = ($(priceInpt).text() !== "") ? parseInt($(priceInpt).text().replace('P', '')) : 0;
           qty = $(qtyInpt).val();
           total += qty*price;
       }
       
       if(total !== 0){
        $('#'+idx+'_total').text('P'+total);
       }else{
        $('#'+idx+'_total').text('P0');
       }
       
        console.log(dates);
       computeGrandTotal();
   });
    
    $('.qtyInp').focusout(function(){
        var idx = (this.id).split('.')[0];
        var date = $(idx).text();
        var item = document.getElementById(idx+'.chckbox_'+i).value;
        
        for(var j = 0 ; j < dates.length && (dates[j].date !== date && dates[j].item !== item) ; j++){}
        dates[j].qty = qty;
    })
    
    $('.checkout').submit(function(event){
        var itemNdx = 0;
        var result = true;
        
        for(var i = 1 ; result !== false ; i++){
            var hiddenQty = document.getElementById('asd_'+i);
            if(hiddenQty === null){
                result = false;
            }else{
                var qty = 0;
                var itemNdx = i-1;
                var check = true;
                for(var inputNdx = 0 ; check !== false ; inputNdx++){
                    var asd = document.getElementById(inputNdx+'.qty_'+itemNdx);
                    if(asd === null){
                        check = false;
                    }else{
                        var zapico = $(asd).val() || 0;
                        qty += parseInt(zapico);
                    }
                }
                alert(qty);
                $(hiddenQty).val(qty);
            }
        }
    });
    
  });