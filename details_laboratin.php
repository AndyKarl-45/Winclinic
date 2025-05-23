<?php

include('first.php');
include('php/db.php');
include('php/main_side_navbar.php');

?>
<?php
$id_laboratin = $_REQUEST['id'];

$query = "SELECT * from laboratin where id_laboratin='" . $id_laboratin . "'";
$q = $db->query($query);
while ($row = $q->fetch()) {
    $id_laboratin = $row['id_laboratin'];

//     /*-------------------- DETAILS FOURNISSEURS  --------------------*/
    $nom_l = $row['nom_l'];
    $prenom_l = $row['prenom_l'];
    $adress_l = $row['adress_l'];
    // $username_m = $row['username_m'];
    $email_l = $row['email_l'];
    $genre_l = $row['genre_l'];
    $date_l = $row['date_l'];
    $pays_l = $row['pays_l'];
    $ville_l = $row['ville_l'];
    $region_l = $row['region_l'];
    // $code_postal_m = $row['code_postal_m'];
    $phone_l = $row['phone_l'];
    //  $biography_m = $row['biography_m'];
    $statut_l = $row['statut_l'];
    //$date_aniv_m = $row['date_aniv_m'];

    if(strlen($id_laboratin)<=4){
        $num=$id_laboratin;
        //N°   0008  /  01  /Pdt/SG/ONIGC/22
        $numeroref = substr_replace("0000",$num, -strlen($num));
        // $ref_dem_ent='N° '.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
        $ID_Laboratin= 'M'.$numeroref;

    }else{
        $num=$id_laboratin;
        //N°   00008  /  01  /Pdt/SG/ONIGC/22
        $numeroref = substr_replace("00000",$num, -strlen($num));
        // $ref_dem_ent='N° '.$numeroref.' / '.$month.' /Pdt/SG/ONIGC/'.$years;
        $ID_Laboratin= 'M'.$numeroref;
    }

    ?>

    <!--Content-->

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Détails du <?=$laboratin['title_single']?> : </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Hello M/Mme XXX, il est <?= date("G:i"); ?> en ce jour du <?= dateToFrench("now", "l j F Y"); ?>
                        .
                    </li>
                </ol>
                <!--                Main Body-->

                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">Profile</h4>
                    </div>

                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <?php
                        if( $lvl == 4 || $lvl == 7 ){
                        ?>
                        <a href="modifier_laboratin.php?id=<?=$id_laboratin?>" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i>
                            Editer Profile</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="assets/img/doctor-03.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php if($nom_l=="" or $prenom_l==""){echo 'N/A';}else{echo  $nom_l . ' ' . $prenom_l;} ?></h3>
                                                <small class="text-muted"></small>
                                                <div class="staff-id">ID <?=$laboratin['title_single']?>: <?php if($id_laboratin==0){echo 'N/A';}else{echo  $ID_Laboratin;} ?></div>
                                                <div class="staff-msg"><a href="#" class="btn btn-primary">Send
                                                        Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php if($phone_l==""){echo 'N/A';}else{echo  $phone_l;} ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php if($email_l==""){echo 'N/A';}else{echo  $email_l;} ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php if($date_l==""){echo 'N/A';}else{echo  $date_l;} ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php if($adress_l==""){echo 'N/A';}else{echo  $adress_l;} ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Sexe:</span>
                                                    <span class="text"><?php if($genre_l==""){echo 'N/A';}else{echo  $genre_l;} ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Rendez-vous</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Consultations</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab4" data-toggle="tab">Examens</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab5" data-toggle="tab">Antécédants</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab6" data-toggle="tab">Factures</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab7"
                                                data-toggle="tab">Hopspitalisations</a></li>
                        <li class="nav-item"><a class="nav-link" href="#bottom-tab8" data-toggle="tab">Opérations</a></li>
                        <li class="nav-item"><a class="nav-link" href="liste_commission_laborantin.php?id=<?=$id_laboratin?>" >Soldes de services</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="about-cont">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form action="#" method="POST">
                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label>Matricule<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="matricule" value="<?=$id_Laboratin?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label> Nom<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="nom_ing"
                                                           value="<?=$nom_l?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Prénom</label>
                                                    <input class="form-control" type="text" value="<?=$prenom_l?>" disabled>
                                                </div>
                                            </div>

                                            <!-- <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Username <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="username"
                                                           required="required">
                                                </div>
                                            </div> -->
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="email" value="<?=$email_l?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Birthday <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="date" value="<?=$date_l?>" disabled>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Phone </label>
                                                    <input class="form-control" type="text" value="<?=$phone_l?>" disabled>
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!--                            <div class="row">-->
                            <!--                                <div class="col-md-12">-->
                            <!--                                    <div class="card-box">-->
                            <!--                                        <h3 class="card-title">Education Informations</h3>-->
                            <!--                                        <div class="experience-box">-->
                            <!--                                            <ul class="experience-list">-->
                            <!--                                                <li>-->
                            <!--                                                    <div class="experience-user">-->
                            <!--                                                        <div class="before-circle"></div>-->
                            <!--                                                    </div>-->
                            <!--                                                    <div class="experience-content">-->
                            <!--                                                        <div class="timeline-content">-->
                            <!--                                                            <a href="#/" class="name">International College of Medical-->
                            <!--                                                                Science (UG)</a>-->
                            <!--                                                            <div>MBBS</div>-->
                            <!--                                                            <span class="time">2001 - 2003</span>-->
                            <!--                                                        </div>-->
                            <!--                                                    </div>-->
                            <!--                                                </li>-->
                            <!--                                                <li>-->
                            <!--                                                    <div class="experience-user">-->
                            <!--                                                        <div class="before-circle"></div>-->
                            <!--                                                    </div>-->
                            <!--                                                    <div class="experience-content">-->
                            <!--                                                        <div class="timeline-content">-->
                            <!--                                                            <a href="#/" class="name">International College of Medical-->
                            <!--                                                                Science (PG)</a>-->
                            <!--                                                            <div>MD - Obstetrics & Gynaecology</div>-->
                            <!--                                                            <span class="time">1997 - 2001</span>-->
                            <!--                                                        </div>-->
                            <!--                                                    </div>-->
                            <!--                                                </li>-->
                            <!--                                            </ul>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="card-box mb-0">-->
                            <!--                                        <h3 class="card-title">Experience</h3>-->
                            <!--                                        <div class="experience-box">-->
                            <!--                                            <ul class="experience-list">-->
                            <!--                                                <li>-->
                            <!--                                                    <div class="experience-user">-->
                            <!--                                                        <div class="before-circle"></div>-->
                            <!--                                                    </div>-->
                            <!--                                                    <div class="experience-content">-->
                            <!--                                                        <div class="timeline-content">-->
                            <!--                                                            <a href="#/" class="name">Consultant Gynecologist</a>-->
                            <!--                                                            <span class="time">Jan 2014 - Present (4 years 8 months)</span>-->
                            <!--                                                        </div>-->
                            <!--                                                    </div>-->
                            <!--                                                </li>-->
                            <!--                                                <li>-->
                            <!--                                                    <div class="experience-user">-->
                            <!--                                                        <div class="before-circle"></div>-->
                            <!--                                                    </div>-->
                            <!--                                                    <div class="experience-content">-->
                            <!--                                                        <div class="timeline-content">-->
                            <!--                                                            <a href="#/" class="name">Consultant Gynecologist</a>-->
                            <!--                                                            <span class="time">Jan 2009 - Present (6 years 1 month)</span>-->
                            <!--                                                        </div>-->
                            <!--                                                    </div>-->
                            <!--                                                </li>-->
                            <!--                                                <li>-->
                            <!--                                                    <div class="experience-user">-->
                            <!--                                                        <div class="before-circle"></div>-->
                            <!--                                                    </div>-->
                            <!--                                                    <div class="experience-content">-->
                            <!--                                                        <div class="timeline-content">-->
                            <!--                                                            <a href="#/" class="name">Consultant Gynecologist</a>-->
                            <!--                                                            <span class="time">Jan 2004 - Present (5 years 2 months)</span>-->
                            <!--                                                        </div>-->
                            <!--                                                    </div>-->
                            <!--                                                </li>-->
                            <!--                                            </ul>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <div class="tab-pane" id="bottom-tab2">

                        </div>
                        <div class="tab-pane" id="bottom-tab3">

                        </div>
                        <div class="tab-pane" id="bottom-tab4">
                            <div class="table-responsive">
                                <table class="table table-border table-striped custom-table mb-0" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>Code Patient</th>
                                        <th>Patient</th>
                                        <th>Médecin</th>
                                        <th><?=$laboratin['title_single']?></th>
                                        <th>Type d'examen</th>
                                        <th>Date</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $query = "SELECT * from examen where id_lab='$id_laboratin'";
                                    $q = $db->query($query);
                                    while ($row = $q->fetch()) {
                                        $id_exa = $row['id_exa'];
                                        $ref_exa = $row['ref_exa'];
                                        $id_patient = $row['id_patient'];
                                        $id_medecin = $row['id_medecin'];
                                        $id_laboratin = $row['id_lab'];
                                        $date_exa = $row['date_exa'];
                                        $id_type_exa = $row['id_type_exa'];


                                        $sql = "SELECT DISTINCT * from patient where id_patient = '$id_patient'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($tables as $table) {
                                            $nom_patient= $table['nom_p'] . ' ' . $table['prenom_p'];
                                            $age= $table['age_p'];
                                        }



                                        $sql = "SELECT DISTINCT * from medecin where id_medecin = '$id_medecin'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($tables as $table) {
                                            $nom_medecin= $table['nom_m'] . ' ' . $table['prenom_m'];
                                        }

                                        $sql = "SELECT DISTINCT * from laboratin where id_laboratin = '$id_laboratin'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($tables as $table) {
                                            $nom_laboratin= $table['nom_l'] . ' ' . $table['prenom_l'];
                                        }

                                        $sql = "SELECT DISTINCT * from type_exa where id_type_exa = '$id_type_exa'";

                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();

                                        $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($tables as $table) {
                                            $type_exa= $table['nom'] ;
                                        }
                                        if(empty($id_medecin)){
                                            $nom_medecin='N/A';
                                        }
                                        if(empty($id_type_exa)){
                                            $type_exa='N/A';
                                        }
                                        if(empty($id_laboratin)){
                                            $nom_laboratin='N/A';
                                        }

                                        ?>

                                        <tr>
                                            <td><a href="#"><?=$ref_exa?></a></td>
                                            <td><a href="#"><img width="28" height="28" src="assetss/img/user.jpg"
                                                                 class="rounded-circle m-r-5" alt=""><?=$nom_patient?></a></td>
                                            <td><a href="#"><?=$nom_medecin?></a></td>
                                            <td><a href="#"><?=$nom_laboratin?></a></td>
                                            <td><a href="#"><?=$type_exa?></a></td>
                                            <td><a href="#"><?= dateToFrench($date_exa, " j F Y")?></a></td>
                                            <td class="text-right">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="bottom-tab5">
                            Tab content 5
                        </div>
                        <div class="tab-pane" id="bottom-tab6">
                            Tab content 6
                        </div>
                        <div class="tab-pane" id="bottom-tab7">

                        </div>
                        <div class="tab-pane" id="bottom-tab8">
                            Tab content 8
                        </div>
                        <div class="tab-pane" id="bottom-tab9">
                            Tab content 9
                        </div>

                    </div>
                </div>
            </div>

            <!--                Main Body-->
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

    </div>
    </main>
    </div>
    <?php
}
?>


    <!--//Footer-->
<?php
include('foot.php');
?>