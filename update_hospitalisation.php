<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {
    $id_hosp = $_POST['id_hosp'];
    $id_patient = $_POST['id_patient'];
    /*--------------------------------- ETAT INFOS RH -------------------------------------*/

    $id_nurse = $_POST['id_nurse'];
    //$id_service = $_POST['id_service'];
    $id_medecin = $_POST['id_medecin'];
    $chambre = $_POST['chambre'];
    $id_type_hosp = $_POST['id_type_hosp'];
    $lit = $_POST['lit'];
    $nb_jour = $_POST['nb_jour'];
    $date_hosp = $_POST['date_hosp'];
    
    // Convertir la date du jour en objet DateTime
    $dateTimeDuJour = new DateTime($date_hosp);
    
    // Ajouter le nombre de jours pour obtenir la date de sortie
    $dateTimeSortie = $dateTimeDuJour->modify("+$nb_jour days");
    
    // Obtenir la date de sortie au format Y-m-d
    $date_sortie = $dateTimeSortie->format('Y-m-d');

        $query1 = "UPDATE hospitalisation SET  id_patient=:id_patient, id_nurse=:id_nurse, 
                     id_medecin=:id_medecin, chambre=:chambre, id_type_hosp=:id_type_hosp, lit=:lit, nb_jour=:nb_jour, date_hosp=:date_hosp, date_srt_hosp=:date_sortie   
                    WHERE id_hosp = '$id_hosp' ";


        $sql1 = $db->prepare($query1);

        // Bind parameters to statement
        $sql1->bindParam(':id_patient', $id_patient);
        $sql1->bindParam(':id_nurse', $id_nurse);
        $sql1->bindParam(':id_medecin', $id_medecin);
        $sql1->bindParam(':chambre', $chambre);
        $sql1->bindParam('id_type_hosp', $id_type_hosp);
        $sql1->bindParam(':lit', $lit);
        $sql1->bindParam(':nb_jour', $nb_jour);
        $sql1->bindParam(':date_hosp', $date_hosp);
        $sql1->bindParam(':date_sortie', $date_sortie);
        $sql1->execute();
        
        $etas=1;
     $query1 = " UPDATE lits SET  etat=:etat, date_fin=:date_fin WHERE id_lit = '$lit'  ";


    $sql1 = $db->prepare($query1);

    // Bind parameters to statement
    $sql1->bindParam(':etat', $etas);
    $sql1->bindParam(':date_fin', $date_sortie);
    $sql1->execute();





    if ($sql1) {
        ?>
        <script>
            //alert('Consulattion a été bien mis à jour.');
           window.location.href = '<?=$hospitalisation['option2_link']?>?witness=1';
        </script>
        <?php
    } else {
        ?>
        <script>
            //   alert('client n\'a pas été mis à jour.');
            window.location.href = '<?=$hospitalisation['option2_link']?>?witness=-1';
        </script>
        <?php

    }


}
?>
