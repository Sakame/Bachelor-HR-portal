<?php
include "hr_session.php"; ?>
<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>




    <title>OsloMet - Tildel ansatt</title>
    <?php
    include_once "../../Elements/Metaheads.php";
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.alloyui.com/2.5.0/aui/aui-min.js"></script>

</head>

<!-- Complete page area: START -->
<body class="article width-large">

<!-- Change between "sidemenu"/"nosidemenu" and "extrainfo"/"noextrainfo" to switch display of side columns on or off  --><ul id="hidnav" role="navigation">
    <li><a href="#section">skip to content</a></li>
    <li><a href="#navcontainer">Main navigation (skip)</a></li>
    <li><a href="#footer">Bottom menu (skip)</a></li>
</ul>
<div class="container" data-role="page">
    <img id="printLogo" alt="Print logo HiOA" src="../../img/Hioa-Logo-s_h-orig.png" />
    <div id="hioa-toolbar">
        <div id="mobile-menu-trigger">
            <img src="../../img/hioa-meny-knapp_off.png" alt="meny" />
        </div>

        <a href="/eng/">English</a>
        <div id="mobile-menu">
            <?php
            include "nav_hr_mobile.php";
            ?>
        </div>
    </div>


    <div id="top">
        <div class="contentWrapper">
            <a id="logo" href="http://www.hioa.no/"><img width="236" height="auto" alt="Logo - HiOA - Tilbake til forsida HiOA" src="../../img/hioa-logo-web_697×120_no.png" /></a>
            <nav>
                <?php
                include "nav_hr.php";
                ?>
            </nav>   <!-- END: navcontainer -->
        </div> <!-- contentWrapper -->
    </div><!-- top -->
    <!-- <div class="clearfloat"></div> -->
    <!-- <div id="page" class="nosidemenu noextrainfo section_id_1 subtree_level_0_node_id_2 subtree_level_1_node_id_23577"> -->


    <div id="maincontent">
        <div id="topShadow"></div>
        <div class="frameWrapper">
            <div class="bodyframe_right side"></div>
            <div class="bodyframe_left side"></div>
            <div class="contentWrapper">
                <!-- <div id="breadCrumb"> </div> -->
                <div id="section">		          <!-- Main area content: START -->
                    <div class="section">
                        <!-- <a id="nonav3" class="hiddenTxt" name="nonav3"></a> Hva gjør denne?-->
                        <!-- <div class="innholdskolonne"> -->
                        <div id="firstGrid">
                            <div style="flot:left;clear:both;">
                                <div id="test">
                                    <div id="overview" class="page tilsatt">

                                        <div class="mrflexibox block_result_list tjenestebox left width_full"
                                             thetitle="Tildel fadder">

                                            <h2>
                                                Tildel fadder
                                            </h2>

                                            <div class="mr_fleksi_content">

                                                <form action="" method="post">
                                                    <table>
                                                        <tr class="input-group">
                                                            <td>Ny ansatt: </td>
                                                            <td>
                                                                <?php employeeSelect(); ?>
                                                            </td>
                                                        </tr>

                                                        <tr class="input-group">
                                                            <td>Fadder: </td>
                                                            <td><?php mentorSelect(); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary" name="assignMentor">Tildel Fadder</button>
                                                </form>
                                                <!--
                                                <form action="" method="post">
                                                    <table>
                                                        <tr class="input-group">
                                                            <td>Ny ansatt: </td>
                                                            <td><?php //employeeSelect(); ?></td>
                                                        </tr>
                                                        <tr class="input-group">

                                                            <td>Ny Fadder: </td>
                                                            <td><?php //mentorSelect(); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary" name="updateMentor">Tildel ny Fadder</button>
                                                </form> -->
                                            </div>
                                        </div>

                                        <div class="mrflexibox block_result_list tjenestebox left width_full"
                                             thetitle="Tildel Leder">

                                            <h2>
                                                Tildel Leder
                                            </h2>

                                            <div class="mr_fleksi_content">

                                                <form action="" method="post">
                                                    <table>
                                                        <tr class="input-group">
                                                            <td>Ny ansatt: </td>
                                                            <td><?php employeeSelect(); ?></td>
                                                        </tr>

                                                        <tr class="input-group">
                                                            <td>Leder: </td>
                                                            <td><?php leaderSelect(); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary" name="assignLeader">Tildel Leder</button>
                                                </form>
                                                <!--
                                                <form action="" method="post">
                                                    <table>
                                                        <tr class="input-group">
                                                            <td>Ny ansatt: </td>
                                                            <td><?php //employeeSelect(); ?></td>
                                                        </tr>
                                                        <tr class="input-group">

                                                            <td>Ny Leder: </td>
                                                            <td><?php //leaderSelect(); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary" name="updateLeader">Tildel ny Leder</button>
                                                </form> -->
                                            </div>
                                        </div>
                                        <div class="mrflexibox block_result_list tjenestebox left width_full"
                                             thetitle="Tildel HR-ansatt">

                                            <h2>
                                                Tildel HR-ansatt
                                            </h2>

                                            <div class="mr_fleksi_content">

                                                <form action="" method="post">
                                                    <table>
                                                        <tr class="input-group">
                                                            <td>Ny ansatt: </td>
                                                            <td><?php employeeSelect(); ?></td>
                                                        </tr>

                                                        <tr class="input-group">
                                                            <td>Hr-ansatt: </td>
                                                            <td><?php hrSelect(); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary" name="assignHr">Tildel HR-ansatt</button>
                                                </form>
                                                <!--
                                                <form action="" method="post">
                                                    <table>
                                                        <tr class="input-group">
                                                            <td>Ny ansatt: </td>
                                                            <td><?php //employeeSelect(); ?></td>
                                                        </tr>
                                                        <tr class="input-group">

                                                            <td>Ny HR-ansatt: </td>
                                                            <td><?php //hrSelect(); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary" name="updateHr">Tildel ny HR-ansatt</button>
                                                </form> -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- </div> --> <!-- END: innholdskolonne -->
                        </div> <!-- END: section -->
                    </div> <!-- Main area content: END -->
                </div>
            </div>
        </div><!--end:frameWrapper-->
    </div>
</div>
<div class="clearfloat"></div>


<?php
include "../../Elements/Footer.php";
?>




</body>
</html>