<!-- Alert Container -->
<div id="alertContainer1" style="position: fixed; top: 20px; right: 20px; z-index: 100000;">
</div>

<style>
  .alert-custom {
/*    display:none;*/
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 100000;
  }
</style>
<script>
function showAlert(message, type) {
    
    //alert("hi");

    var alertContainer = document.getElementById('alertContainer');
    var alertBox = document.createElement('div');
    alertBox.className = 'alert alert-'+type+' alert-dismissible show alert-custom';
    alertBox.role = 'alert';


    
    alertBox.innerHTML = `
      ${message}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    `;

    alertContainer.appendChild(alertBox);
    $(alertBox).fadeIn();

    setTimeout(function() {
      $(alertBox).fadeOut(function() {
        alertBox.remove();
      });
    }, 3000);
  };
  </script>  


 
<script>
function search_list_product(dopage){

var activelm=document.activeElement;
var activelmidd=document.activeElement.id;
var parntx = activelm.parentElement;
var dropelmnt=parntx.getElementsByTagName('div')[0];

var search_entry=activelm.value;	
//alert(search_entry);
if(search_entry=="")
dropelmnt.style.display="none";
//var search_entry="TELL";
var htmlinn="";
var i=0;
var dataval=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/doactive.php",
		data: {dopageval: dopage, searchval: search_entry},
		
        async: false
    }).responseText);



htmlinn='<a href="javascript:void(0)" class="allist" onclick="sel_product(\''+search_entry+'\',\''+search_entry+'\',\''+activelmidd+'\')">'+search_entry+'</a>';
if(dopage=='products')
{
for (i=0; i<dataval.length; i++)	
htmlinn=htmlinn+'<a href="javascript:void(0)" class="allist" onclick="sel_product(\''+dataval[i].pid+'\',\''+dataval[i].name+'\',\''+activelmidd+'\')">'+dataval[i].name+'</a>';
}


dropelmnt.innerHTML=htmlinn;	

if(dataval.length)
dropelmnt.style.display="block";	

if(search_entry=="")
dropelmnt.style.display="none";



};




function sel_product(pid,name,activelm)
{

var activelm=document.getElementById(activelm);
var parntx = activelm.parentElement;
var dropelmnt=parntx.getElementsByTagName('div')[0];
dropelmnt.innerHTML="";	
dropelmnt.style.display="none";	
activelm.value=name;


var stockval=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/do_stock.php",
		data: {searchval: pid , searchname: name},
		
        async: false
    }).responseText);

var dataval1=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/doselpdt.php",
		data: {searchval: pid},
		
        async: false
    }).responseText);
	
	
	


	
var stock_html='<div class="table-responsive"><table class="table table-striped"><thead><tr class="headings"><th class="column-title">Batch</th><th class="column-title">Expdate</th><th class="column-title">Mrp</th><th class="column-title">Stock</th><th class="column-title">Added On</th></tr></thead><tbody>';

var stock_total=0;
for(i=0;i<stockval.length;i++){
	
stock_html=stock_html+'<tr><td>'+stockval[i].batch+'</td><td>'+stockval[i].expdate+'</td><td>'+stockval[i].mrp+'</td><td>'+stockval[i].stock+'</td><td>'+stockval[i].add_date+'</td></tr>'; 
stock_total=stock_total+stockval[i].stock;
}
stock_html=stock_html+'<tbody></table>';
stock_total=parseFloat(stock_total).toFixed(0);

var stock_inhtml="";
if(stock_total<1)
stock_total='Out of Stock';

else
stock_inhtml='<li>'+stock_html+'</li>';
	

//alert(JSON.stringify(dataval1))	;
document.getElementById("ser_pdt_info").innerHTML='<ul class="to_do"><li><b>Product Name:</b> '+dataval1.name+'</li><li><b>Manufacturer:</b> '+dataval1.mfr+'</li><li><b>Total Stock:</b> '+stock_total+'</li>'+stock_inhtml+'</ul>';
};

</script>



<!-- The Modal Manufacturer -->
<div id="myModalclose" class="modal_new">

  <!-- Modal content -->
<div class="modal-content_new">
 
<div class="">
 
<img src="images/3.gif">


</div>


</div>
</div>

