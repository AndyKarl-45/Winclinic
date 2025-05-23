<?php
include("first.php");
include('php/navbar_links.php');
include("php/db.php")
?>

<?php

if ($_POST) {

    // Fonction pour calculer la somme totale des billets et pièces
    function calculerSommeTotale($dixmilles, $cinqmilles, $deuxmilles, $mille, $cinqcentnote, $cinqcentcoin, $cent, $cinquante, $vingtcinq, $dix, $cinq, $deux, $un) {
        return $dixmilles * 10000 + $cinqmilles * 5000 + $deuxmilles * 2000 + $mille * 1000 + $cinqcentnote * 500 + $cinqcentcoin * 500 + $cent * 100 + $cinquante * 50 + $vingtcinq * 25 + $dix * 10 + $cinq * 5 + $deux * 2 + $un * 1;
    }

    $open_close = 0;
    $date_rap=date('Y-m-d');
    $date_momo=date('Y-m-d');
    $date_om=date('Y-m-d');

    $ref_rap = $_POST['ref_rap'];
    $ref_momo='MOMO_'.$ref_rap;
    $ref_om='OM_'.$ref_rap;

    $id_perso = $_POST['id_perso'];
    $id_rap_caisse = $_POST['id_rap_caisse'];

    if (!empty($_POST['montant_cash'])) {

        //////////////////////////
        $motif_cash = $_POST['motif_cash'];
        $montant_cash = $_POST['montant_cash'];
        $dixmilles = $_POST['dixmilles'];
        $cinqmilles = $_POST['cinqmilles'];
        $deuxmilles = $_POST['deuxmilles'];
        $mille = $_POST['mille'];
        $cinqcentnote = $_POST['cinqcentnote'];
        $cinqcentcoin = $_POST['cinqcentcoin'];
        $cent = $_POST['cent'];
        $cinquante = $_POST['cinquante'];
        $vingtcinq = $_POST['vingtcinq'];
        $cinq = $_POST['cinq'];
        $dix = $_POST['dix'];
        $deux = $_POST['deux'];
        $un = $_POST['un'];


        //$somme_total=$dixmilles*10000+$cinqmilles*5000+$deuxmilles*2000+$mille*1000+$cinqcentnote*500+$cinqcentcoin*500+$cent*100+$cinquante*50+$vingtcinq*25+$dix*10+$cinq*5+$deux*2+$un*1;
        // Calcul de la somme totale des billets et pièces
        $somme_total = calculerSommeTotale($dixmilles, $cinqmilles, $deuxmilles, $mille, $cinqcentnote, $cinqcentcoin, $cent, $cinquante, $vingtcinq, $dix, $cinq, $deux, $un);
        if($montant_cash == $somme_total){

            $query = " INSERT INTO rapport_caisse (ref_rap,id_perso,date_rap,motif,montant,dixmilles,cinqmilles,deuxmilles,mille,cinqcentnote,cinqcentcoin,cent,cinquante,vingtcinq,dix,cinq,deux,un,open_close) 
                     VALUES (:ref_rap,:id_perso,:date_rap,:motif_cash,:montant_cash,:dixmilles,:cinqmilles,:deuxmilles,:mille,:cinqcentnote,:cinqcentcoin,:cent,:cinquante,:vingtcinq,:dix,:cinq,:deux,:un,:open_close)";

            $sql = $db->prepare($query);

            // Bind parameters to statement
            $sql->bindParam(':ref_rap', $ref_rap);
            $sql->bindParam(':id_perso', $id_perso);
            $sql->bindParam(':date_rap', $date_rap);
            $sql->bindParam(':motif_cash', $motif_cash);
            $sql->bindParam(':montant_cash', $montant_cash);
            $sql->bindParam(':dixmilles', $dixmilles);
            $sql->bindParam(':cinqmilles', $cinqmilles);
            $sql->bindParam(':deuxmilles', $deuxmilles);
            $sql->bindParam(':mille', $mille);
            $sql->bindParam(':cinqcentnote', $cinqcentnote);
            $sql->bindParam(':cinqcentcoin', $cinqcentcoin);
            $sql->bindParam(':cent', $cent);
            $sql->bindParam(':cinquante', $cinquante);
            $sql->bindParam(':vingtcinq', $vingtcinq);
            $sql->bindParam(':dix', $dix);
            $sql->bindParam(':cinq', $cinq);
            $sql->bindParam(':deux', $deux);
            $sql->bindParam(':un', $un);
            $sql->bindParam(':open_close', $open_close);
            $sql->execute();

        }

        if(!empty($_POST['montant_om'])){

            ////////////
            $number_om = $_POST['number_om'];
            $solde_om = $_POST['solde_om'];
            $montant_om = $_POST['montant_om'];

            $query = " INSERT INTO om (ref_om,id_perso,date_om,montant,solde,number,open_close,id_rap_caisse) 
                     VALUES (:ref_om,:id_perso,:date_om,:montant,:solde,:number,:open_close,:id_rap_caisse)";

            $sql = $db->prepare($query);

            // Bind parameters to statement
            $sql->bindParam(':ref_om', $ref_om);
            $sql->bindParam(':id_perso', $id_perso);
            $sql->bindParam(':date_om', $date_om);
            $sql->bindParam(':montant', $montant_om);
            $sql->bindParam(':solde', $solde_om);
            $sql->bindParam(':number', $number_om);
            $sql->bindParam(':open_close', $open_close);
            $sql->bindParam(':id_rap_caisse', $id_rap_caisse);
            $sql->execute();
        }

        if(!empty($_POST['montant_momo'])){

            /////////////
            $number_momo = $_POST['number_momo'];
            $solde_momo = $_POST['solde_momo'];
            $montant_momo = $_POST['montant_momo'];

            $query = " INSERT INTO momo (ref_momo,id_perso,date_momo,montant,solde,number,open_close,id_rap_caisse) 
                     VALUES (:ref_momo,:id_perso,:date_momo,:montant,:solde,:number,:open_close,:id_rap_caisse)";

            $sql = $db->prepare($query);

            // Bind parameters to statement
            $sql->bindParam(':ref_momo', $ref_momo);
            $sql->bindParam(':id_perso', $id_perso);
            $sql->bindParam(':date_momo', $date_momo);
            $sql->bindParam(':montant', $montant_momo);
            $sql->bindParam(':solde', $solde_momo);
            $sql->bindParam(':number', $number_momo);
            $sql->bindParam(':open_close', $open_close);
            $sql->bindParam(':id_rap_caisse', $id_rap_caisse);
            $sql->execute();
        }










    }




    //---------------------- OPERATION DE VERIFICATION -------------------------//
    //$reste = $montant - $avance;

    // echo $id_fournisseur.'</br>';
    // echo $id_card_bank.'</br>';
    // echo $date_transaction.'</br>';
    // echo $id_chantier.'</br>';
    // echo $date_echeance.'</br>';
    // echo $montant.'</br>';
    // echo $avance.'</br>';
    // echo $id_mode_paiement.'</br>';
    // echo $reste.'</br>';
    // echo $cheque.'</br>';


//--------------------------------- insertion un fournisseur -----------------------------------------//

        if ($sql) {
            ?>
            <script>
                //alert('Règlement fournisseur a été bien enregistrée.');
               window.location.href = '<?=$rapport_caisse['option2_link']?>?witness=1';
            </script>
            <?php
        } else {
            ?>
            <script>
               // alert('Error.');
                window.location.href = '<?=$rapport_caisse['option2_link']?>?witness=-1';
            </script>
            <?php

        }


}
?>
