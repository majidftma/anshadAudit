<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Change Password</h3>
<?php 
$eid=$session_usereid;
$where=array(array(eid,$eid,STR));
$ok=0;
$pass=$_POST['password'];
$npass=$_POST['npass'];
$rpass=$_POST['rpass'];

$realpass=getfield(members,eid,$eid,STR,password);  

if($_POST)
{
if($realpass!=$pass)
{
$ok=0;
echo "Current Password is not correct";
}

elseif($npass!=$rpass)
{
$ok=0;
echo "New Password not matching with retype password";
}

else
{
$ok=1;

$value=array(array(password,$npass,STR));
updaterow(members,$value,$where);
echo "Password Changed";



}
}
?>
              </div>

             
            </div>
            <div class="clearfix"></div>
            
            
            
            
            <div class="row">
            
                   <div class="col-md-5 col-sm-5 col-xs-12 ">
                  
                  
               
                    
                    
                    <div class="x_content">

                    <!-- start form for validation -->
                    <form action="<?php echo encrypt_url('password'); ?>" method="post" id="demo-form" data-parsley-validate>
                      <label for="fullname">Current Password * :</label>
                      <input type="password" id="fullname" class="form-control" name="password" required />

                      <label for="email">New Password * :</label>
                      <input type="password" id="email" class="form-control" name="npass" data-parsley-trigger="change" required />


<label for="email">Re-type New Password * :</label>
                      <input type="password" id="email" class="form-control" name="rpass" data-parsley-trigger="change" required />


                          <br/>
                          <input class="btn btn-primary" type="submit" value="Submit"/>

                    </form>
                    <!-- end form for validations -->
                    
                    
                    

                  </div>



                      
            </div>
            
 </div> 
            

              </div>
            </div>
        
        <!-- /page content -->