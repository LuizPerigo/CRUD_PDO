<?php
  require_once 'pessoa.php';
  $p = new Pessoa("crudpdo", "localhost", "root", "");
  $input = $_POST;
  $erro = false;
?>
  <!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta name="viewport" content="width=device-width, initial">
  <meta charset="utf-8">
  <title>Cadastro Pessoa</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
  if(isset($_POST['nome']))// clicou no botão cadastrar ou editar
  {
    //----------Editar
    if(isset($_GET['id_update']) && !empty($_GET['id_update']))
    {
      $id_upd = addslashes($_GET['id_update']);
      $nome = addslashes($_POST['nome']);
      $telefone = addslashes($_POST['telefone']);
      $email = addslashes($_POST['email']);
      if(!empty($nome) && !empty($telefone) && !empty($email))
      {
        $p->atualizarDados($id_upd, $nome, $telefone, $email);
        header("Location: index.php");
      }
      //------------Cadastrar
    }else{

      $nome = addslashes($_POST['nome']);
      $telefone = addslashes($_POST['telefone']);
      $email = addslashes($_POST['email']);
      if(!empty($nome) && !empty($telefone) && !empty($email))
      {
        if (!$p->cadastrarPessoa($nome, $telefone, $email))
        {
          echo "Email já está cadastrado";
        }
        
      }else
      {
        echo "Preencha todos os campos";
      }
    }
  }
?>
<?php
  if(isset($_GET['id_update']))
  {
    $id_update = addslashes($_GET['id_update']);
    $res = $p->buscarDadosPessoa($id_update);
  }
?>
  <section id="Esquerda">
    <form method="POST">
      <h2 align="center">Cadastrar Pessoa</h2>
      <label for="nome">Nome</label>
      <input type="text" name = "nome" id = "nome" 
      value= "<?php if(isset($res)){echo $res['nome'];}?>"
      >
      <label for="telefone">Telefone</label>
      <input type="text" name = "telefone" id = "telefone" 
      value = "<?php if(isset($res)){echo $res['telefone'];}?>"
      >
      <label for="email">Email</label>
      <input type="email" name = "email" id = "email" 
      value = "<?php if(isset($res)){echo $res['email'];}?>"
      >
      <input type="submit" value = "<?php if(isset($res)){echo "Atualizar";}else{ echo "Cadastrar";}?>"
      >
    </form>
  </section>

  <section id="Direita">
    <table>
      <tr id="titulo">
        <td>NOME</td>
        <td>TELEFONE</td>
        <td colspan = "2">EMAIL</td>
      </tr>
    <?php
      $dados = $p->buscarDados();
      if(count($dados) > 0)
      {
        for ($i=0; $i < count($dados); $i++)
        {
          echo "<tr>";
          foreach($dados[$i] as $k => $v)
          {
            if ($k != "id")
            {
              echo "<td>".$v."</td>";

            }
          }
          ?>
          
          <td>
            <!--<?php echo $dados[$i]['id']; ?>-->
            <a href="index.php?id_update=<?php echo $dados[$i]['id']; ?>">Editar</a>
            <a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a>
          </td>
          <?php
          echo "</tr>";
        }
      }else
      {
        echo "Ainda não há pessoas cadastradas";
      }
    ?>
      </tr>
    </table>
  </section>


</body>
</html>
<?php
  if (isset($_GET['id']))
  {
    $id_pessoa = addslashes($_GET['id']);
    $p->excluirPessoa($id_pessoa);
    header("location: index.php");

  }
?>