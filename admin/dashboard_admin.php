<?php
    session_start();
	include '../insertions/functions.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, shrink-to-fit=9">	
		<!--- Stylesheets --->
		<link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">	
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">	
		<link href="../assets/css/owl.carousel.css" rel="stylesheet">	
		<link rel="../stylesheet" href="assets/unicons/css/unicons.css">
	 	<link href="../css/style.css" rel="stylesheet">	
		<link href="../css/responsive.css" rel="stylesheet">	
		<link href="../assets/css/semantic.css" rel="stylesheet">	
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/own_style.css">
    <title>Dashboard d'Administration</title>
</head>
<body>

    <?php
		//(var_dump($_SESSION));
        if (isset($_SESSION['email']) AND !empty($_SESSION['email']) AND isset($_SESSION['password']) AND !empty($_SESSION['password']))
		{
			$connect = connect_admin($_SESSION['email'], $_SESSION['password']);
			//die(var_dump($connect));

			if ($connect)
			{
				$_SESSION['connexion'] = true;
                $member = collect_admin_infos($_SESSION['email']);
                $data = array(
                    'nom' => $member['0'],
                    'prenom' => $member['1'],
                    'email' => $member['2'],
                    'titre' => $member['3']
                );
                ?>
                <div class="row">
                    <div class="col-md-10 own_main_menu">
                        <a href="" class="own_link own_item">Accueil</a>
                        <a href="" class="own_link own_item">Contact</a>
                        <a href="" class="own_link own_item">Infos de compte</a>
                        <a href=""><button class="btn btn-danger">Déconnexion</button></a>
                    </div>
                    <div class="col-md-2 own_member">
                        <p class="own_member"><span style="color:red"><?php echo $data['email']; ?></span><span style="color:lime"> Online</span></p>
                    </div>
                </div>

                <div class="vej-wrapper">
                
                <h3 class="own_member_title">Dashboard de <?php echo $data['prenom'] . ' ' . $data['nom']; ?>, <strong><?php echo $data['titre']; ?></strong></h3>
                <hr>
				<div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <ul>
                                <a href="" class="own_link"><li>Nouveaux inscrits</li></a>
                                <a href="" class="own_link"><li>Comptes activés</li></a>
                                <a href="" class="own_link"><li>Ajouter un compte</li></a>
                                <a href="" class="own_link"><li>Emplois du temps</li></a>
                                <a href="" class="own_link"><li>Gérer les notes</li></a>
                            </ul>
                        </div>
                        <div class="col-md-10">
                            <h4 style="margin:25px 5px">Liste des nouvelles inscriptions</h4>
                            <?php
                                if (isset($_GET['return']))
                                {
                                    if (isset($_GET['action']) AND !empty($_GET['action']))
                                    {
                                        if ($_GET['action'] == true)
                                        {
                                            ?>
                                            <div class="alert alert-success" role="alert">
                                            <strong>Action réussie !</strong>
                                            </div>
                                            <?php
                                        }
                                        elseif ($_GET['action'] == false)
                                        {
                                            ?>
                                            <div class="alert alert-primary" role="alert">
                                            <strong><?php echo $_GET['action']; ?></strong>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                            <div>
                                <h5><strong>Classées par étudiants</strong></h5>
                                <hr>
                                <table>
                                <thead>
                                    <th>Statut</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Adresse mail</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                <?php
                                    $db = connexion_bdd();
                                    $req = $db->query('SELECT * FROM etudiants WHERE statut = 0');
                                    while ($etu = $req->fetch())
                                    {
                                        ?>
                                        <tr>
                                            <td><span class="badge bg-danger">Inactif</span></td>
                                            <td><?php echo $etu['nom']; ?></td>
                                            <td><?php echo $etu['prenom']; ?></td>
                                            <td><?php echo $etu['email']; ?></td>
                                            <td><?php echo $etu['date_inscription']; ?></td>
                                            <td>
                                                <a href="traitement_admin.php?activate=<?php echo $etu['id']; ?>&type=etu"><button class="btn btn-success">Activer le compte</button></a>
                                                <a href="traitement_admin.php?block=<?php echo $etu['id']; ?>&type=etu"><button class="btn btn-danger">Bloquer</button></a>
                                                <a href="traitement_admin.php?update=<?php echo $etu['id']; ?>&type=etu"><button class="btn btn-info">Infos du compte</button></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                            <div style="margin:10px 0;">
                                <h5><strong>Classées par parents</strong></h5>
                                <hr>
                                <table>
                                <thead>
                                    <th>Statut</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Adresse mail</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                <?php
                                    $db = connexion_bdd();
                                    $req = $db->query('SELECT * FROM parents WHERE statut = 0');
                                    while ($par = $req->fetch())
                                    {
                                        ?>
                                        <tr>
                                            <td><span class="badge bg-danger">Inactif</span></td>
                                            <td><?php echo $par['nom']; ?></td>
                                            <td><?php echo $par['prenom']; ?></td>
                                            <td><?php echo $par['email']; ?></td>
                                            <td><?php echo $par['date_inscription']; ?></td>
                                            <td>
                                                <a href="traitement_admin.php?activate=<?php echo $par['id']; ?>&type=par"><button class="btn btn-success">Activer le compte</button></a>
                                                <a href="traitement_admin.php?block=<?php echo $par['id']; ?>&type=par"><button class="btn btn-danger">Bloquer</button></a>
                                                <a href="traitement_admin.php?update=<?php echo $par['id']; ?>&type=par"><button class="btn btn-info">Infos du compte</button></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                </tbody>
                                </table>
                            </div>
                            <div style="margin:10px 0;">
                                <h5><strong>Classées par professeurs</strong></h5>
                                <hr>
                                <table>
                                <thead>
                                    <th>Statut</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Adresse mail</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                <?php
                                    $db = connexion_bdd();
                                    $req = $db->query('SELECT * FROM professeurs WHERE statut = 0');
                                    while ($prof = $req->fetch())
                                    {
                                        ?>
                                        <tr>
                                            <td><span class="badge bg-danger">Inactif</span></td>
                                            <td><?php echo $prof['nom']; ?></td>
                                            <td><?php echo $prof['prenom']; ?></td>
                                            <td><?php echo $prof['email']; ?></td>
                                            <td><?php echo $prof['date_inscription']; ?></td>
                                            <td>
                                                <a href="traitement_admin.php?activate=<?php echo $prof['id']; ?>&type=prof"><button class="btn btn-success">Activer le compte</button></a>
                                                <a href="traitement_admin.php?block=<?php echo $prof['id']; ?>&type=prof"><button class="btn btn-danger">Bloquer</button></a>
                                                <a href="traitement_admin.php?update=<?php echo $prof['id']; ?>&type=prof"><button class="btn btn-info">Infos du compte</button></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    
                                ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <?php
			}
			else
			{
				header('location:connexion.php');
			}
		}
		
		
    ?>

</body>
</html>