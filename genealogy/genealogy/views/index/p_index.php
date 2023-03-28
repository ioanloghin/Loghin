<div id="Content">
	<div id="AG_Page">
        <div id="AG_Slider">
            <ul id="AGS-nav">
                <li id="AGS-nav-7" onclick="agSliders(7);">&nbsp;</li>
                <li id="AGS-nav-6" onclick="agSliders(6);">&nbsp;</li>
                <li id="AGS-nav-5" onclick="agSliders(5);">&nbsp;</li>
                <li id="AGS-nav-4" onclick="agSliders(4);">&nbsp;</li>
                <li id="AGS-nav-3" onclick="agSliders(3);">&nbsp;</li>
                <li id="AGS-nav-2" onclick="agSliders(2);">&nbsp;</li>
                <li id="AGS-nav-1" onclick="agSliders(1);">&nbsp;</li>
                <li id="AGS-nav-0" onclick="agSliders(0);" class="selected">&nbsp;</li>
            </ul>
            <div id="AGS_0">
                <div class="ags-details">
                    <div class="ags-h1">Ready to make your first discovery?</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                    <?php
                    if(!isset($_SESSION[SESSION]['quickCreate'])) $_SESSION[SESSION]['quickCreate'] = array();
                    
                    // copil
                    if(isset($_POST['copil_id'])) $_SESSION[SESSION]['quickCreate']['copil']['id'] = AntiHack::filtru($_POST['copil_id'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['id'])) $_SESSION[SESSION]['quickCreate']['copil']['id'] = NULL;
                    
                    if(isset($_POST['copil_nume'])) $_SESSION[SESSION]['quickCreate']['copil']['nume'] = AntiHack::filtru($_POST['copil_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['nume'])) $_SESSION[SESSION]['quickCreate']['copil']['nume'] = NULL;
                    
                    if(isset($_POST['copil_nume'])) $_SESSION[SESSION]['quickCreate']['copil']['prenume'] = AntiHack::filtru($_POST['copil_prenume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['prenume'])) $_SESSION[SESSION]['quickCreate']['copil']['prenume'] = NULL;
                    
                    if(isset($_POST['copil_gender'])) $_SESSION[SESSION]['quickCreate']['copil']['gender'] = AntiHack::filtru($_POST['copil_gender'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['gender'])) $_SESSION[SESSION]['quickCreate']['copil']['gender'] = 1;
                    
                    if(isset($_POST['copil_born_dd'])) $_SESSION[SESSION]['quickCreate']['copil']['born'] = $_POST['copil_born_yy'].'-'.$_POST['copil_born_mm'].'-'.$_POST['copil_born_dd'];
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['born'])) $_SESSION[SESSION]['quickCreate']['copil']['born'] = '2011-01-01';
                    
                    if(isset($_POST['copil_email'])) $_SESSION[SESSION]['quickCreate']['copil']['email'] = AntiHack::filtru($_POST['copil_email'], 1);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['email'])) $_SESSION[SESSION]['quickCreate']['copil']['email'] = NULL;
                    
                    // tata
                    if(isset($_POST['tata_id'])) $_SESSION[SESSION]['quickCreate']['tata']['id'] = AntiHack::filtru($_POST['tata_id'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['id'])) $_SESSION[SESSION]['quickCreate']['tata']['id'] = NULL;
                    
                    if(isset($_POST['tata_nume'])) $_SESSION[SESSION]['quickCreate']['tata']['nume'] = AntiHack::filtru($_POST['tata_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['nume'])) $_SESSION[SESSION]['quickCreate']['tata']['nume'] = NULL;
                    
                    if(isset($_POST['tata_prenume'])) $_SESSION[SESSION]['quickCreate']['tata']['prenume'] = AntiHack::filtru($_POST['tata_prenume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['prenume'])) $_SESSION[SESSION]['quickCreate']['tata']['prenume'] = NULL;
                    
                    if(isset($_POST['tata_gender'])) $_SESSION[SESSION]['quickCreate']['tata']['gender'] = AntiHack::filtru($_POST['tata_gender'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['gender'])) $_SESSION[SESSION]['quickCreate']['tata']['gender'] = 1;
                    
                    if(isset($_POST['tata_born_dd'])) $_SESSION[SESSION]['quickCreate']['tata']['born'] = $_POST['tata_born_yy'].'-'.$_POST['tata_born_mm'].'-'.$_POST['tata_born_dd'];
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['born'])) $_SESSION[SESSION]['quickCreate']['tata']['born'] = '2011-01-01';
                    
                    if(isset($_POST['tata_email'])) $_SESSION[SESSION]['quickCreate']['tata']['email'] = AntiHack::filtru($_POST['tata_email'], 1);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['email'])) $_SESSION[SESSION]['quickCreate']['tata']['email'] = NULL;
                    
                    // mama
                    if(isset($_POST['mama_id'])) $_SESSION[SESSION]['quickCreate']['mama']['id'] = AntiHack::filtru($_POST['mama_id'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['id'])) $_SESSION[SESSION]['quickCreate']['mama']['id'] = NULL;
                    
                    if(isset($_POST['mama_nume'])) $_SESSION[SESSION]['quickCreate']['mama']['nume'] = AntiHack::filtru($_POST['mama_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['nume'])) $_SESSION[SESSION]['quickCreate']['mama']['nume'] = NULL;
                    
                    if(isset($_POST['mama_prenume'])) $_SESSION[SESSION]['quickCreate']['mama']['prenume'] = AntiHack::filtru($_POST['mama_prenume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['prenume'])) $_SESSION[SESSION]['quickCreate']['mama']['prenume'] = NULL;
                    
                    if(isset($_POST['mama_gender'])) $_SESSION[SESSION]['quickCreate']['mama']['gender'] = AntiHack::filtru($_POST['mama_gender'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['gender'])) $_SESSION[SESSION]['quickCreate']['mama']['gender'] = 2;
                    
                    if(isset($_POST['mama_born_dd'])) $_SESSION[SESSION]['quickCreate']['mama']['born'] = $_POST['mama_born_yy'].'-'.$_POST['mama_born_mm'].'-'.$_POST['mama_born_dd'];
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['born'])) $_SESSION[SESSION]['quickCreate']['mama']['born'] ='2011-01-01';
                    
                    if(isset($_POST['arbore_nume'])) $_SESSION[SESSION]['quickCreate']['arbore']['nume'] = AntiHack::filtru($_POST['arbore_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['arbore']['nume'])) $_SESSION[SESSION]['quickCreate']['arbore']['nume'] = NULL;
                    
                    if(isset($_POST['mama_email'])) $_SESSION[SESSION]['quickCreate']['mama']['email'] = AntiHack::filtru($_POST['mama_email'], 1);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['email'])) $_SESSION[SESSION]['quickCreate']['mama']['email'] = NULL;
                    
                    // verificari
                    $theError = NULL;
                    if(isset($_POST['continue']))
                    {
                        if($theError == NULL)
                        {
                            // se creeaza arborele
                            if(isset($_SESSION[SESSION]['quickCreate']['arbore']['nume']) and $_SESSION[SESSION]['quickCreate']['arbore']['nume'] != NULL)
                            {
                                $id_arbore = AG_create_arbore($_SESSION[SESSION]['user']['id'], $_SESSION[SESSION]['quickCreate']['arbore']['nume']);
                                //
                                // se creeaza familia
                                $id_family = AG_create_family($id_arbore, $_SESSION[SESSION]['quickCreate']['tata']['nume'], 'current', 0);
                                //
                                // se adauga profilul copilului, in caz de nevoie se creeaza profil de membru
                                if($_SESSION[SESSION]['quickCreate']['copil']['id'] == 0)
                                {
                                    $info = array();
                                    $info['nume'] = $_SESSION[SESSION]['quickCreate']['copil']['nume'];
                                    $info['prenume'] = $_SESSION[SESSION]['quickCreate']['copil']['prenume'];
                                    $info['gender'] = $_SESSION[SESSION]['quickCreate']['copil']['gender'];
                                    $info['born'] = $_SESSION[SESSION]['quickCreate']['copil']['born'];
                                    $_SESSION[SESSION]['quickCreate']['copil']['id'] = AG_create_membru($info);
                                    unset($info);
                                }
                                if($_SESSION[SESSION]['quickCreate']['copil']['id'] > 0)
                                    AG_add_membru($_SESSION[SESSION]['quickCreate']['copil']['id'], 'copil', $id_family);
                                //
                                // se adauga profilul tatalui, in caz de nevoie se creeaza profil de membru
                                if($_SESSION[SESSION]['quickCreate']['tata']['id'] == 0)
                                {
                                    $info = array();
                                    $info['nume'] = $_SESSION[SESSION]['quickCreate']['tata']['nume'];
                                    $info['prenume'] = $_SESSION[SESSION]['quickCreate']['tata']['prenume'];
                                    $info['gender'] = $_SESSION[SESSION]['quickCreate']['tata']['gender'];
                                    $info['born'] = $_SESSION[SESSION]['quickCreate']['tata']['born'];
                                    if($info['nume'] != NULL or $info['prenume'] != NULL)
                                        $_SESSION[SESSION]['quickCreate']['tata']['id'] = AG_create_membru($info);
                                    unset($info);
                                }
                                if($_SESSION[SESSION]['quickCreate']['tata']['id'] > 0)
                                    AG_add_membru($_SESSION[SESSION]['quickCreate']['tata']['id'], 'tata', $id_family);
                                //
                                // se adauga profilul mamei, in caz de nevoie se creeaza profil de membru
                                if($_SESSION[SESSION]['quickCreate']['mama']['id'] == 0)
                                {
                                    $info = array();
                                    $info['nume'] = $_SESSION[SESSION]['quickCreate']['mama']['nume'];
                                    $info['prenume'] = $_SESSION[SESSION]['quickCreate']['mama']['prenume'];
                                    $info['gender'] = $_SESSION[SESSION]['quickCreate']['mama']['gender'];
                                    $info['born'] = $_SESSION[SESSION]['quickCreate']['mama']['born'];
                                    if($info['nume'] != NULL or $info['prenume'] != NULL)
                                        $_SESSION[SESSION]['quickCreate']['mama']['id'] = AG_create_membru($info);
                                    unset($info);
                                }
                                if($_SESSION[SESSION]['quickCreate']['mama']['id'] > 0)
                                    AG_add_membru($_SESSION[SESSION]['quickCreate']['mama']['id'], 'mama', $id_family);
                                //
                                //
                            }
                        }
                        else
                        {
                            
                        }
                    }
                    
                    /*if($_SESSION[SESSION]['user']['id'] > 0)
                    {
                        $temp = MySQL_DB::sql_select_list($AGsql['tabelUsers'], "`".$AGsql['tabelUsersColId']."` = '".$_SESSION[SESSION]['user']['id']."'", NULL, 0, 1);
                        $quickCreate['nume'] = (isset($temp[1]['nume'])) ? $temp[1]['nume'] : $quickCreate['nume'];
                        $quickCreate['prenume'] = (isset($temp[1]['prenume'])) ? $temp[1]['prenume'] : $quickCreate['prenume'];
                        unset($temp);
                    }*/
                    ?>
                    <form id="QCB_1" class="quick-create-box" action="<?php echo ROOT;?>search/" method="post">
                        <fieldset>
                            <span class="qcb-title">Choose who to search for:</span>
                            <div style="margin-top:20px;">
                                <span id="QS_1_but1" class="ag-inputRadio1-active" style="margin-left:15px;" onclick="changeFancyRadio(3, 'QS_1_but', 1, 'QS_radioH1');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, 'QS_1_but', 1, 'QS_radioH1');">Partea tatalui</span>
                                <span id="QS_1_but2" class="ag-inputRadio1" style="margin-left:15px;" onclick="changeFancyRadio(3, 'QS_1_but', 2, 'QS_radioH1');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, 'QS_1_but', 2, 'QS_radioH1');">Partea mamei</span>
                                <span id="QS_1_but3" class="ag-inputRadio1" style="margin-left:15px;" onclick="changeFancyRadio(3, 'QS_1_but', 3, 'QS_radioH1');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(3, 'QS_1_but', 3, 'QS_radioH1');">Partea altcuiva</span>
                            </div>
                            <div id="AGS_0_minislide1">
                                <input id="QS_radioH1" type="hidden" name="qs_from" value="1" />
                                <input id="QS_radioH2" type="hidden" name="qs_gender" value="0" />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:20px;">
                                    <label>Nume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="qs_firstname" style="width:160px;" maxlength="30" value="" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:10px; margin-top:20px;">
                                    <label>Prenume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="qs_lastname" style="width:130px;" maxlength="60" value="" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:20px;">
                                    <label>Varsta:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="qs_age" style="width:40px;" maxlength="3" value="" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <br />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px; width:165px; padding-top:4px;">
                                    <label>Sex:</label>
                                    <span id="QS_radio1" class="ag-inputRadio1" onclick="changeFancyRadio(2, 'QS_radio', 1, 'QS_radioH2');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QS_radio', 1, 'QS_radioH2');">Barbat</span>
                                    <span id="QS_radio2" class="ag-inputRadio1" onclick="changeFancyRadio(2, 'QS_radio', 2, 'QS_radioH2');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QS_radio', 2, 'QS_radioH2');">Femeie</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Adresa E-mail:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="qs_email" style="width:195px;" maxlength="150" value="" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                            </div>
                        </fieldset>
                        <div class="agbut-1" style="margin-left:60px; margin-top:30px;"><span class="agbut-1-left">&nbsp;</span><button class="agbut-1-center" type="submit">Get Started</button><span class="agbut-1-right">&nbsp;</span></div>
                    </form>
                </div>
            </div>
            <div id="AGS_1" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Slide #2</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                </div>
            </div>
            <div id="AGS_2" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Slide #3</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                </div>
            </div>
            <div id="AGS_3" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Slide #4</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                </div>
            </div>
            <div id="AGS_4" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Slide #5</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                </div>
            </div>
            <div id="AGS_5" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Ready to make your first discovery?</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                    <?php
                    if(!isset($_SESSION[SESSION]['quickCreate'])) $_SESSION[SESSION]['quickCreate'] = array();
                    
                    // copil
                    if(isset($_POST['copil_id'])) $_SESSION[SESSION]['quickCreate']['copil']['id'] = AntiHack::filtru($_POST['copil_id'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['id'])) $_SESSION[SESSION]['quickCreate']['copil']['id'] = NULL;
                    
                    if(isset($_POST['copil_nume'])) $_SESSION[SESSION]['quickCreate']['copil']['nume'] = AntiHack::filtru($_POST['copil_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['nume'])) $_SESSION[SESSION]['quickCreate']['copil']['nume'] = NULL;
                    
                    if(isset($_POST['copil_nume'])) $_SESSION[SESSION]['quickCreate']['copil']['prenume'] = AntiHack::filtru($_POST['copil_prenume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['prenume'])) $_SESSION[SESSION]['quickCreate']['copil']['prenume'] = NULL;
                    
                    if(isset($_POST['copil_gender'])) $_SESSION[SESSION]['quickCreate']['copil']['gender'] = AntiHack::filtru($_POST['copil_gender'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['gender'])) $_SESSION[SESSION]['quickCreate']['copil']['gender'] = 1;
                    
                    if(isset($_POST['copil_born_dd'])) $_SESSION[SESSION]['quickCreate']['copil']['born'] = $_POST['copil_born_yy'].'-'.$_POST['copil_born_mm'].'-'.$_POST['copil_born_dd'];
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['born'])) $_SESSION[SESSION]['quickCreate']['copil']['born'] = '2011-01-01';
                    
                    if(isset($_POST['copil_email'])) $_SESSION[SESSION]['quickCreate']['copil']['email'] = AntiHack::filtru($_POST['copil_email'], 1);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['copil']['email'])) $_SESSION[SESSION]['quickCreate']['copil']['email'] = NULL;
                    
                    // tata
                    if(isset($_POST['tata_id'])) $_SESSION[SESSION]['quickCreate']['tata']['id'] = AntiHack::filtru($_POST['tata_id'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['id'])) $_SESSION[SESSION]['quickCreate']['tata']['id'] = NULL;
                    
                    if(isset($_POST['tata_nume'])) $_SESSION[SESSION]['quickCreate']['tata']['nume'] = AntiHack::filtru($_POST['tata_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['nume'])) $_SESSION[SESSION]['quickCreate']['tata']['nume'] = NULL;
                    
                    if(isset($_POST['tata_prenume'])) $_SESSION[SESSION]['quickCreate']['tata']['prenume'] = AntiHack::filtru($_POST['tata_prenume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['prenume'])) $_SESSION[SESSION]['quickCreate']['tata']['prenume'] = NULL;
                    
                    if(isset($_POST['tata_gender'])) $_SESSION[SESSION]['quickCreate']['tata']['gender'] = AntiHack::filtru($_POST['tata_gender'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['gender'])) $_SESSION[SESSION]['quickCreate']['tata']['gender'] = 1;
                    
                    if(isset($_POST['tata_born_dd'])) $_SESSION[SESSION]['quickCreate']['tata']['born'] = $_POST['tata_born_yy'].'-'.$_POST['tata_born_mm'].'-'.$_POST['tata_born_dd'];
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['born'])) $_SESSION[SESSION]['quickCreate']['tata']['born'] = '2011-01-01';
                    
                    if(isset($_POST['tata_email'])) $_SESSION[SESSION]['quickCreate']['tata']['email'] = AntiHack::filtru($_POST['tata_email'], 1);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['tata']['email'])) $_SESSION[SESSION]['quickCreate']['tata']['email'] = NULL;
                    
                    // mama
                    if(isset($_POST['mama_id'])) $_SESSION[SESSION]['quickCreate']['mama']['id'] = AntiHack::filtru($_POST['mama_id'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['id'])) $_SESSION[SESSION]['quickCreate']['mama']['id'] = NULL;
                    
                    if(isset($_POST['mama_nume'])) $_SESSION[SESSION]['quickCreate']['mama']['nume'] = AntiHack::filtru($_POST['mama_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['nume'])) $_SESSION[SESSION]['quickCreate']['mama']['nume'] = NULL;
                    
                    if(isset($_POST['mama_prenume'])) $_SESSION[SESSION]['quickCreate']['mama']['prenume'] = AntiHack::filtru($_POST['mama_prenume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['prenume'])) $_SESSION[SESSION]['quickCreate']['mama']['prenume'] = NULL;
                    
                    if(isset($_POST['mama_gender'])) $_SESSION[SESSION]['quickCreate']['mama']['gender'] = AntiHack::filtru($_POST['mama_gender'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['gender'])) $_SESSION[SESSION]['quickCreate']['mama']['gender'] = 2;
                    
                    if(isset($_POST['mama_born_dd'])) $_SESSION[SESSION]['quickCreate']['mama']['born'] = $_POST['mama_born_yy'].'-'.$_POST['mama_born_mm'].'-'.$_POST['mama_born_dd'];
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['born'])) $_SESSION[SESSION]['quickCreate']['mama']['born'] ='2011-01-01';
                    
                    if(isset($_POST['arbore_nume'])) $_SESSION[SESSION]['quickCreate']['arbore']['nume'] = AntiHack::filtru($_POST['arbore_nume'], 3);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['arbore']['nume'])) $_SESSION[SESSION]['quickCreate']['arbore']['nume'] = NULL;
                    
                    if(isset($_POST['mama_email'])) $_SESSION[SESSION]['quickCreate']['mama']['email'] = AntiHack::filtru($_POST['mama_email'], 1);
                    elseif(!isset($_SESSION[SESSION]['quickCreate']['mama']['email'])) $_SESSION[SESSION]['quickCreate']['mama']['email'] = NULL;
                    
                    // verificari
                    $theError = NULL;
                    if(isset($_POST['continue']))
                    {
                        if($theError == NULL)
                        {
                            // se creeaza arborele
                            if(isset($_SESSION[SESSION]['quickCreate']['arbore']['nume']) and $_SESSION[SESSION]['quickCreate']['arbore']['nume'] != NULL)
                            {
                                $id_arbore = AG_create_arbore($_SESSION[SESSION]['user']['id'], $_SESSION[SESSION]['quickCreate']['arbore']['nume']);
                                //
                                // se creeaza familia
                                $id_family = AG_create_family($id_arbore, $_SESSION[SESSION]['quickCreate']['tata']['nume'], 'current', 0);
                                //
                                // se adauga profilul copilului, in caz de nevoie se creeaza profil de membru
                                if($_SESSION[SESSION]['quickCreate']['copil']['id'] == 0)
                                {
                                    $info = array();
                                    $info['nume'] = $_SESSION[SESSION]['quickCreate']['copil']['nume'];
                                    $info['prenume'] = $_SESSION[SESSION]['quickCreate']['copil']['prenume'];
                                    $info['gender'] = $_SESSION[SESSION]['quickCreate']['copil']['gender'];
                                    $info['born'] = $_SESSION[SESSION]['quickCreate']['copil']['born'];
                                    $_SESSION[SESSION]['quickCreate']['copil']['id'] = AG_create_membru($info);
                                    unset($info);
                                }
                                if($_SESSION[SESSION]['quickCreate']['copil']['id'] > 0)
                                    AG_Operation::AG_add_membru($_SESSION[SESSION]['quickCreate']['copil']['id'], 'copil', $id_family);
                                //
                                // se adauga profilul tatalui, in caz de nevoie se creeaza profil de membru
                                if($_SESSION[SESSION]['quickCreate']['tata']['id'] == 0)
                                {
                                    $info = array();
                                    $info['nume'] = $_SESSION[SESSION]['quickCreate']['tata']['nume'];
                                    $info['prenume'] = $_SESSION[SESSION]['quickCreate']['tata']['prenume'];
                                    $info['gender'] = $_SESSION[SESSION]['quickCreate']['tata']['gender'];
                                    $info['born'] = $_SESSION[SESSION]['quickCreate']['tata']['born'];
                                    if($info['nume'] != NULL or $info['prenume'] != NULL)
                                        $_SESSION[SESSION]['quickCreate']['tata']['id'] = AG_create_membru($info);
                                    unset($info);
                                }
                                if($_SESSION[SESSION]['quickCreate']['tata']['id'] > 0)
                                    AG_Operation::AG_add_membru($_SESSION[SESSION]['quickCreate']['tata']['id'], 'tata', $id_family);
                                //
                                // se adauga profilul mamei, in caz de nevoie se creeaza profil de membru
                                if($_SESSION[SESSION]['quickCreate']['mama']['id'] == 0)
                                {
                                    $info = array();
                                    $info['nume'] = $_SESSION[SESSION]['quickCreate']['mama']['nume'];
                                    $info['prenume'] = $_SESSION[SESSION]['quickCreate']['mama']['prenume'];
                                    $info['gender'] = $_SESSION[SESSION]['quickCreate']['mama']['gender'];
                                    $info['born'] = $_SESSION[SESSION]['quickCreate']['mama']['born'];
                                    if($info['nume'] != NULL or $info['prenume'] != NULL)
                                        $_SESSION[SESSION]['quickCreate']['mama']['id'] = AG_create_membru($info);
                                    unset($info);
                                }
                                if($_SESSION[SESSION]['quickCreate']['mama']['id'] > 0)
                                    AG_Operation::AG_add_membru($_SESSION[SESSION]['quickCreate']['mama']['id'], 'mama', $id_family);
                                //
                                //
                            }
                        }
                        else
                        {
                            
                        }
                    }
                    
                    /*if($_SESSION[SESSION]['user']['id'] > 0)
                    {
                        $temp = MySQL_DB::sql_select_list($AGsql['tabelUsers'], "`".$AGsql['tabelUsersColId']."` = '".$_SESSION[SESSION]['user']['id']."'", NULL, 0, 1);
                        $quickCreate['nume'] = (isset($temp[1]['nume'])) ? $temp[1]['nume'] : $quickCreate['nume'];
                        $quickCreate['prenume'] = (isset($temp[1]['prenume'])) ? $temp[1]['prenume'] : $quickCreate['prenume'];
                        unset($temp);
                    }*/
                    ?>
                    <div id="QCB_5" class="quick-create-box">
                        <fieldset>
                            <span class="qcb-title">Creaza rapid un arbore!</span>
                            <div style="margin-top:10px;">
                                <span id="QCB_1_but1" class="ag-inputRadio1-active" style="margin-left:15px;" onclick="changeMiniSlide(1);">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeMiniSlide(1);">Despre mine</span>
                                <span id="QCB_1_but2" class="ag-inputRadio1" style="margin-left:15px;" onclick="changeMiniSlide(2);">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeMiniSlide(2);">Despre tat&#259;</span>
                                <span id="QCB_1_but3" class="ag-inputRadio1" style="margin-left:15px;" onclick="changeMiniSlide(3);">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeMiniSlide(3);">Despre mam&#259;</span>
                            </div>
                            <div id="AGS_5_minislide1">
                                <input id="QCB_M1_radioH" type="hidden" name="copil_gender" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['gender'];?>" />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Nume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="copil_nume" style="width:160px;" maxlength="30" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['nume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Prenume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="copil_prenume" style="width:190px;" maxlength="60" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <br />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:7px; width:170px; padding-top:4px;">
                                    <label>Sex:</label>
                                    <span id="QCB_M1_radio1" class="ag-inputRadio1<?php echo ($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 1) ? '-active' : '';?>" onclick="changeFancyRadio(2, 'QCB_M1_radio', 1, 'QCB_M1_radioH');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QCB_M1_radio', 1, 'QCB_M1_radioH');">Barbat</span>
                                    <span id="QCB_M1_radio2" class="ag-inputRadio1<?php echo ($_SESSION[SESSION]['quickCreate']['copil']['gender'] == 2) ? '-active' : '';?>" onclick="changeFancyRadio(2, 'QCB_M1_radio', 2, 'QCB_M1_radioH');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QCB_M1_radio', 2, 'QCB_M1_radioH');">Femeie</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">
                                    <label>Data na&#351;terii (ziua/luna/anul):</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="copil_born_dd" style="width:45px;" maxlength="2" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                    <span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="copil_born_mm" style="width:45px;" maxlength="2" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                    <span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="copil_born_yy" style="width:70px;" maxlength="4" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:3px;">
                                    <label>Adresa E-mail:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="copil_email" style="width:375px;" maxlength="150" value="<?php echo $_SESSION[SESSION]['quickCreate']['copil']['email'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                            </div>
                            <div id="AGS_5_minislide2" style="display:none;">
                                <input id="QCB_M2_radioH" type="hidden" name="tata_gender" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['gender'];?>" />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Nume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="tata_nume" style="width:160px;" maxlength="30" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['nume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Prenume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="tata_prenume" style="width:190px;" maxlength="60" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <br />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:7px; width:170px; padding-top:4px;">
                                    <label>Sex:</label>
                                    <span id="QCB_M2_radio1" class="ag-inputRadio1<?php echo ($_SESSION[SESSION]['quickCreate']['tata']['gender'] == 1) ? '-active' : '';?>" onclick="changeFancyRadio(2, 'QCB_M2_radio', 1, 'QCB_M2_radioH');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QCB_M2_radio', 1, 'QCB_M2_radioH');">Barbat</span>
                                    <span id="QCB_M2_radio2" class="ag-inputRadio1<?php echo ($_SESSION[SESSION]['quickCreate']['tata']['gender'] == 2) ? '-active' : '';?>" onclick="changeFancyRadio(2, 'QCB_M2_radio', 2, 'QCB_M2_radioH');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QCB_M2_radio', 2, 'QCB_M2_radioH');">Femeie</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">
                                    <label>Data na&#351;terii (ziua/luna/anul):</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="tata_born_dd" style="width:45px;" maxlength="2" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                    <span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="tata_born_mm" style="width:45px;" maxlength="2" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                    <span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="tata_born_yy" style="width:70px;" maxlength="4" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:3px;">
                                    <label>Adresa E-mail:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="tata_email" style="width:375px;" maxlength="150" value="<?php echo $_SESSION[SESSION]['quickCreate']['tata']['email'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                            </div>
                            <div id="AGS_5_minislide3" style="display:none;">
                                <input id="QCB_M3_radioH" type="hidden" name="mama_gender" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['gender'];?>" />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Nume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="mama_nume" style="width:160px;" maxlength="30" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['nume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:10px;">
                                    <label>Prenume:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="mama_prenume" style="width:190px;" maxlength="60" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <br />
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:7px; width:170px; padding-top:4px;">
                                    <label>Sex:</label>
                                    <span id="QCB_M3_radio1" class="ag-inputRadio1<?php echo ($_SESSION[SESSION]['quickCreate']['mama']['gender'] == 1) ? '-active' : '';?>" onclick="changeFancyRadio(2, 'QCB_M3_radio', 1, 'QCB_M3_radioH');">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QCB_M3_radio', 1, 'QCB_M3_radioH');">Barbat</span>
                                    <span id="QCB_M3_radio2" class="ag-inputRadio1<?php echo ($_SESSION[SESSION]['quickCreate']['mama']['gender'] == 2) ? '-active' : '';?>" onclick="changeFancyRadio(2, 'QCB_M3_radio', 2, 'QCB_M3_radioH');" style="margin-left:15px;">&nbsp;</span> <span class="ag-inputRadio1-label" onclick="changeFancyRadio(2, 'QCB_M3_radio', 2, 'QCB_M3_radioH');">Femeie</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:5px;">
                                    <label>Data na&#351;terii (ziua/luna/anul):</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="mama_born_dd" style="width:45px;" maxlength="2" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                    <span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="mama_born_mm" style="width:45px;" maxlength="2" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                    <span class="qcb-input-left" style="margin-left:5px;">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="mama_born_yy" style="width:70px;" maxlength="4" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['prenume'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                                <div class="qcb-input-box" style="margin-left:15px; margin-top:3px;">
                                    <label>Adresa E-mail:</label>
                                    <span class="qcb-input-left">&nbsp;</span>
                                    <span class="qcb-input-center"><input type="text" name="mama_email" style="width:375px;" maxlength="150" value="<?php echo $_SESSION[SESSION]['quickCreate']['mama']['email'];?>" /></span>
                                    <span class="qcb-input-right">&nbsp;</span>
                                </div>
                            </div>
                        </fieldset>
                        <div class="agbut-1" style="margin-left:60px; margin-top:30px;"><span class="agbut-1-left">&nbsp;</span><button class="agbut-1-center" type="submit">Create It</button><span class="agbut-1-right">&nbsp;</span></div>
                    </div>
                </div>
            </div>
            <div id="AGS_6" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Slide #7</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                </div>
            </div>
            <div id="AGS_7" style="display:none;">
                <div class="ags-details">
                    <div class="ags-h1">Slide #8</div>
                    <div class="ags-p">It's not just history. It's your history. So start with<br />yourself and we'll help you find more about your<br />heritage.</div>
                </div>
            </div>
        </div>
        <div id="AGI_Content" class="page-bottom-effect">
            <div class="dnaLine1"></div>
            <br />
            <div id="AGcontentLeft">
                <span class="agcl-title">genealogical records you'll find on Genealogy.Loghin.com</span>
                <div class="agcl-article">
                    <span class="agcl-article-title">Familii din Istorie</span>
                    <span class="agcl-article-image"><img src="<?php echo base_url('content/articles/old_family.jpg');?>" width="210" height="100" alt="" title="" /></span>
                    <span class="agcl-article-details">Maecenas eleifend, erat nec comm odo dictum, orci neque lacinia felis non interdum magna orci ut erat. </span>
                </div>
                <div class="agcl-article">
                    <span class="agcl-article-title">Familii din Istorie</span>
                    <span class="agcl-article-image"><img src="<?php echo base_url('content/articles/modern_family.jpg');?>" width="210" height="100" alt="" title="" /></span>
                    <span class="agcl-article-details">Maecenas eleifend, erat nec comm odo dictum, orci neque lacinia felis non interdum magna orci ut erat. </span>
                </div>
                <div class="agcl-article">
                    <span class="agcl-article-title">Familii din Istorie</span>
                    <span class="agcl-article-image"><img src="<?php echo base_url('content/articles/one_man.jpg');?>" width="210" height="100" alt="" title="" /></span>
                    <span class="agcl-article-details">Maecenas eleifend, erat nec comm odo dictum, orci neque lacinia felis non interdum magna orci ut erat. </span>
                </div>
                <div class="agcl-article">
                    <span class="agcl-article-title">Familii din Istorie</span>
                    <span class="agcl-article-image"><img src="<?php echo base_url('content/articles/old_family.jpg');?>" width="210" height="100" alt="" title="" /></span>
                    <span class="agcl-article-details">Maecenas eleifend, erat nec comm odo dictum, orci neque lacinia felis non interdum magna orci ut erat. </span>
                </div>
                <div class="agcl-article">
                    <span class="agcl-article-title">Familii din Istorie</span>
                    <span class="agcl-article-image"><img src="<?php echo base_url('content/articles/modern_family.jpg');?>" width="210" height="100" alt="" title="" /></span>
                    <span class="agcl-article-details">Maecenas eleifend, erat nec comm odo dictum, orci neque lacinia felis non interdum magna orci ut erat. </span>
                </div>
                <div class="agcl-article">
                    <span class="agcl-article-title">Familii din Istorie</span>
                    <span class="agcl-article-image"><img src="<?php echo base_url('content/articles/one_man.jpg');?>" width="210" height="100" alt="" title="" /></span>
                    <span class="agcl-article-details">Maecenas eleifend, erat nec comm odo dictum, orci neque lacinia felis non interdum magna orci ut erat. </span>
                </div>
                <div class="cleft"></div>
                <div class="agLinei" style="margin:5px 3px 10px 0px;"></div>
                <div class="ag-other-records"><strong>Other Records</strong><span class="ag_icon-arrow_up">&nbsp;</span></div>
            </div>
            <div id="AGcontentRight">
                <?php
                if($MyUser->logged())
                {
                    $this_tree_id = AG_Operation::myTree($_SESSION[SESSION]['user']['id']);
                    if($this_tree_id)
                        $optionR = '<a href="'.ROOT.'tree-'.$this_tree_id.'/'.$_SESSION[SESSION]['user']['id'].'/">My family tree</a>';
                    else
                        $optionR = '<span>No tree</span>';
                    
                    //$this_avatar = '<img src="'.str_replace('thumbs/', 'medium/', $USER->info(DBT_USER_INFO_C5)).'" width="168" height="134" alt="" title="" />';
                    ?>
                    <div class="agcr-myaccount-fix">
                        <div class="agcr-myaccount">
                            <div class="agcr-myaccount-left"><a class="ag_iconB-desc" href="<?php echo ROOT.'tree-'.$this_tree_id.'/'.$_SESSION[SESSION]['user']['id'].'/desc';?>">&nbsp;</a></div>
                            <div class="agcr-myaccount-center"><div class="agimgmask" style="padding:2px;"><?php echo $this_avatar;?></div></div>
                            <div class="agcr-myaccount-right"><a class="ag_iconB-asc" href="<?php echo ROOT.'tree-'.$this_tree_id.'/'.$_SESSION[SESSION]['user']['id'].'/asc';?>">&nbsp;</a></div>
                            <div class="cleft"></div>
                            <div class="agcr-myaccount-optionL"><a href="#">My profile</a></div>
                            <div class="agcr-myaccount-optionR"><?php echo $optionR;?></div>
                        </div>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <span class="agcl-title">Profile &amp; Calendar</span>
                    <form method="post" class="agcr-login" action="<?php echo anchor('login', 'in');?>">
                        <fieldset class="agcr-login-input">
                            <input type="text" name="usr" value="" />
                        </fieldset>
                        <fieldset class="agcr-login-input">
                            <input type="password" name="pass" value="" />
                        </fieldset>
                        <fieldset>
                            <a href="#" class="ag-link-forgot">Forgot your password?</a>
                            <div class="agbut-2" style="margin-right:6px; margin-top:10px;"><span class="agbut-2-left">&nbsp;</span><button class="agbut-2-center" type="submit" name="auth">Sign In</button><span class="agbut-2-right">&nbsp;</span></div>
                            <a href="#" class="ag-link-register">Register new account.</a>
                        </fieldset>
                    </form>
                    <?php
                }
                ?>
                <div id="AG_Calendary">
                    <span class="agcr-title-line"><strong>Calendar</strong></span>
                    <div id="datepicker"></div>
                </div>
                <!--<div id="AG_Calendary">
                    <span class="agcr-title-line"><strong>Calendar</strong></span>
                    <div class="agcalendary-box">
                        <div class="agcalendary-box-head">
                            <div class="agcalendary-bhb1">
                                <div class="agcalendary-bhb1_L"><span class="ag_icon-bhb_up">&nbsp;</span><span class="ag_icon-bhb_down">&nbsp;</span></div>
                                <div class="agcalendary-bhb1_R">Decembrie</div>
                            </div>
                            <div class="agcalendary-bhb2">
                                <div class="agcalendary-bhb2_L">2011</div>
                                <div class="agcalendary-bhb2_R"><span class="ag_icon-bhb_up">&nbsp;</span><span class="ag_icon-bhb_down">&nbsp;</span></div>
                            </div>
                        </div>
                        <div class="cleft"></div>
                        <ul class="agcalendary-box-th">
                            <li><span>Mon.</span></li>
                            <li><span>Tue.</span></li>
                            <li><span>Wed.</span></li>
                            <li><span>Thu.</span></li>
                            <li><span>Fri.</span></li>
                            <li><span>Sat.</span></li>
                            <li><span>Sun.</span></li>
                        </ul>
                        <ul class="agcalendary-box-days">
                            <?php
                            foreach(range(1,31) as $day)
                                echo '<li><span>'.$day.'</span></li>';
                            ?>
                        </ul>
                    </div>
                </div>-->
            </div>
            <div class="cboth"></div>
            <div id="AGI_Level_3">
                <div class="agLinei" style="margin:0px 10px 20px 10px;"></div>
                <div class="agi-level_3-window">
                    <div id="AGI_Level_3_List" class="agi-level_3-list">
                        <div class="agi-level_3-item"></div>
                        <div class="agi-level_3-item"><img src="<?php echo base_url('content/other_records/familii.png');?>" width="296" height="144" alt="" title="" /></div>
                        <div class="agi-level_3-item"><img src="<?php echo base_url('content/other_records/proprietati.png');?>" width="296" height="144" alt="" title="" /></div>
                        <div class="agi-level_3-item" style="background-color:#999;"></div>
                        <div class="agi-level_3-item" style="background-color:#999;"></div>
                        <div class="agi-level_3-item" style="background-color:#999;"></div>
                        <div class="agi-level_3-item" style="background-color:#900;"></div>
                        <div class="agi-level_3-item" style="background-color:#900;"></div>
                        <div class="agi-level_3-item" style="background-color:#900;"></div>
                    </div>
                </div>
                <div style="float:right;">
                    <span id="AGB_LVL3_up" class="agBut-up" style="margin-top:-6px;">&nbsp;</span>
                    <div style="height:90px;"></div>
                    <span id="AGB_LVL3_down" class="agBut-down-active" onclick="agi_lvl3_nav('down')">&nbsp;</span>
                </div>
                <div class="cleft"></div>
            </div>
        </div>
        <div class="agif-box1"><a href="#">Pagina 1</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="#">Pagina 2</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="#">Pagina 3</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="#">Pagina 4</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="#">Pagina 5</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="#">Pagina 6</a>&nbsp;&nbsp;&nbsp;&bull;&nbsp;&nbsp;&nbsp;<a href="#">Pagina 7</a></div>
        <span class="agBut-close-1" onclick="agi_page_close()"><span class="agBut-close-1-left">&nbsp;</span><strong id="AGI_Close_But">Close It</strong><span class="agBut-close-1-right">&nbsp;</span></span>
        <br /><br /><br /><br />
	</div>
</div>