<!-- The Modal Manufacturer -->
<div id="myModal3" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="close_modal();">&times;</span>
            <h2>Set Price</h2>
        </div>
        <div class="modal-body">
            
            <div class="x_panel">
                <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <label>Your Actual Selling Price</label>
        <input type="text" class="form-control tab-control" id="price" name="price" oninput="add_price();" placeholder="Enter Price" />
    </div>

    <!-- Discount -->
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <label>Discount Percentage</label>
        <input type="text" class="form-control tab-control" id="discount" name="discount" oninput="add_price();" placeholder="Enter Discount" />
    </div>

           
        <!-- Commission -->
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <label>Commission Percentage</label>
        <input type="text" class="form-control tab-control" id="commission" name="commission" oninput="add_price();" placeholder="Enter Commission" readonly/>
    </div>

    <!-- Tax -->
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <label>Tax Percentage (GST + TCS)</label>
        <input type="text" class="form-control tab-control" id="tax" name="tax" oninput="add_price();" placeholder="Enter Tax" readonly/>
    </div>

    <!-- Total Price -->
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <label>Total Price</label>
        <input type="text" class="form-control tab-control" id="totalSetPrice" name="totalSetPrice" readonly placeholder="Total Price will be calculated" />
    </div>
                    <!-- Add Button -->
<div id="add_price_button" class="col-md-12 col-sm-12 col-xs-12 form-group">
    <button class="btn btn-success" onclick="close_modal();">Set Price</button>
</div>

                </div>
            </div>
            
        </div>
    </div>
</div>


<div id="myModal4" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="close_modal();">&times;</span>
            <h2>Set Shipping Setings</h2>
        </div>
        <div class="modal-body">
            <div class="x_panel">
                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
        <label>Select Shipping Choice</label>
    <select type="text" class="form-control tab-control" id="ship_set"  onchange="set_shipping();">
    <option value="0">No shipping Needed (Ship Yourself)</option>
    <option value="1">Shipping Needed (Shipping is Linked)</option>
 
    </select>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="" id="manual_ship_menu">
        <label>Your Shipping Charge (in Rs)</label>
        <input type="text" class="form-control tab-control" id="manual_ship_charge" oninput="set_shipping();" placeholder="Enter Shipping Charge in Rs" />
    </div>
                    
                    
                    
    <!-- Discount -->
    <div class="col-md-12 col-sm-12 col-xs-12 form-group" style="display:none;" id="weight_menu">
        <label>Product Weight in grams</label>
        <input type="number" class="form-control tab-control" id="weight" oninput="calc_shipping();" placeholder="Enter Weight" />
    </div>

                </div>
<div class="row">
    <!-- Shipping Charge -->
    <div class="col-md-4 col-sm-4 col-xs-4 form-group" style="display:none;" id="length_menu">
        <label>Enter Dimensions in cm (LxWxH)</label>
        <input type="number" class="form-control tab-control" id="length" oninput="calc_shipping();" placeholder="Enter Length " />
    </div>
                    
    <!-- Shipping Charge -->
    <div class="col-md-4 col-sm-4 col-xs-4 form-group" style="display:none;" id="width_menu">
        <label>&nbsp;</label>
        <input type="number" class="form-control tab-control" id="width" oninput="calc_shipping();" placeholder="Enter Width" />
    </div>
    
        <!-- Shipping Charge -->
    <div class="col-md-4 col-sm-4 col-xs-4 form-group" style="display:none;" id="height_menu">
      <label>&nbsp;</label>
        <input type="number" class="form-control tab-control" id="height" oninput="calc_shipping();" placeholder="Enter Height" />
    </div>
     
   
    
  </div>
    <div class="row">            
  <div class="col-md-6 col-sm-12 col-xs-12 form-group" style="display:none;" id="shipping_partner_menu">
        <label>Shipping Partner</label>
        <select  class="form-control tab-control" id="shipping_partner" readonly onchange=" sel_item(this.value);"></select>
      <input type="hidden" id="pickup_available" value="0">
    </div>
        
   
        
    <!-- Total Price -->
    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
        <label>Total Shipping Charge</label>
        <input type="text" class="form-control tab-control" id="shipping_price" readonly placeholder="Total Price will be calculated" value="0"/>
    </div>
                    <!-- Add Button -->
