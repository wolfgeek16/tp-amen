<?php
    session_start();
    include '../insertions/functions.php';

//Activation des comptes
    if (isset($_GET['activate']) AND !empty($_GET['activate']) AND isset($_GET['type']) AND !empty($_GET['type']))
    {
        if ($_GET['type'] == 'etu')
        {
            $activation = activate_etu($_GET['activate']);
            if ($activation)
            {
                header('location:dashboard_admin.php?return&action=true');
            }
            else
            {
                $error = "Quelque chose s'est mal passé. Si l'erreur persiste, contactez le service technique !";
                header('location:dashboard_admin?return&action=' .$error);
            }
        }

        elseif ($_GET['type'] == 'par')
        {
            $activation = activate_parent($_GET['activate']);
            if ($activation)
            {
                header('location:dashboard_admin.php?return&action=true');
            }
            else
            {
                $error = "Quelque chose s'est mal passé. Si l'erreur persiste, contactez le service technique !";
                header('location:dashboard_admin?return&action=' .$error);
            }
        }

        elseif ($_GET['type'] == 'prof')
        {
            $activation = activate_prof($_GET['activate']);
            if ($activation)
            {
                header('location:dashboard_admin.php?return&action=true');
            }
            else
            {
                $error = "Quelque chose s'est mal passé. Si l'erreur persiste, contactez le service technique !";
                header('location:dashboard_admin?return&action=' .$error);
            }
        }
    }

    //Blocage des comptes
    if (isset($_GET['block']) AND !empty($_GET['block']) AND isset($_GET['type']) AND !empty($_GET['type']))
    {
        if ($_GET['type'] == 'etu')
        {
            $blockage = restrict_etu($_GET['block']);
            if ($blockage)
            {
                header('location:dashboard_admin.php?return&action=true');
            }
            else
            {
                $error = "Quelque chose s'est mal passé. Si l'erreur persiste, contactez le service technique !";
                header('location:dashboard_admin?return&action=' .$error);
            }
        }
        elseif ($_GET['type'] == 'par')
        {
            $blockage = restrict_parent($_GET['block']);
            if ($blockage)
            {
                header('location:dashboard_admin.php?return&action=true');
            }
            else
            {
                $error = "Quelque chose s'est mal passé. Si l'erreur persiste, contactez le service technique !";
                header('location:dashboard_admin?return&action=' .$error);
            }
        }
        elseif ($_GET['type'] == 'prof')
        {
            $blockage = restrict_prof($_GET['block']);
            if ($blockage)
            {
                header('location:dashboard_admin.php?return&action=true');
            }
            else
            {
                $error = "Quelque chose s'est mal passé. Si l'erreur persiste, contactez le service technique !";
                header('location:dashboard_admin?return&action=' .$error);
            }
        }
    }
?>