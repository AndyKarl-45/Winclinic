<?php
include("first.php");
include('php/main_side_navbar.php');
?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Liste des lits</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <!--                Main Body-->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card mb-4">
                            <div class="card-header">

                                <!-- Nav pills -->

                                <b>

                                    <!-- Nav pills -->
                                    <ul class="nav nav-pills" style="float: right;">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="modal" data-target="#ajouterOper"
                                               href="#home">
                                                <i class="fas fa-cubes"></i>
                                                Nouveau lit
                                            </a>
                                        </li>
                                    </ul>
                                </b>
                            </div>
                            <div class="card-body">
                                <div class="well bs-component">
                                    <fieldset>
                                        <div class="table-responsive">
                                            <form method="post" action="">
                                                <table class="table table-bordered table-hover" id="dataTable"
                                                       width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr class="bg-primary">
                                                        <th><p align="center" style="color: white">Lits</p></th>
                                                        <th><p align="center" style="color: white">Chambres</p></th>
                                                        <th><p align="center"  style="color: white">Options</p></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    $query = "SELECT * from lits where open_close!=1  order by nom desc  ";
                                                    $q = $db->query($query);
                                                    while($row = $q->fetch())
                                                    {
                                                        $nom  =$row['nom'];
                                                        $id_lit  =$row['id_lit'];
                                                        $id_chambre  =$row['id_chambre'];
                                                        
                                                        $sql = "SELECT DISTINCT * from chambres where id_chambre = '$id_chambre'";

                                                        $stmt = $db->prepare($sql);
                                                        $stmt->execute();
                        
                                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                                                        foreach ($tables as $table) {
                                                            $nom_chambre= $table['nom'];
                        
                                                        }
                                                        
                                                        if(empty($id_chambre)){
                                                            $nom_chambre='N/A';
                                                        }

                                                        ?>
                                                        <tr>
                                                            <input name="nom" type="hidden"
                                                                   value=""/>
                                                            <td align="center"><b><?=$nom?></b></td>
                                                            <td align="center"><b><?=$nom_chambre?></b></td>
                                                            <td align="center"><a class="btn btn-danger" onclick="Supp(this.href); return(false);" href="delete_lit.php?id_lit=<?=$id_lit?>"  style="background-color: transparent">
                                                                    <i style="color: red" class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php }?>


                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="bg-primary">
                                                        <th><p align="center" style="color: white">Lits</p></th>
                                                        <th><p align="center" style="color: white">Chambres</p></th>
                                                        <th><p align="center"  style="color: white">Options</p></th>
                                                    </tr>
                                                    </tfoot>

                                                </table>
                                            </form>
                                        </div>
                                    </fieldset>

                                </div>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!--    Modal pour ajouter Categorie Contrat-->
    <div class="modal fade" id="ajouterOper" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="padding:20px 50px;">
                    <h3 align="center"><i class="fas fa-map"></i> <b>Nouveau lit</b></h3>
                    <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                </div>
                <div class="modal-body" style="padding:40px 50px;">
                    <form class="form-horizontal" action="save_lit.php" name="form" method="post">
                        <div class="form-group">
                            <label>Nom :</label>
                            <div class="col-sm-12">
                                <input type="text" name="nom" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Chambre: <span
                                        class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control"
                                        name="id_chambre">
                                    <option value="0" selected="">
                                        ...
                                    </option>
                                    <?php

                                    $iResult = $db->query("SELECT * FROM chambres where open_close!=1 ");

                                    while ($data = $iResult->fetch()) {

                                        $i = $data['id_chambre'];
                                        echo '<option value ="' . $i . '">';
                                        echo $data['nom'];
                                        echo '</option>';

                                    }

                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <center>
                                    <input type="submit" style=" width:25% " name="submit_cs" class="btn btn-primary"
                                           value="Créer">

                                    <input data-dismiss="modal" type="text" style=" width:25% " name=""
                                           class="btn btn-danger" value="Annuler"/></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function Supp(link){
            if(confirm('Confirmer  la suppression du lit?')){
                document.location.href = link;
            }
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
        case '-2';
            ?>
            <script>
                Swal.fire({
                    icon: 'Erreur',
                    title: 'Il existe Déjà !!!',
                    text: 'Une erreur s\'est produite !',
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