<div id="add_price_button" class="col-md-12 col-sm-12 col-xs-12 form-group" style="display: flex; align-items: center; gap: 10px;">
    <button class="btn btn-success" onclick="close_shipping();">Submit</button>
    <div id="pickup_status"></div>
</div>

                </div>
                
                
<div class="row" id="shipping_partners_list" style="display:none;">
  <h2>Select a Shipping Partner</h2>
<table id="shippingTable">
    <thead>
        <tr>
           
            <th rowspan="2">Shipping Partner</th>
            <th colspan="2">With in State</th>
            <th colspan="2">Other State</th>
      
        </tr>
              <tr>
           
    
            <th >fisrt 500gm</th>
            <th >additional 500gms</th>
              <th >first 500gm</th>
            <th >additional 500gms</th>
        </tr>
    </thead>
    <tbody></tbody>
</table> 
      <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr.selected {
            background-color: #d1e7fd !important;
        }
        img {
            width: 80px;
            height: auto;
        }
    </style>
</div>
                
            </div>
            
            
            
        </div>
    </div>
</div>




<script>
    
function get_shippings()
    {
        
     //  alert('hi');
        
      var dataval1=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/get_shippings.php",
		data: {},
		
        async: false
    }).responseText);
        
        
       // alert(JSON.stringify(dataval1));
        let tableBody = $("#shippingTable tbody");
        let selectInput = $("#shipping_partner");
        tableBody.empty(); // Clear previous data

        dataval1.forEach(item => {
            let row = `
                <tr id="item_${item.id}" onclick="sel_item('${item.id}')" class="items">
                    
                    <td>${item.name}</td>
                    <td id="baseCh_${item.id}">${item.state} </td>
                    <td id="addCh_${item.id}">${item.additional_state}</td>
                    <td>${item.other_state}</td>
                    <td>${item.additional_other_state} </td>
                 
                </tr>
            `;
            tableBody.append(row);
            
             let option = `<option value="${item.id}">${item.name}</option>`;
    selectInput.append(option);
            
        });
        
        //document.getElementById('tax').value=dataval1.tax;
   sel_item('1');
        
    };
    
function sel_item(id,flag)
{
//alert(id);
var allRows = document.querySelectorAll('.items');
allRows.forEach(row => {
row.classList.remove('selected');
});
    
var row = document.getElementById('item_' + id);
if (!row.classList.contains('selected')) 
row.classList.add('selected');
else
row.classList.remove('selected');
    
document.getElementById('shipping_partner').value=id;
calc_shipping();
    check_pickup();
};
    
function calc_shipping()
{
var numid; 
var allRows = document.querySelectorAll('.items');
allRows.forEach(row => {
   
    if (row.classList.contains('selected')) {
        var rowId = row.id;
        numid = rowId.split('_')[1];
        
    }

});

//alert(numid); 
    
const weight=Math.round(parseFloat(document.getElementById('weight').value || 0));
const length=Math.round(parseFloat(document.getElementById('length').value || 0));
const width=Math.round(parseFloat(document.getElementById('width').value || 0));
const height=Math.round(parseFloat(document.getElementById('height').value || 0));
    
document.getElementById('weight').value =weight;
document.getElementById('length').value =length;
document.getElementById('width').value =width;
document.getElementById('height').value =height;
    
const volume = length* width * height;
//    alert(volume); 

    
const volumetricWeight = (volume / 2500) * 500;
const weightToUse = Math.max(parseFloat(weight), parseFloat(volumetricWeight));


    
const basegmCharge = parseFloat(document.getElementById('baseCh_'+numid).innerHTML);
const additional_gm_charge = parseFloat(document.getElementById('addCh_'+numid).innerHTML);
 

    
var additionalCharge=0;
//alert(weightToUse);

if(weightToUse>500)
{

const extraWeight = parseFloat(weightToUse) - 500;
 //alert(extraWeight);   
additionalCharge = Math.ceil((parseFloat(extraWeight) / 500)) * parseFloat(additional_gm_charge);
//alert(additionalCharge); 

}

const totalCharge = parseFloat(basegmCharge) + parseFloat(additionalCharge);
    
 document.getElementById('shipping_price').value=totalCharge;
 document.getElementById('shipping_charge').value=totalCharge;
set_display_price();
    
};
    
