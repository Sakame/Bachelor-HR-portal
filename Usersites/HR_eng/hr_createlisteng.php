<?php
include "hr_session.php"; ?>

<!DOCTYPE html>


<html itemscope itemtype="http://schema.org/Article" xmlns="http://www.w3.org/1999/xhtml" xml:lang="nb" lang="nb">
<head>




    <title>OsloMet - HR Create Checklist</title>
    <?php
    include_once "../../Elements/Metaheads.php";
    ?>
    <style>
        .CreateChecklistTable {
            border-collapse: collapse;
        }
    </style>

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

        <a href="../HR/hr_createlist.php">Norsk</a>
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
                                        <div id="createList" class="page tilsatt" >
                                            <h2>Create checklist</h2>
                                            <form action="" method="post">
                                                <table class="CreateChecklistTable">
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable" >Firstname: </td>
                                                        <td id="CreateChecklistTable" ><input type="text" name='firstname' class="field comment-alerts" id="input-box" placeholder="Fornavn" required/> </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">Surname: </td>
                                                        <td id="CreateChecklistTable"><input type="text" name="lastname" class="field comment-alerts" id="input-box" placeholder="Etternavn" required/> </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">Workposition: </td>
                                                        <td id="CreateChecklistTable"><select name="workposition" class="field comment-alerts" id="choose2" required />
                                                            <option value=""></option>
                                                            <option value="Leder">Leader</option>
                                                            <option value="Ansatt">Employee</option>
                                                        </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">International: </td>
                                                        <td id="CreateChecklistTable"><select name="international" class="field comment-alerts" id="choose2" required>
                                                                <option value=""></option>
                                                                <option value="Ja">Yes</option>
                                                                <option value="Nei">No</option>
                                                        </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">Startdate: </td>
                                                        <td id="CreateChecklistTable"><input type='date' name="startdate" class="field comment-alerts" id="datePicker" required /> </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">Pick Responsible Leader: </td>
                                                        <td id="CreateChecklistTable">
                                                            <?php selectLeader() ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">Pick Responsible HR person: </td>
                                                        <td id="CreateChecklistTable">
                                                            <?php selectHr() ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="input-group" id="CreateChecklistTable">
                                                        <td id="CreateChecklistTable">Pick Responsible Mentor: </td>
                                                        <td id="CreateChecklistTable">
                                                            <?php selectMentor() ?>
                                                        </td>
                                                    </tr>

                                                </table>
                                                <button class="btn btn-cancel" type="button">Cancel</button>
                                                <button type="submit" class="btn btn-primary" name="createCheckListEn">Register</button>
                                            </form>


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