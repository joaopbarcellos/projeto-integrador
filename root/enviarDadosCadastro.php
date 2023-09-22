<?php
      $verifica = false;
      if(isset($_POST["nomeCampo"])){
        $nome = $_POST["nomeCampo"];
        if(!empty($nome)){
          $nomeFiltrado = filter_var(trim($nome), FILTER_SANITIZE_SPECIAL_CHARS);
          $verifica = true;
        }else{
          $verifica = false;
        }
      }else{
        $verifica = false;
      }

      if(isset($_POST["emailCampo"])){
        $email = $_POST["emailCampo"];
        if(!empty($email)){
          if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailFiltrado = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
            $verifica = true;
          }else{
            $verifica = false;
          }
        }else{
          $verifica = false;
        }
      }else{
        $verifica = false;
      }
      if(isset($_POST["telefoneCampo"])){
        $telefone = $_POST["telefoneCampo"];
        if(!empty($telefone)){
            $telefoneFiltrado = filter_var(trim($telefone), FILTER_SANITIZE_NUMBER_INT);
            $verifica = true;
        }else{
          $verifica = false;
        }
      }else{
        $verifica = false;
      }
      if($verifica){
        $scrpt = "<script>alert('Dados salvos no banco de dados');</script>";
        header("location: login.php?$scrpt");
      }
    ?>