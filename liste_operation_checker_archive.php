<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

<!--Content-->

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4"><i class="fas fa-users" style="color: silver"></i> Liste des Opérations en cours...</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">
          Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
          .

        </li>
      </ol>
      <div class="row">
        <div class="col-xl-12">

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr />
        </div>
      </div>
      <!--                Main Body              -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
              <thead>
                <tr>
                  <th>Code patient</th>
                  <th>Patient</th>
                  <th>Age</th>
                  <th>Médecin</th>
                  <th>Department</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Prix</th>
                  <th>Reste à Payer</th>
                  <th>Payer</th>
                  <th>Remise</th>
                  <th>Statuts</th>
                  <th>PDF</th>
                  <th>remboursement</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $query = "SELECT * from regler_ope ";
                $q = $db->query($query);
                while ($row = $q->fetch()) {
                  $id_ope = $row['id_ope'];
                  $id_reg_ope = $row['id_reg_ope'];
                  $payer = $row['payer'];
                  $somme = $row['somme'];
                  $remise = $row['remise'];
                  $reste = $somme - $payer;
                  if ($somme - ($payer + $remise) != 0) {
                    continue;
                  }

                  $sql = "SELECT DISTINCT * from operation  where id_ope = '$id_ope'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $id_ope = $table['id_ope'];
                    $ref_ope = $table['ref_ope'];
                    $id_patient = $table['id_patient'];
                    $id_medecin = $table['id_medecin'];
                    $id_inter = $table['id_inter'];
                    $date_ope = $table['date_ope'];
                    $resume = $table['resume'];
                    $obs_ope = $table['obs_ope'];
                    $id_type_ope = $table['id_type_ope'];
                    $time_first = $table['time_first'];
                    $time_last = $table['time_last'];
                    $id_depart = $table['id_depart'];
                  }



                  $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_patient = $table['nom_p'] . ' ' . $table['prenom_p'];
                    $nom_patient_ref = $table['ref_patient'];
                    $age = $table['age_p'];
                  }


                  $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $nom_medecin = $table['nom_m'] . ' ' . $table['prenom_m'];
                  }

                  $sql = "SELECT DISTINCT * from type_ope where id_type_ope = '$id_type_ope'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $type_ope = $table['nom'];
                    $prix_total = $table['prix_t_ope'];
                  }

                  $sql = "SELECT DISTINCT * from departement where id_depart = '$id_depart'";

                  $stmt = $db->prepare($sql);
                  $stmt->execute();

                  $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($tables as $table) {
                    $departement = $table['nom'];
                  }

                  if (empty($id_medecin)) {
                    $nom_medecin = 'N/A';
                  }
                  if (empty($id_nurse)) {
                    $nom_nurse = 'N/A';
                  }
                  if (empty($id_depart)) {
                    $departement = 'N/A';
                  }

                ?>

                  <tr>
                    <td><?= $nom_patient_ref ?></td>
                    <td><img width="28" height="28" src="assetss/img/user.jpg"
                        class="rounded-circle m-r-5"
                        alt=""> <?= $nom_patient ?>
                    </td>
                    <td><?= $age ?></td>
                    <td><?= $nom_medecin ?></td>
                    <td><?= $departement ?></td>
                    <td><?= dateToFrench($date_ope, " j F Y") ?></td>
                    <td><?= $time_first ?> - <?= $time_last ?></td>
                    <td><a href="#"><?= number_format($prix_total); ?></a></td>
                    <td><a href="#"><?= number_format($somme - ($payer + $remise)); ?></a></td>
                    <td><a href="#"><?= number_format($payer); ?></a></td>
                    <td><a href="#"><?= number_format($remise); ?></a></td>
                    <td>

                      <?php
                      if ($lvl == 11) {
                        if ($somme - ($payer + $remise) == 0)
                          echo '<span class="custom-badge status-green" >Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" >Pas à Jour</span>';
                      } else {
                        if ($somme - ($payer + $remise) == 0)
                          echo '<span class="custom-badge status-green" data-toggle="modal" data-target="#ajouterOpe' . $id_reg_ope . '">Ok</span>';
                        else
                          echo '<span class="custom-badge status-red" data-toggle="modal" data-target="#ajouterOpe' . $id_reg_ope . '">Pas à Jour</span>';
                      }
                      ?>

                    </td>
                    <td align="center">
                      <a href="facture_operation.php?id_reg_ope=<?= $id_reg_ope ?>&id_perso=<?= $id_perso_session ?>" target="_blank">
                        <i class="fa fa-print"></i>
                      </a>
                      <a href="facture_operation_Ticket.php?id_reg_ope=<?= $id_reg_ope ?>&id_perso=<?= $id_perso_session ?>" title="Ticket" target="_blank">
                        <i class="far fa-file-alt"></i>
                      </a>
                    </td>
                    <td class="text-center">
                      <?php

                      if ($lvl == 4 ||  $lvl == 13) {
                        if ($lvl == 11 || $lvl == 7 || $lvl == 12) {
                          if ($somme - ($payer + $remise) == 0) {
                            echo '<a href="#" ><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        } else {
                          if ($somme - ($payer + $remise) == 0) {
                            echo '<a href="rembourser_services.php?id_service=' . $id_ope . '&id_reg_service=' . $id_reg_ope . '&table_service=operation" onclick="Supp(this.href); return(false);"><span class="custom-badge status-blue" ">rembourser</span></a>';
                          }
                        }
                      }

                      ?>

                    </td>
                    <td class="text-right">
                      <div class="modal fade" id="ajouterOpe<?= $id_reg_ope ?>" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header" style="padding:20px 50px;">
                              <h3 align="center"><i class="fas fa-map"></i> <b>Reglement: <?= $ref_ope ?></b></h3>
                              <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                            </div>
                            <div class="modal-body" style="padding:40px 50px;">
                              <form class="form-horizontal" action="update_ope_paye.php" name="form" method="post">
                                <div class="row">
                                  <label style="text-align: center;">
                                    <i class="far fa-newspaper"></i>
                                    Versement précédent
                                  </label>
                                  <div class="col-md-12">
                                    <hr />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Payer</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?= number_format($payer) ?>" disabled="" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Reste à payer</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" value="<?= number_format($somme - ($payer + $remise)) ?>" disabled="">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                    <hr />
                                  </div>
                                </div>


                                <div class="row">
                                  <label>
                                    <i class="far fa-newspaper"></i>
                                    Versement Actuel
                                  </label>
                                  <div class="col-md-12">
                                    <hr />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Montant Recue</label>
                                  <div class="col-sm-12">
                                    <input type="hidden" name="id_reg_ope" value="<?= $id_reg_ope ?>" class="form-control">
                                    <input type="hidden" name="id_perso_session" value="<?= $id_perso_session ?>" class="form-control">
                                    <input type="hidden" name="id_ope" value="<?= $id_ope ?>" class="form-control">
                                    <input type="number" name="payer" id="montant-verse<?= $ref_ope ?>" class="form-control" oninput="calculerReste('<?= $ref_ope ?>')">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Montant total</label>
                                  <div class="col-sm-12">
                                    <input type="hidden" name="somme" class="form-control" value="<?= $somme - $payer - $remise ?>">
                                    <input type="text" class="form-control" value="<?= number_format($somme - $payer - $remise) ?>" disabled="" />
                                    <input type="hidden" class="form-control" id="montant-total<?= $ref_ope ?>" value="<?= $somme - $payer - $remise ?>" />
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label>Reste à payer:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reste-payer<?= $ref_ope ?>" value="0" disabled="" />
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label>Montant à rembourser:</label>
                                  <div class="col-sm-12">
                                    <input type="text" class="form-control" id="reste-rembourser<?= $ref_ope ?>" value="0" disabled="" />
                                  </div>
                                </div>
                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                ?>
                                  <div class="form-group">
                                    <label>Remise</label>
                                    <div class="col-sm-12">
                                      <input type="number" class="form-control" name="remise" value="0" />
                                    </div>
                                  </div>
                                <?php } ?>
                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11 || $lvl == 2 || $lvl == 12) {
                                ?>
                                  <div class="form-group">
                                    <label>Mode de paie : <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                      <select class="form-control"
                                        name="paie">
                                        <option value="0" selected="">
                                          ...
                                        </option>
                                        <?php

                                        $sql = "SELECT montant from caution where id_patient = '$id_patient' ";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();


                                        // Vérifiez si des résultats ont été trouvés
                                        if ($table = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                          $montant_caution = $table['montant'];
                                        } else {
                                          $montant_caution = 0; // Aucun montant de caution trouvé
                                        }

                                        $iResult = $db->query("SELECT * FROM mode_paie where open_close!=1 ");

                                        while ($data = $iResult->fetch()) {

                                          $i = $data['id_mode_paie'];
                                          if ($data['nom'] === 'CAUTION') {
                                            echo '<option value ="' . $i . '">';
                                            echo $data['nom'] . ' ( ' . number_format($montant_caution) . ' )';
                                            echo '</option>';
                                          } else {
                                            echo '<option value ="' . $i . '">';
                                            echo $data['nom'];
                                            echo '</option>';
                                          }
                                        }

                                        ?>

                                      </select>
                                    </div>
                                  </div>
                                <?php
                                }
                                ?>
                                <?php
                                if ($lvl == 4 || $lvl == 7 || $lvl == 11) {
                                ?>
                                  <div class="form-group">
                                    <label>Caisse <span
                                        class="text-danger">*</span></label>
                                    <div class="col-sm-12">
                                      <select class="form-control"
                                        name="id_caisse">
                                        <option value="0" selected="">
                                          ...
                                        </option>
                                        <?php

                                        $iResult = $db->query("SELECT * FROM caisse where open_close!=1 ");

                                        while ($data = $iResult->fetch()) {

                                          $i = $data['id_caisse'];
                                          echo '<option value ="' . $i . '">';
                                          echo $data['caisse'];
                                          echo '</option>';
                                        }

                                        ?>

                                      </select>
                                    </div>
                                  </div>
                                <?php } ?>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                    <center>
                                      <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                        value="Payer">

                                      <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                        class="btn btn-danger" value="Annuler" />
                                    </center>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--                End Body              -->

      <div class="row">
        <div class="col-md-12">
          <hr />
        </div>
      </div>

    </div>
  </main>
