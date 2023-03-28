	<div id="sub_header">
    	<div class="first"><?php 
    
    if (isset($isview) ) { ?>
        	<ul>
            	<li><a href="#">Furnizori</a></li>
               <!-- <li class="selected"><span>Prestari Servicii</span></li> -->
               <li class="selected"><span>Menu <?php echo $info['lvl'] + 1 ;?></span></li>
                <li><a href="#">Materii Prime/Materiale</a></li>
                <li><a href="#">Normalizate/Standard</a></li>
                <li><a href="#">Dotari Tehnice</a></li>
                <li><a href="#">Scule</a></li>
                <li><a href="#">Aparate</a></li>
                <li><a href="#">Instrumente</a></li>
                <li><a href="#">Forums</a></li>
            </ul>
            
            <?php } 
            
            else { ?>
                 <style>#sub_header {display: none; padding-bottom:15px;
                 }</style>
                
           <?php }
            
            ?>
        </div>
        <div class="second visible customli">
       <ul>     
       
       <style>
           
          .customli li a{ width: 90px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
          }
       </style>
    <?php 
    
    if (isset($isview) ) { ?>
    
    <li class="has"><a href="#">Menu <?php echo $info['lvl'] + 1 ;?></a>
                	<ul>
                        <li><a href="#">Menu</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a><span class="icon">&nbsp;</span>
                                <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                                </li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has selected">
                	<a href="#">Menu <?php echo $info['lvl'] + 1 ;?></a>
                    <ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has"><a href="#">Normalizate</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has"><a href="#">Elemente Standard</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has"><a href="#">Masini Unelte</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li> 
    
    <?php
        
   
    
    /*
    $results = MYSQL_QUERY("SELECT max(a.lvl) FROM `struct_blocks` a WHERE a.`project` = '".$projectID."'");
    
    $lvl = mysql_fetch_row($results);
    
    $lvl[0] = $deep;
    
    $results = MYSQL_QUERY("SELECT a.`id`, a.`sup`, a.`lvl`, a.`type`, a.`code`, b.it FROM `struct_blocks` a JOIN struct_blocks_lang b  ON a.id = b.block_id WHERE a.`project` = '".$projectID."' order by a.id asc");
    
    //$data = mysql_fetch_array($results);
    
    
    $data = array();
    while ($row = mysql_fetch_array($results)) {
        
      $data[$row['lvl']][$row['sup']][] = $row;
      
      
    }
    
    
    //print_r($data);
    
    //for($i = 0; $i <= 0 ; $i++)
    //{
    $url = "http://structures.loghin.com/struct/view/";
        foreach($data[0] as $key=>$val)
        {
            foreach($val as $key1=>$val1)
            {
              echo '<li class="has" title="'.$val1['it'].'"><a href="'.$url.$val1['code'].'">'.$val1['it'].'</a>';
              
              if ( $lvl[0] >= 1)
              {
                   echo '<ul>';
                   foreach($data[1][$val1['id']] as $key2=>$val2)
                   {
                     
                      if ( $lvl[0] == 1)
                      {
                        echo '<li><a href="'.$url.$val2['code'].'" title="'.$val2['it'].'">'.$val2['it'].'</a></li>';
                      }
                      else
                      {
                        echo '<li><a href="'.$url.$val2['code'].'" title="'.$val2['it'].'">'.$val2['it'].'</a><span class="icon">&nbsp;</span>';  
                        
                         if ( $lvl[0] >= 2)
                          {
                               echo '<ul>';
                               foreach($data[2][$val2['id']] as $key3=>$val3)
                               {
                                 
                                  if ( $lvl[0] == 2 )
                                  {
                                    echo '<li><a href="'.$url.$val3['code'].'" title="'.$val3['it'].'">'.$val3['it'].'</a></li>';
                                  }
                                  else
                                  {
                                    echo '<li><a href="'.$url.$val3['code'].'" title="'.$val3['it'].'">'.$val3['it'].'</a><span class="icon">&nbsp;</span>';  
                                    
                                     if ( $lvl[0] >= 3)
                                      {
                                           echo '<ul>';
                                           foreach($data[3][$val3['id']] as $key4=>$val4)
                                           {
                                             
                                              if ( $lvl[0] == 3)
                                              {
                                                echo '<li><a href="'.$url.$val4['code'].'" title="'.$val4['it'].'">'.$val4['it'].'</a></li>';
                                              }
                                              else
                                              {
                                                echo '<li><a href="'.$url.$val4['code'].'" title="'.$val4['it'].'">'.$val4['it'].'</a><span class="icon">&nbsp;</span>';  
                                                
                                                if ( $lvl[0] >= 4)
                                                      {
                                                           echo '<ul>';
                                                           foreach($data[4][$val4['id']] as $key5=>$val5)
                                                           {
                                                             
                                                              if ( $lvl[0] == 4 || !isset($data[5][$val5['id']]))
                                                              {
                                                                echo '<li><a href="'.$url.$val5['code'].'" title="'.$val5['it'].'">'.$val5['it'].'</a></li>';
                                                              }
                                                              else
                                                              {
                                                                echo '<li><a href="'.$url.$val5['code'].'" title="'.$val5['it'].'">'.$val5['it'].'</a><span class="icon">&nbsp;</span>';  
                                                                
                                                               
                                                                if ( $lvl[0] >= 5)
                                                                  {
                                                                       echo '<ul>';
                                                                       foreach($data[5][$val5['id']] as $key6=>$val6)
                                                                       {
                                                                         
                                                                          if ( $lvl[0] == 5 || !isset($data[6][$val6['id']]))
                                                                          {
                                                                            echo '<li><a href="'.$url.$val6['code'].'" title="'.$val6['it'].'">'.$val6['it'].'</a></li>';
                                                                          }
                                                                          else
                                                                          {
                                                                            echo '<li><a href="'.$url.$val6['code'].'" title="'.$val6['it'].'">'.$val6['it'].'</a><span class="icon">&nbsp;</span>';  
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                             if ( $lvl[0] >= 6)
                                                                  {
                                                                       echo '<ul>';
                                                                       foreach($data[6][$va6['id']] as $key7=>$val7)
                                                                       {
                                                                         
                                                                          if ( $lvl[0] == 6)
                                                                          {
                                                                            echo '<li><a href="'.$url.$val7['code'].'" title="'.$val7['it'].'">'.$val7['it'].'</a></li>';
                                                                          }
                                                                          else
                                                                          {
                                                                            echo '<li><a href="'.$url.$val7['code'].'" title="'.$val7['it'].'">'.$val7['it'].'</a><span class="icon">&nbsp;</span>';  
                                                                            
                                                                            echo '</li>';
                                                                          }    
                                                                          
                                                                       }
                                                                       echo '</ul>';
                                                                  }
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            echo '</li>';
                                                                          }    
                                                                          
                                                                       }
                                                                       echo '</ul>';
                                                                  }
                                                                echo '</li>';
                                                              }    
                                                              
                                                           }
                                                           echo '</ul>';
                                                      }
                                                
                                                echo '</li>';
                                              }    
                                              
                                           }
                                           echo '</ul>';
                                      }
                                    
                                    echo '</li>';
                                  }    
                                  
                               }
                               echo '</ul>';
                          }
                        
                        
                        echo '</li>';
                      }    
                      
                   }
                   echo '</ul>';
              }
              
              echo '</li>';
            }
        }
    //} 
    
    */
    
    
    
    
    } 
    else {
    ?>
            
            <!--
            
        	
            	<li class="has"><a href="#">Materii Prime</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a><span class="icon">&nbsp;</span>
                                <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                                </li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has selected">
                	<a href="#">Materiale</a>
                    <ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has"><a href="#">Normalizate</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has"><a href="#">Elemente Standard</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li>
                <li class="has"><a href="#">Masini Unelte</a>
                	<ul>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a><span class="icon">&nbsp;</span>
                            <ul>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                                <li><a href="#">Lorem Ipsum 2</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Lorem Ipsum</a></li>
                    </ul>
                </li> -->
                
                <?php } ?>
            </ul>
        </div>
    </div>