<div id="Content">
    <div id="AG_Page" class="tree_create">
        <div class="leftColumn clear rad5-top clear" style="background-color:#E7DCCA;">
            <div class="left clear" id="AG_PageLeftBox"><?php include('views/tree/left_column.php');?></div>
            <div id="AG_PageRightBox" class="right rad5-top-right clear" style="overflow:hidden;">
            <br />
            <div id="AGcontent" style="width:760px; padding-bottom:20px; margin-left:6px;">
                <h2 class="redMesagge">Sec&#355;iune neterminat&#259;!<img style="position:absolute; margin-top:-8px;" src="http://th242.photobucket.com/albums/ff258/truckthis/emoticons/th_JackHammerSmilie.gif" width="41" height="37" alt="" /></h2>
                <div style="float:left; width:440px;">
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <?php
                        $medias_limit = 4;
                        $db_photos = SQL_DB::sql_select(DBT_MED_PHO, "`".DBT_MED_PHO_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_PHO_C11."` DESC", 0, 0,
                                                     array(DBT_MED_PHO_C1, DBT_MED_PHO_C5, DBT_MED_PHO_C6, DBT_MED_PHO_C11));
                        $db_stories = SQL_DB::sql_select(DBT_MED_STO, "`".DBT_MED_STO_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_STO_C9."` DESC", 0, 0,
                                                     array(DBT_MED_STO_C1, DBT_MED_STO_C4, DBT_MED_STO_C9));
                        $db_audios = SQL_DB::sql_select(DBT_MED_AUD, "`".DBT_MED_AUD_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_AUD_C5."` DESC", 0, 0,
                                                     array(DBT_MED_AUD_C1, DBT_MED_AUD_C4, DBT_MED_AUD_C5, DBT_MED_AUD_C6));
                        $db_videos = SQL_DB::sql_select(DBT_MED_VID, "`".DBT_MED_VID_C2."` = $AGmyIDUser", "ORDER BY `".DBT_MED_VID_C4."` DESC", 0, 0,
                                                     array(DBT_MED_VID_C1, DBT_MED_VID_C3, DBT_MED_VID_C4));
                        $photos  = count($db_photos);
                        $stories = count($db_stories);
                        $audios  = count($db_audios);
                        $videos  = count($db_videos);
                        $medias = $photos + $stories + $audios + $videos;
                        ?>
                        <div class="fp-desc-box-top"><span>Galerie media<?php echo ($medias > $medias_limit) ? ' ( <a class="linkWhite" href="'.ROOT.get_link('tree_media', $AGmyIDTree, $AGmyIDUser).'">Vezi mai multe</a> )' : NULL;?></span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content" style="padding-top:0px;">
                            <?php
                            if($medias)
                            {
                                $db_list     = array();
                                $datainserts = array();
                                foreach($db_photos as $key => $value)
                                {
                                    $db_list['photo_'.$key] = $value;
                                    $datainserts['photo_'.$key] = strtotime($value[DBT_MED_PHO_C11]);
                                    if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                                }
                                foreach($db_stories as $key => $value)
                                {
                                    $db_list['story_'.$key] = $value;
                                    $datainserts['story_'.$key] = strtotime($value[DBT_MED_STO_C9]);
                                    if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                                }
                                foreach($db_audios as $key => $value)
                                {
                                    $db_list['audio_'.$key] = $value;
                                    $datainserts['audio_'.$key] = strtotime($value[DBT_MED_AUD_C5]);
                                    if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                                }
                                foreach($db_videos as $key => $value)
                                {
                                    $db_list['video_'.$key] = $value;
                                    $datainserts['video_'.$key] = strtotime($value[DBT_MED_VID_C4]);
                                    if($key==$medias_limit) break;// oprim executia daca s-a introdus deja numarul maxim de inregistrari in array
                                }
                                unset($db_photos, $db_stories, $db_audios, $db_videos);
                                asort($datainserts, SORT_NUMERIC);
                                $n=1;
                                $media_list = array();
                                foreach($datainserts as $key => $value)
                                {
                                    $exp = explode('_', $key);
                                    $db_list[$key]['link_section'] = $exp[0];
                                    $media_list[] = $db_list[$key];
                                    
                                    if($n==$medias_limit) break;
                                    else $n++;
                                }
                                unset($datainserts);
                                
                                echo '<div class="mediaCells"><ul class="MediaList">';
                                foreach($media_list as $row)
                                {
                                    switch($row['link_section'])
                                    {
                                        default:
                                            $thisID = 0;
                                            $thisTitle = NULL;
                                            $imgPatch  = NULL;
                                            $imgWidth  = 0;
                                            $imgHeight = 0;
                                            break;
                                        case'photo':
                                            $thisID    = $row[DBT_MED_PHO_C1];
                                            $thisTitle = $row[DBT_MED_PHO_C6];
                                            $imgClass  = '';
                                            $imgPatch  = ROOT.'content/media/photos/thumbs/'.$row[DBT_MED_PHO_C5];
                                            $imgWidth  = 59;
                                            $imgHeight = 55;
                                            break;
                                        case'story':
                                            $thisID    = $row[DBT_MED_STO_C1];
                                            $thisTitle = $row[DBT_MED_STO_C4];
                                            $imgClass = 'iconFix';
                                            $imgPatch = ROOT.'design/imagini/layout2/gallery-story.gif';
                                            $imgWidth  = 27;
                                            $imgHeight = 32;
                                            break;
                                        case'audio':
                                            $thisID    = $row[DBT_MED_AUD_C1];
                                            $thisTitle = $row[DBT_MED_AUD_C6];
                                            $imgClass = 'iconFix';
                                            $imgPatch  = ROOT.'design/imagini/layout2/gallery-audio.gif';
                                            $imgWidth  = 17;
                                            $imgHeight = 32;
                                            break;
                                        case'video':
                                            $thisID    = $row[DBT_MED_VID_C1];
                                            $thisTitle = $row[DBT_MED_VID_C6];
                                            $imgClass = 'iconFix';
                                            $imgPatch  = ROOT.'design/imagini/layout2/gallery-video.gif';
                                            $imgWidth  = 31;
                                            $imgHeight = 32;
                                            break;
                                    }
                                    
                                    echo '<li>';
                                    echo '<div class="mediaCell"><a style="display:block;" href="'.ROOT.get_link('tree_media_'.$row['link_section'], $AGmyIDTree, $AGmyIDUser, $thisID).'"><img class="'.$imgClass.'" src="'.$imgPatch.'" width="'.$imgWidth.'" height="'.$imgHeight.'" alt="" /></a></div>';
                                    echo '<div class="mediaCellTitle">'.substr($thisTitle, 0, 10).((strlen($thisTitle) > 10) ? '&hellip;' : '').'</div>';
                                    echo '</li>';
                                }
                                echo '</ul>
                                <div class="cleft"></div>
                                </div>
                                <div class="mediaOptions"><ul>';
                                
                                // Media photos
                                echo '<li>';
                                $str = ($photos) ? '<a class="linkGreen" href="'.ROOT.get_link('tree_media_photos', $AGmyIDTree, $AGmyIDUser).'"><span class="media_icon photo_green">&nbsp;</span> %s</a>' : '<span class="spanGrey"><span class="media_icon photo_grey">&nbsp;</span> %s</span>';
                                printf($str, 'Imagini ('.$photos.')');
                                echo '</li>';
                                
                                // Media stories
                                echo '<li>';
                                $str = ($stories) ? '<a class="linkGreen" href="'.ROOT.get_link('tree_media_stories', $AGmyIDTree, $AGmyIDUser).'"><span class="media_icon story_green">&nbsp;</span> %s</a>' : '<span class="spanGrey"><span class="media_icon story_grey">&nbsp;</span> %s</span>';
                                printf($str, 'Povestiri ('.$stories.')');
                                echo '</li>';
                                
                                // Media audios
                                echo '<li>';
                                $str = ($audios) ? '<a class="linkGreen" href="'.ROOT.get_link('tree_media_audios', $AGmyIDTree, $AGmyIDUser).'"><span class="media_icon audio_green">&nbsp;</span> %s</a>' : '<span class="spanGrey"><span class="media_icon audio_grey">&nbsp;</span> %s</span>';
                                printf($str, 'Audio ('.$audios.')');
                                echo '</li>';
                                
                                // Media videos
                                echo '<li>';
                                $str = ($videos) ? '<a class="linkGreen" href="'.ROOT.get_link('tree_media_videos', $AGmyIDTree, $AGmyIDUser).'"><span class="media_icon video_green">&nbsp;</span> %s</a>' : '<span class="spanGrey"><span class="media_icon video_grey">&nbsp;</span> %s</span>';
                                printf($str, 'Video ('.$videos.')');
                                echo '</li>';
    
                                echo '</ul></div>';
                                echo '<div class="cleft"></div>';
                            }
                            else
                                echo '<p style="font-style:italic; padding:10px 0 10px 10px; text-align:center;">Nu exist&#259; continut media adaugat.</p>';
                            ?>
                            <hr style="margin-top:0px;" />
                            <a class="ancBtn" href="<?php echo ROOT.get_link('tree_media_video_add', $AGmyIDTree, $AGmyIDUser);?>" style="margin-right:10px; float:right;"><span class="rec">&nbsp;</span>Video</a>
                            <a class="ancBtn" href="<?php echo ROOT.get_link('tree_media_audio_add', $AGmyIDTree, $AGmyIDUser);?>" style="margin-right:10px; float:right;"><span class="rec">&nbsp;</span>Audio</a>
                            <a class="ancBtn" href="<?php echo ROOT.get_link('tree_media_story_add', $AGmyIDTree, $AGmyIDUser);?>" style="margin-right:10px; float:right;"><span class="plus">&nbsp;</span>Povestire</a>
                            <a class="ancBtn" href="<?php echo ROOT.get_link('tree_media_photo_add', $AGmyIDTree, $AGmyIDUser);?>" style="margin-right:10px; float:right;"><span class="plus">&nbsp;</span>Imagine</a>
                            <div class="cboth"></div>
                        </div>
                    </div>
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Cronologie<?php echo ' ( <a class="linkWhite" href="'.ROOT.get_link('tree_facts', $AGmyIDTree, $AGmyIDUser).'">Vezi detaliat</a> )';?></span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            <ul class="timeline_list">
                                <li>
                                    <div class="post_date">
                                        <span class="post-month">Aug 2012</span>
                                        <span class="post-day">20</span>
                                    </div>
                                    <div class="right_side">
                                        <h3><a href="#">Birth</a></h3>
                                        <p><a href="#">Oregon City, Clackamas, Oregon, USA</a></p>
                                        <p>Intr-o zi de primavara</p>
                                    </div>
                                    <div class="cboth"></div>
                                    <hr />
                                </li>
                                <li>
                                    <div class="post_date">
                                        <span class="post-month">Aug 2012</span>
                                        <span class="post-day">20</span>
                                    </div>
                                    <div class="right_side">
                                        <h3><a href="#">Birth</a></h3>
                                        <p><a href="#">Oregon City, Clackamas, Oregon, USA</a></p>
                                        <p>Intr-o zi de primavara</p>
                                    </div>
                                    <div class="cboth"></div>
                                    <hr />
                                </li>
                            </ul>
                            <a class="ancBtn" href="<?php echo ROOT.get_link('tree_facts_add', $AGmyIDTree, $AGmyIDUser);?>" style="margin-left:10px;"><span class="plus">&nbsp;</span>Adaug&#259; un fapt</a>
                            <div class="cleft"></div>
                        </div>
                    </div>
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Comentarii</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            <?php
                            $comms = SQL_DB::sql_count(DBT_COMM, "`".DBT_COMM_C3."` = $AGmyIDUser", DBT_COMM_C2);
                            if($comms)
                            {
                                $result = SQL_DB::sql_querry("SELECT comments.*, users.`".DBT_USER_C2."`, users_info.`".DBT_USER_INFO_C2."`, users_info.`".DBT_USER_INFO_C3."`, users_info.`".DBT_USER_INFO_C5."`
                                                              FROM `".DBT_COMM."` AS comments
                                                              LEFT JOIN `".DBT_USER."` AS users
                                                                  ON comments.`".DBT_COMM_C2."` = users.`".DBT_USER_INFO_C1."`
                                                              LEFT JOIN `".DBT_USER_INFO."` AS users_info
                                                                  ON users.`".DBT_USER_INFO_C1."` = users_info.`".DBT_USER_INFO_C1."`
                                                              WHERE 
                                                                  comments.`".DBT_COMM_C3."` = $AGmyIDUser
                                                              ORDER BY `".DBT_COMM_C6."` DESC
                                                              LIMIT 0,5");
                                echo '<ul style="margin-bottom:10px;">';
                                while($row=mysql_fetch_array($result, MYSQL_ASSOC))
                                {
                                    $date = new DateTime($row['DataInsert']);
                                    echo '<li class="section_comment">';
                                    echo '<a class="title" href="#">'.$row[DBT_COMM_C4].'</a>';
                                    echo '<div class="details"><a href="#" class="uLink"><img src="'.ROOT.$row[DBT_USER_INFO_C5].'" width="15" height="20" alt="" /><span>'.(($row[DBT_USER_INFO_C2] || $row[DBT_USER_INFO_C3]) ? $row[DBT_USER_INFO_C2].' '.$row[DBT_USER_INFO_C3] : $row[DBT_USER_C2]).'</span></a> ad&#259;ugat pe '.$date->format('d M Y').'</div>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                            else
                                echo '<p style="font-style:italic; padding-left:10px; padding-top:5px; text-align:center;">Nu sunt comentarii adaugate.</p><hr />';
                            ?>
                            <a class="ancBtn" href="#" style="margin-left:10px;">Adaug&#259; comentariu</a>
                            <a class="ancBtn" href="#" style="margin-right:10px; float:right;">Vezi toate comentariile (<?php echo $comms;?>)</a>
                            <div class="cboth"></div>
                        </div>
                    </div>
                </div>
                
                <div style="float:right; width:310px;">
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Membri familie</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            <strong class="h4">P&#259;rin&#355;i / Fra&#355;i &#351;i surori</strong>
                            <ul class="itemProfilGrup">
                                <?php
                                $temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C8."` LIKE '%-$AGmyIDUser-%'", NULL, 0, 1);
                                $id_copii = (isset($temp[1][DBT_FAM_C8])) ? $temp[1][DBT_FAM_C8] : NULL;
                                $temp_row = $temp[1];
                                echo AG_Operation::item_profil_3($temp_row[DBT_FAM_C6]);
                                echo AG_Operation::item_profil_3($temp_row[DBT_FAM_C7], 'last');
                                unset($temp);
                            ?>
                            </ul>
                            <ul class="itemProfilSubGrup">
                            <?php
                                // copii
                                if($id_copii != NULL && $id_copii != "-$AGmyIDUser-")
                                {
                                    $exp = explode(',', $id_copii);
                                    // eliminam userul selectat si convertim id-ul in integer
                                    foreach($exp as $key => $id)
                                    {
                                        $exp[$key] = intval(str_replace('-', '', $id));
                                        if($exp[$key] == $AGmyIDUser)
                                            unset($exp[$key]);
                                    }
                                    $cnt = count($exp);
                                    $n=0;
                                    foreach($exp as $id_copil)
                                    {
                                        echo AG_Operation::item_profil_3($id_copil, (($cnt == ++$n) ? true : false));
                                    }
                                }
                                else
                                    echo '<li><span style="color:#999; display:block; padding:5px 0 5px 20px;">Nu are frati sau surori inregistrate.</span></li>';
                                ?>
                            </ul>
                            <hr />
                            <strong class="h4">Partener(&#259;) / Copii</strong>
                            <ul class="itemProfilGrup">
                                <?php
                                $temp = SQL_DB::sql_select(DBT_FAM, "`".DBT_FAM_C6."` = '$AGmyIDUser' OR `".DBT_FAM_C7."` = '$AGmyIDUser'", NULL, 0, 1);
                                if(isset($temp[1][DBT_FAM_C6]) && isset($temp[1][DBT_FAM_C7]))
                                {
                                    if($temp[1][DBT_FAM_C6] == $AGmyIDUser)
                                        echo AG_Operation::item_profil_3($temp[1][DBT_FAM_C7], true);
                                    else
                                        echo AG_Operation::item_profil_3($temp[1][DBT_FAM_C6], true);
                                }
                                else
                                    echo '<li><span style="color:#999; display:block; padding:5px 0 5px 20px;">Nu are partener(&#259;).</span></li>';
                                ?>
                            </ul>
                            <ul class="itemProfilSubGrup">
                            <?php
                                $id_copii = (isset($temp[1][DBT_FAM_C8])) ? $temp[1][DBT_FAM_C8] : NULL;
                                if($id_copii != NULL)
                                {
                                    $exp = explode(',', $id_copii);
                                    $cnt = count($exp);
                                    $n=0;
                                    foreach($exp as $id_copil)
                                    {
                                        $id_copil = (int) str_replace('-', '', $id_copil);
                                        if($id_copil != $AGmyIDUser) echo item_profil_3($id_copil, (($cnt == ++$n) ? true : false));
                                    }
                                }
                                else
                                    echo '<li><span style="color:#999; display:block; padding:5px 0 5px 20px;">Nu are copii inregistrati.</span></li>';
                                unset($temp);
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Source Information</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            No source citations have been added yet.<hr /><a class="ancBtn" href="#" style="margin-left:10px;">Cautare</a><div class="cleft"></div>
                            <div class="itemSpace"></div>
                        </div>
                    </div>
                    <div class="fp-desc-box" style="margin-top:10px;">
                        <div class="fp-desc-box-top"><span>Web Links</span></div>
                        <div class="cleft"></div>
                        <div class="fp-desc-box-content">
                            No web links have been added yet.<hr /><a class="ancBtn add" href="#" style="margin-left:10px;">Adauga link</a><div class="cleft"></div>
                            <div class="itemSpace"></div>
                        </div>
                    </div>
                </div>
                <div class="cboth"></div>
            </div>
            </div>
        </div>
    </div>
</div>