function set_display_price()
{
 var checkbox = document.getElementById("setdisplayprice");
   if (checkbox.checked) {
    var price=document.getElementById('totalPrice').value ||0;
    var ship_price=document.getElementById('shipping_charge').value||0;
    
    var display_price=  parseFloat(price)+parseFloat(ship_price);
    document.getElementById('displayPrice').value=  display_price;
        document.getElementById('display_price_id').value=display_price;
       document.getElementById('noshipping_id').value="1";
       document.getElementById('noshippingcharge').value="1";
    } else {
        var price=document.getElementById('totalPrice').value||0;
         document.getElementById('displayPrice').value=  price;
        document.getElementById('display_price_id').value=price;
        document.getElementById('noshipping_id').value="0";
        document.getElementById('noshippingcharge').value="0";
    }
    

    edit_product();
};
    
function get_tax_commission()
    {
        
       
        
      var dataval1=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/get_tax_commission.php",
		data: {},
		
        async: false
    }).responseText);
        
        
        //alert(JSON.stringify(dataval1));
        
        document.getElementById('tax').value=dataval1.tax;
        document.getElementById('commission').value=dataval1.commission;
        
         btnmodalclick('myModal3', '');
    
    set_display_price();    
    };
function close_shipping()
    {
       set_shipping();  
    set_display_price();
   edit_product();
        
   var pickup_status = document.getElementById('pickup_available').value;
        
    //alert(pickup_status);
    if(pickup_status=="1")  
    close_modal();
       
    else{
        var ship_Set_val=document.getElementById('ship_set').value;
        if(ship_Set_val=="1")
        showAlert("Please Choose Another Shipping partner", "danger");
        else
        showAlert("Please input Shipping Charge", "danger");   
    }
       
    }
function set_shipping()
    {
    var ship_set=document.getElementById('ship_set').value;
    if(ship_set=='0')
    {
    
document.getElementById('weight_menu').style.display='none';
document.getElementById('length_menu').style.display='none';
document.getElementById('width_menu').style.display='none';
document.getElementById('height_menu').style.display='none';
document.getElementById('shipping_partners_list').style.display='none';
document.getElementById('shipping_partner_menu').style.display='none';


document.getElementById('manual_ship_menu').style.display='';
var ship_price=document.getElementById('manual_ship_charge').value;
document.getElementById('ship_manual_charge').value=ship_price;
      
document.getElementById('ship_setting').value="0";
    
    
    
            document.getElementById('shipping_price').value=ship_price;
        document.getElementById('shipping_charge').value=ship_price;
        add_price();
        
        document.getElementById('pickup_available').value="1";
        document.getElementById('pickup_status').innerHTML="";
    }
    else
        {
            get_shippings();
            document.getElementById('manual_ship_menu').style.display='none';
document.getElementById('weight_menu').style.display='';
document.getElementById('length_menu').style.display='';
document.getElementById('width_menu').style.display='';
document.getElementById('height_menu').style.display='';
 document.getElementById('shipping_partners_list').style.display='';
 document.getElementById('shipping_partner_menu').style.display='';
            
        var weight=document.getElementById('weight').value;
        var length=document.getElementById('length').value;
        var width=document.getElementById('width').value;
        var height=document.getElementById('height').value;

     //alert(weight);       
document.getElementById('ship_weight').value=weight;
document.getElementById('ship_length').value=length;
document.getElementById('ship_width').value=width;
document.getElementById('ship_height').value=height;
document.getElementById('ship_setting').value="1";

        //api request go here
        //var ship_price=40;
        
            
        }
        
    
     set_display_price();  
        
    }

function list_product_modal(dopage,id){
	
var activelm=document.activeElement;
var activelmidd=document.activeElement.id;
var parntx = activelm.parentElement;
var dropelmnt=parntx.getElementsByTagName('div')[0];

var search_entry=activelm.value;	

if(search_entry=="")
dropelmnt.style.display="none";
//var search_entry="TELL";
var htmlinn="";
var i=0;
var dataval=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/doactive.php",
		data: {dopageval: dopage, searchval: search_entry},
		
        async: false
    }).responseText);

