
<select name="select-turma" id="select-turma" class="custom-select col-md-7">
    <?php
    echo "<option value='0'>Nome da Turma</option>";
    foreach ($turmas as $key => $value) {
        if ($nomeTurma == $value->getNome()) {
            echo "<option value='".$value->getNome()."' selected>".$value->getNome()."</option>";
        }else{
            echo "<option value='".$value->getNome()."'>".$value->getNome()."</option>";
        }
    }
    ?> 
</select>