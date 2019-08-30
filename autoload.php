<?php

spl_autoload_register(function ($nomeClasse) {
  $folders = array("Classes", "Testes", "Janelas", "DAO");
  foreach ($folders as $folder)
    if (file_exists($folder.DIRECTORY_SEPARATOR.$nomeClasse.".class.php"))
      require_once($folder.DIRECTORY_SEPARATOR.$nomeClasse.".class.php");
});

?>