htmlinn='<a href="javascript:void(0)" class="allist" onclick="sel_pdct_mod(\'\',\''+search_entry+'\',\''+activelmidd+'\')">'+search_entry+'</a>';
if(dopage=='products')
{
	
for (i=0; i<dataval.length; i++)	
htmlinn=htmlinn+'<a href="javascript:void(0)" class="allist" onclick="sel_pdct_mod(\''+dataval[i].pid+'\',\''+dataval[i].name+'\',\''+activelmidd+'\')">'+dataval[i].name+'</a>';
}


if(dopage=='mfrs')
{
for (i=0; i<dataval.length; i++)	
htmlinn=htmlinn+'<a href="javascript:void(0)" class="allist" onclick="sel_mfr_mod(\''+dataval[i].mid+'\',\''+dataval[i].name+'\',\''+activelmidd+'\')">'+dataval[i].name+'</a>';
}


if(dopage=='supplier')
{
for (i=0; i<dataval.length; i++)	
htmlinn=htmlinn+'<a href="javascript:void(0)" class="allist" onclick="sel_pdct_mod(\''+dataval[i].sup_id+'\',\''+dataval[i].name+'\',\''+activelmidd+'\')">'+dataval[i].name+'</a>';
}


dropelmnt.innerHTML=htmlinn;	

if(dataval.length)
dropelmnt.style.display="block";	

if(search_entry=="")
dropelmnt.style.display="none";

if(dataval.length<1)
dropelmnt.style.display="none";	

};






function sel_mfr_mod(mid,name,activellm,id)
{
var activelm=document.getElementById(activellm);
var parntx = activelm.parentElement;
var dropelmnt=parntx.getElementsByTagName('div')[0];
dropelmnt.innerHTML="";	
dropelmnt.style.display="none";	
activelm.value=name;
//activelm.title=name;
document.getElementById("manufacturer_mid").value=mid;
};

function sel_pdct_mod(pid,name,activellm,id)
{
var activelm=document.getElementById(activellm);
var parntx = activelm.parentElement;
var dropelmnt=parntx.getElementsByTagName('div')[0];
dropelmnt.innerHTML="";	
dropelmnt.style.display="none";	
activelm.value=name;
//activelm.title=name;

};


function dosubmit_manuf(event){
event.preventDefault();

if(!document.getElementById('manufacturer_name').value)
alert('Error: No entry to submit'); 


else{
	
var add_entry=document.getElementById('manufacturer_name').value;	
var dataval1=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/do_add_mfr.php",
		data: {dopage:'mfr', searchval: add_entry},
		
        async: false
    }).responseText);
document.getElementById('add_mfr_res').innerHTML=dataval1;
document.getElementById('manufacturer_name').value="";
document.getElementById('manufacturer_name').focus();		
}

};


function dosubmit_sup(event){
event.preventDefault();

if(!document.getElementById('supplier_name').value)
alert('Error: No entry to submit'); 


else{
	
var add_entry=document.getElementById('supplier_name').value;	
var mob_entry=document.getElementById('supplier_mob').value;
var place_entry=document.getElementById('supplier_place').value;
var dataval1=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/do_add_mfr.php",
		data: {dopage:'sup', name:add_entry,mob:mob_entry,place:place_entry},
		
        async: false
    }).responseText);
document.getElementById('add_sup_res').innerHTML=dataval1;
document.getElementById('supplier_name').value="";
document.getElementById('supplier_place').value="";
document.getElementById('supplier_mob').value="";
document.getElementById('supplier_name').focus();		
}

};


function dosubmit_pdct(event){
event.preventDefault();

if(!document.getElementById('product_name').value)
alert('Error: No Product name entry to submit'); 

else if(!document.getElementById('product_code').value)
alert('Error: No Product code entry to submit'); 


else if(!document.getElementById('product_sell_pack').value)
alert('Error: No Product Sell pack entry to submit');
else if(!document.getElementById('product_pur_pack').value)
alert('Error: No Product Purchase pack entry to submit');
else if(!document.getElementById('product_pur_price').value)
alert('Error: No Product Purchase price entry to submit');
else if(!document.getElementById('product_sell_price').value)
alert('Error: No Product Selling price entry to submit');
else if(!document.getElementById('product_sell_to_pack').value)
alert('Error: No Purchase to Sell pack entry to submit');
else{
	

var code_entry=document.getElementById('product_code').value;	
var name_entry=document.getElementById('product_name').value;

var dataval1=$.parseJSON($.ajax({
        type: "POST",
		asynch: true,
		url: "ajax/do_add_pdct.php",
		data: {name: name_entry, code: code_entry},
		
        async: false
    }).responseText);

document.getElementById('add_pdct_res').innerHTML=dataval1;
	
}

};




