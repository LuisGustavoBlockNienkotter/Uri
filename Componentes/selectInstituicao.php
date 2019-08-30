
<select name="select-instituicao" id="select-instituicao" class="custom-select col-md-7" style="width:200px;">
    <?php
    echo "<option value='0'>Nome da Instituição</option>";
    foreach ($instituicoes as $key => $value) {
        if ($nomeIns == $value->getNome()) {
            echo "<option value='".$value->getNome()."' selected>".$value->getNome()."</option>";
        }else {
            echo "<option value='".$value->getNome()."'>".$value->getNome()."</option>";
        }
    }
    ?> 
</select>