</div>
<div class="modal fade" id="ajouterOper" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding:20px 50px;">
        <h3 align="center"><i class="fas fa-map"></i> <b>Reglement</b></h3>
        <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
      </div>
      <div class="modal-body" style="padding:40px 50px;">
        <form class="form-horizontal" action="save_pays.php" name="form" method="post">
          <div class="form-group">
            <label>Montant Recue</label>
            <div class="col-sm-12">
              <input type="text" name="nom" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label>Montant total</label>
            <div class="col-sm-12">
              <input type="text" name="nom" class="form-control" value="2,000,000" disabled="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <center>
                <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                  value="Créer">

                <input data-dismiss="modal" type="text" style=" width:25% " name=""
                  class="btn btn-danger" value="Annuler" />
              </center>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  function Supp(link) {
    if (confirm('Confirmer  le remboursement de l\'hospitalisation ?')) {
      document.location.href = link;
    }
  }


  function calculerReste(ref_service) {
    const montantTotal = parseInt(document.getElementById('montant-total' + ref_service).value);
    const montantVerse = parseInt(document.getElementById('montant-verse' + ref_service).value);
    let reste = montantTotal - montantVerse;
    let restePayer = 0;

    if (reste < 0) {
      resteRembourser = Math.abs(reste);
      restePayer = 0;
    } else {
      resteRembourser = 0;
      restePayer = Math.abs(reste);
    }


    document.getElementById('reste-rembourser' + ref_service).value = resteRembourser;
    //   $('.total-'+ref_service).attr('value',montantTotal);
    document.getElementById('reste-payer' + ref_service).value = restePayer;
    //   $('.total-'+ref_service).attr('value',montantTotal);
  }
</script>
<?php
if (isset($_GET['witness'])) {
  $witness = $_GET['witness'];

  switch ($witness) {
    case '1';
?>
      <script>
        Swal.fire(
          'Succès',
          'Opération effectuée avec succès !',
          'success'
        )
      </script>
    <?php
      break;
    case '-1';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Oops...',
          text: 'Une erreur s\'est produite !',
          footer: 'Reéssayez encore'
        })
      </script>
    <?php
      break;
    case '-3';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Votre caution est à 0 ',
          text: 'Mettre à jour la caution du patient ! ',
          footer: 'Reéssayez encore'
        })
      </script>
    <?php
      break;
    case '-4';
    ?>
      <script>
        Swal.fire({
          icon: 'Erreur',
          title: 'Règlement est ok ! ',
          text: 'Une erreur s\'est produite! ',
          footer: 'Reéssayez encore'
        })
      </script>
<?php
      break;
  }
}
?>


<!--//Footer-->
<?php
include('foot.php');
?>