</script>







<script>
    
    
    function add_price() {
        //alert('hi');
    // Get input values
    var price = parseFloat(document.getElementById("price").value) || 0;
    var discount = parseFloat(document.getElementById("discount").value) || 0;
    var commission = parseFloat(document.getElementById("commission").value) || 0;
    //var shipping_charge = parseFloat(document.getElementById("shipping_charge").value) || 0;
    var tax = parseFloat(document.getElementById("tax").value) || 0;

    // Calculate discounted price
    var discounted_price = price - (price * discount / 100);

        
        
    // Calculate total price
    var totalPrice = (discounted_price) +(discounted_price)* (commission + tax)/100;

    // Set the total price in the Total Price input field
    document.getElementById("totalPrice").value = totalPrice.toFixed(2);
    document.getElementById("totalSetPrice").value = totalPrice.toFixed(2);


document.getElementById("price_id").value=price;
document.getElementById("discount_id").value=discount;
document.getElementById("commission_id").value=commission;
document.getElementById("tax_id").value=tax;

  set_display_price();  

  edit_product();     

}



function add_and_close_modal() {
    // Prepare data to be sent
    var data = {
        price: document.getElementById("price").value,
        discount: document.getElementById("discount").value,
        commission: document.getElementById("commission").value,
        shipping_charge: document.getElementById("shipping_charge").value,
        tax: document.getElementById("tax").value,
        totalPrice: document.getElementById("totalPrice").value
    };

    // Send the data using AJAX
    $.ajax({
        type: "POST",
        url: "ajax/do_add_product.php", // Server-side script to handle the data
        data: data,
        success: function (response) {
           // alert(response); // Display server response
            close_modal();
        },
        error: function (xhr, status, error) {
            alert("Error: " + error);
        }
    });
}
function check_pickup()
    {

var docpickup_status=document.getElementById('pickup_status');
 
var weight=document.getElementById('weight').value;
var length=document.getElementById('length').value;
var width=document.getElementById('width').value;
var height=document.getElementById('height').value;
var id=document.getElementById('shipping_partner').value;
docpickup_status.style.color='orange';
docpickup_status.innerHTML='<img src="images/spinner.GIF" style="height: 30px; width: 30px;">Checking Pick-Up service availability at your Pincode';
        
//alert(weight);
//alert(id);
        
    // Send the data using AJAX
    $.ajax({
        type: "POST",
        url: "ajax/do_check_pickup.php", // Server-side script to handle the data
        data: {id:id,weight:weight,width:width,height:height,length:length},
        success: function (response) {
        // alert(JSON.stringify(response)); // Display server response
            
        if(response.pick_up)
        {
docpickup_status.style.color='green';
docpickup_status.innerHTML='<img src="images/tick.png" style="height: 30px; width: 30px;">Pick-Up service available at '+response.pincode;
document.getElementById('pickup_available').value="1";
            return "true";
        }
    else
        {
docpickup_status.style.color='red';
docpickup_status.innerHTML='Pick-Up of this Shiping Partner is not available at '+response.pincode;
            document.getElementById('pickup_available').value="0";
            return "false";
        }
            
            
        },
        error: function (xhr, status, error) {
            alert("Error: " + error);
            return "false";
        }
    });
};
    
//function close_modal() {
//     alert('hello');
//
//    
//    
//    // Get the modal element
//    //var modal = document.getElementById("myModal3");
//
//    // Hide the modal
//   // modal.style.display = "none";
//    
//}

    
   
    
    
