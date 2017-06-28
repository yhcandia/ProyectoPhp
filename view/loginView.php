<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Pañol</title>
  <link rel="stylesheet" href="view/css/styleLogin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>	
    <div style="height: 100%;position:relative">
    <div style="position: relative;top:0;width: 100%;height: 60px;background-color: #404040;text-align: center;border-bottom:solid 5px #ffffff">
        <div style="position: relative;top:10px;font-size: 200%;font-weight:bold; height: 100%; width: 100%;">BUFETE DURALEX
        </div>
  
    </div>
    <div id="login" style="height: 80.6%;position: relative" >
        <form id="login_form"  action="<?php echo $helper->url("usuarios","login"); ?>" method="post">
            <div class="field_container">
              <input type="text" name="nnombre" placeholder="Rut" required>
            </div>
    
            <div class="field_container">
              <input type="Password" name="npassword" placeholder="Contraseña" required>

            </div>
            <div class="field_container">

                <label><?php echo "<font color=red>{$error}</font>"; ?></label> 

            </div> 
            <div  class="field_container">
                <center>
                    <button id="sign_in_button">
                    <span class="button_text">Ingresar</span>
                  </button>
                 </center>
            </div>     
        </form>
    </div>
    </div>
</body>  
</html>
