<?php

include('first.php');
include("php/db.php");
include('php/main_side_navbar.php');

?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"><i class="fas fa-user-nurse" style="color: silver"></i> Liste des Infirmières(iers)</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .

                    </li>
                </ol>
                <div class="row">
                    <div class="col-xl-12">
                        <?php
                        if( $lvl != 3 and $lvl != 11 ){
                        ?>

                        <b>
                            <!-- Nav pills -->
                            <ul class="nav nav-pills" style="float: right;">
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="nouveau_nurse.php">
                                        <i class="fas fa-user-md"></i>
                                        Nouveau infirmière(ier)
                                    </a>
                                </li>
                            </ul>
                        </b>
                        <?php
                        }?>
                        ?>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>
                <!--                Main Body              -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Département</th>
                                    <th>Type</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                   $query = "SELECT * from nurse  where open_close!=1 order by nom_n,prenom_n asc";
                                

                                
                                $q = $db->query($query);
                                while ($row = $q->fetch()) {
                                $cnt=0;
                                $id_nurse = $row['id_nurse'];
                                $nom_n = $row['nom_n'];
                                $prenom_n = $row['prenom_n'];
                                $id_depart = $row['id_depart'];
                                $phone_n = $row['phone_n'];
                                $ville_n = $row['ville_n'];
                                $email_n = $row['email_n'];
                                $region_n = $row['region_n'];
                                $type_n = $row['type_n'];
                                // $profession = $row['profession'];
                                
                                if($id_nurse == $id_perso_session){
                                    $cnt++;
                                }

                                $sql = "SELECT DISTINCT * from departement where id_depart = '$id_depart'";

                                $stmt = $db->prepare($sql);
                                $stmt->execute();

                                $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($tables as $table) {
                                    $departement=$table['nom'];
                                }
                                    if(empty($departement)){
                                        $departement='N/A';
                                    }

                                ?>

                                    <tr>
                                        <td><img width="28" height="28" src="assetss/img/user.jpg"
                                                 class="rounded-circle m-r-5" alt=""><?php echo $nom_n . ' ' . $prenom_n ?>
                                        </td>
                                        <td><?=$departement?></td>
                                        </td>
                                        <td><?= $type_n ?></td>
                                        <td><?= $phone_n ?></td>
                                        <td><?= $email_n ?></td>
                                        <td class="text-right">

                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php
                                                    if( $lvl == 4 || $lvl == 7 || $cnt != 0  ){
                                                    ?>
                                                    <a class="dropdown-item" href="details_nurse.php?id=<?= $id_nurse ?>"><i
                                                                    class="fas fa-eye"></i> Détails</a>
                                                      <?php } ?>
                                                    <?php if ( $lvl == 4 || $lvl == 7) { ?>
                                                    <a class="dropdown-item" href="modifier_nurse.php?id=<?=$id_nurse?>"><i
                                                                class="fa fa-pen"></i> Edit</a>
                                                    <a class="dropdown-item" href="delete_nurse.php?id=<?=$id_nurse?>" onclick="Supp(this.href); return(false);"><i class="fas fa-trash"></i>
                                                        Delete</a>
                                                    <?php }?>
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
                        <hr/>
                    </div>
                </div>

            </div>
        </main>
    </div>
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

    }
}
?>
    <script type="text/javascript">
        function Supp(link){
            if(confirm('Confirmer  la suppression du Infirmier(ière) ?')){
                document.location.href = link;
            }
        }
    </script>

    <!--//Footer-->
<?php
include('foot.php');
?>