// Get the modal
var modal1 = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function btnmodalclick (id,focusid){
	
	document.getElementById(id).style.display = "block";
	document.getElementById(focusid).focus();
	document.getElementById(focusid).value="";
	
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {

var modal_class = document.getElementsByClassName("modal");
for(i=0;i<modal_class.length;i++)
document.getElementsByClassName("modal")[i].style.display = "none";
}

function close_modal(){
    
    //alert('here');
	var modal_class = document.getElementsByClassName("modal");
for(i=0;i<modal_class.length;i++)
document.getElementsByClassName("modal")[i].style.display = "none";

};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	
    if (event.target.classList[0] == "modal") {
var modal_class = document.getElementsByClassName("modal");
for(i=0;i<modal_class.length;i++)
document.getElementsByClassName("modal")[i].style.display = "none";
    }
}


document.addEventListener("keydown", function(event)
{
var x = event.which || event.keyCode;
if(x=="27")
{
var modal_class = document.getElementsByClassName("modal");
for(i=0;i<modal_class.length;i++)
document.getElementsByClassName("modal")[i].style.display = "none";
};
	
});


document.addEventListener("keydown", function(event) {

var x = event.which || event.keyCode;

var activelm=document.activeElement;
var parntx = activelm.parentElement;
var dropelmnt=parntx.getElementsByTagName('div')[0];



if(x=='40')
{
var actvelm=document.getElementsByClassName("dropdownactive");

if(!actvelm.length)
dropelmnt.firstChild.classList.add("dropdownactive");

else
{
//alert('here');
actvelm[0].nextElementSibling.classList.add("dropdownactive");
actvelm[0].nextElementSibling.focus();	
activelm.focus();	
actvelm[0].classList.remove("dropdownactive");
}
}	



else if(x=='38')
{
var actvelm=document.getElementsByClassName("dropdownactive");
var prelemnt=actvelm[0].previousElementSibling;

if(actvelm.length)
{
actvelm[0].classList.remove("dropdownactive");
prelemnt.classList.add("dropdownactive");	
prelemnt.focus();	
activelm.focus();	
}
}	

else if (x == '13') 
{
var actvelm=document.getElementsByClassName("dropdownactive");
actvelm[0].click();
}

else if (x =='18') 
btnmodalclick('myModal','product_search_input');

	
});




</script>



<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    -webkit-animation-name: fadeIn; /* Fade in the background */
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s
}
.modal_new{
    display:none ; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: auto; /* Full width */
    height: auto; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    -webkit-animation-name: fadeIn; /* Fade in the background */
    -webkit-animation-duration: 0.4s;
    animation-name: fadeIn;
    animation-duration: 0.4s
}
.modal-content_new {
    position: fixed;
    top: 50%;
	left:50%;
    //background-color: #fefefe;
    width: auto;
	
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s
}
/* Modal Content */
.modal-content {
    position: fixed;
    top: 30px;
	left:10%;
    background-color: #fefefe;
    width: 80%;
	
    -webkit-animation-name: slideIn;
    -webkit-animation-duration: 0.4s;
    animation-name: slideIn;
    animation-duration: 0.4s
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #003366;
    color: white;
}

.modal-body {
padding: 2px 16px;
overflow:scroll; 
max-height:570px;

	min-height: 80vh;
}

.modal-footer {
    padding: 2px 16px;
    background-color: #003366;
    color: white;
}

/* Add Animation */
@-webkit-keyframes slideIn {
    from {top: -300px; opacity: 0} 
    to {top: 30px; opacity: 1}
}

@keyframes slideIn {
    from {top: -300px; opacity: 0}
    to {top: 30px; opacity: 1}
}

@-webkit-keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
}

@keyframes fadeIn {
    from {opacity: 0} 
    to {opacity: 1}
}
</style>


<style>
.dropdwn_anm{
	
}


.dropdown-content {

background-color: #fff;
z-index: 11;
box-shadow: 0 2px 4px 0 rgba(0,0,0,.5),0 2px 4px 0 rgba(0,0,0,.5);
border-top-right-radius: 0;
border-top-left-radius: 0;
border-bottom-left-radius: 4px;
border-bottom-right-radius: 4px;
border: 1px solid #b7bcc0;
visibility: visible !important;
  display: block;
  position: absolute;
  width:98%;
  border: 1px solid #ddd;

  
/*margin-top:50px*/
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 4px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: grey; font-weight:bold;}

.dropdownactive{
background-color: grey; font-weight:bold;
}
</style>			