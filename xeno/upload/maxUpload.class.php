<?php

class maxUpload{
    var $uploadLocation;
    
    function maxUpload(){
        $this->uploadLocation = getcwd().DIRECTORY_SEPARATOR;
    }

    function setUploadLocation($dir){
        $this->uploadLocation = $dir;
    }
    
    function showUploadForm($msg='',$error=''){
?>

<?php
if ($msg != ''){
    echo '<p class="msg">'.$msg.'</p>';
} else if ($error != ''){
    echo '<p class="emsg">'.$error.'</p>';

}
?>
                <form action="" method="post" enctype="multipart/form-data" >
                         <label>Archivo: <input name="myfile" type="file" size="30" /></label>
                         <label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /></label>
                 </form>
<?php
    }

    function uploadFile(){
        if (!isset($_POST['submitBtn'])){
            $this->showUploadForm();
        } else {
            $msg = '';
            $error = '';
            
            //Check destination directory
            if (!file_exists($this->uploadLocation)){
                $error = "¡El directorio de destino no existe!";
            } else if (!is_writeable($this->uploadLocation)) {
                $error = "¡No se puede escribir en el directorio destino!";
            } else {
                $target_path = $this->uploadLocation . basename( $_FILES['myfile']['name']);

                if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
                    $msg = basename( $_FILES['myfile']['name']).
                    " subido con exito.";
                } else{
                    $error = "¡Ha habido un problema!";
                }
            }

            $this->showUploadForm($msg,$error);
        }

    }

}
?>