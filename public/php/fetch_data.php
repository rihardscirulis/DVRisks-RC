<?php
    $mysqli = new mysqli("localhost", "root", "", "edvrns");
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    $authorityID = $_POST['get_option'];
    $query = "SELECT persona.Vards AS vards, persona.Uzvards AS uzvards, persona.ID AS id 
        FROM persona 
        INNER JOIN persona_iestade ON persona_iestade.persona_ID = persona.ID 
        WHERE persona_iestade.iestade_ID =".$authorityID;
    $result = $mysqli->query($query);
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    echo "<select name='selectMember' data-form-field='selectMember' class='form-control display-7' id='selectMember-formbuilder-12'>";
    foreach ($rows as $row) {
        echo "<option value=".$row['id'].">".$row['vards']." ".$row['uzvards']."</option>";
    }
    echo "<div class='jq-selectbox__select'>";
    echo "<div class='jq-selectbox__trigger'>";
    echo "<div class='jq-selectbox__trigger-arrow'></div>";
    echo "</div>";
    echo "</div>";
    echo "<div class='jq-selectbox__dropdown' style='height: auto; bottom: auto; top: 55.1167px;'>";
    echo "<ul style='max-height: 300px;'>";
    echo "<li class='sel disabled selected' style=''>--- Izvēlieties personu ---</li>";
    foreach ($rows as $row) {
        echo "<li style=''>'<option value=".$row['id'].">".$row['vards']." ".$row['uzvards']."</option></li>";
    }
    echo "</ul>";
    echo "</div>";
    exit;
?>
