<!-- left coumn-->
<div class="left clear" id="AG_PageLeftBox">
	<div class="h10"></div>
    <div class="info_fix">
        <span class="title"><?php echo $info['project'] == 2 ?  'ISTAT ' : 'CAEN ' ; echo $code;?></span>
        <span class="other"><?php echo $info['label'];?>&nbsp;</span>
    </div>
    <div class="h10"></div>
    <div class="image_mask rad5">
		<div class="bwhite rad5"><img src="<?php echo base_url('content/struct/medium/A.jpg');?>" width="146" alt="" /></div>
    </div>
    <!-- Button: change profile -->
    <div class="change_profile rad5-bottom"><a href="#">-</a></div>
    <div class="h10"></div>
    <li class="button back"><a href="#" onclick="goBack()">Back</a></li>
    
    <script>
function goBack() {
  window.history.back();
}
</script>
    <style>
@import url("https://fonts.googleapis.com/css2?family=Ubuntu&display=swap");

ul, #myUL {
  list-style-type: none;
}
#myUL {
  margin: 0;
  padding-left: 0px;
  display:none;
}
.m-ul li{
    padding-left:10px;
    position: relative;
    display: block;
    /*border-bottom: 1px solid #e1e1e1;*/
    display: block;
    background: #f7f7f7;
    line-height: 26px;
    border-top: 1px solid #FFF;
    color: #000;
}
.m-ul li a{
    padding-left: 10px;
    color:#000;
}
#myUL li .caret{
    display: block;
    height: 28px;
    line-height: 28px;
    color: #FFF;
    letter-spacing: 1px;
    border: 1px solid #4c4e5a;
    background: linear-gradient(to bottom, #7a7d90 0%,#4c4e5a 100%);
    border-top-color: #A4A9C5;
    border: 1px solid #4c4e5a;
    border-radius: 3px;
    -moz-border-radius: 3px;
    padding: 0 10px;
    overflow: hidden;
}
#myUL li ul li .caret{
    background-color: #fff0;
    background: linear-gradient(to bottom, #ffffff00 0%,#ffffff00 100%);
    color: #000 !important;
    border-top-color: #ffffff00;
    border: 1px solid #ffffff00;
}
#myUL li ul li .caret a{
    color: #000 !important;
}
#myUL li ul li .caret::before{
    color:#000;
}
.caret-down{
    background: linear-gradient(to bottom, #5d606f 0%,#1b1c21 100%) !important;
}
#myUL li ul li .caret-down{
    background: linear-gradient(to bottom, #edeff2 0%,#c1cad1 100%) !important;
}
.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
    content: "+";
    color: white;
    display: inline-block;
    /* margin-right: 6px; */
    float: right;
    font-size: 16px;
    font-weight: 600;
}

.caret-down::before {
  content: "\2212";
/*  -ms-transform: rotate(90deg); /* IE 9 */
/*  -webkit-transform: rotate(90deg); /* Safari */'
/*  transform: rotate(90deg);  */
}

.nested {
  display: none;
}

.active {
  display: block;
}
.ic{
    float: left;
    width: 16px;
    height: 16px;
    background-position: -120px -1px;
    margin: 6px 6px 0 6px;
}
#myUL li .caret a{
    color:#fff;
}
#myUL li, #myUL ul{
    margin-bottom:5px;
}
</style>
<ul id="myUL">
    
  <?php 
  
  $projectID =   $info['project'];
  $results = MYSQL_QUERY("SELECT max(a.lvl) FROM `struct_blocks` a WHERE a.`project` = '".$projectID."'");
    
    $lvl = mysql_fetch_row($results);
    
    //echo $lvl[0];
    
    $results = MYSQL_QUERY("SELECT a.`id`, a.`sup`, a.`lvl`, a.`type`, a.`code`, b.it FROM `struct_blocks` a JOIN struct_blocks_lang b  ON a.id = b.block_id WHERE a.`project` = '".$projectID."11' order by a.id asc");
    
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
              echo '<li><span title="'.$val1['it'].'" class="caret"><a href="'.$url.$val1['code'].'">'.$val1['it'].'</a></span>';
              
              if ( $lvl[0] >= 1)
              {
                   echo '<ul class="nested  m-ul">';
                   foreach($data[1][$val1['id']] as $key2=>$val2)
                   {
                     
                      if ( $lvl[0] == 1)
                      {
                        echo '<li><a href="'.$url.$val2['code'].'" title="'.$val2['it'].'">'.$val2['it'].'</a></li>';
                      }
                      else
                      {
                        echo '<li><span class="caret"><span class="icon ic">&nbsp;</span><a href="'.$url.$val2['code'].'" title="'.$val2['it'].'">'.$val2['it'].'</a></span>';  
                        
                         if ( $lvl[0] >= 2)
                          {
                               echo '<ul class="nested">';
                               foreach($data[2][$val2['id']] as $key3=>$val3)
                               {
                                 
                                  if ( $lvl[0] == 2 )
                                  {
                                    echo '<li><a href="'.$url.$val3['code'].'" title="'.$val3['it'].'">'.$val3['it'].'</a></li>';
                                  }
                                  else
                                  {
                                    echo '<li><span class="caret"><span class="icon ic">&nbsp;</span><a href="'.$url.$val3['code'].'" title="'.$val3['it'].'">'.$val3['it'].'</a></span>';  
                                    
                                     if ( $lvl[0] >= 3)
                                      {
                                           echo '<ul class="nested">';
                                           foreach($data[3][$val3['id']] as $key4=>$val4)
                                           {
                                             
                                              if ( $lvl[0] == 3)
                                              {
                                                echo '<li><a href="'.$url.$val4['code'].'" title="'.$val4['it'].'">'.$val4['it'].'</a></li>';
                                              }
                                              else
                                              {
                                                echo '<li><span class="caret"><span class="icon ic">&nbsp;</span><a href="'.$url.$val4['code'].'" title="'.$val4['it'].'">'.$val4['it'].'</a></span>';  
                                                
                                                if ( $lvl[0] >= 4)
                                                      {
                                                           echo '<ul class="nested">';
                                                           foreach($data[4][$val4['id']] as $key5=>$val5)
                                                           {
                                                             
                                                              if ( $lvl[0] == 4 || !isset($data[5][$val5['id']]))
                                                              {
                                                                echo '<li><a href="'.$url.$val5['code'].'" title="'.$val5['it'].'">'.$val5['it'].'</a></li>';
                                                              }
                                                              else
                                                              {
                                                                echo '<li><span class="caret"><span class="icon ic">&nbsp;</span><a href="'.$url.$val5['code'].'" title="'.$val5['it'].'">'.$val5['it'].'</a></span>';  
                                                                
                                                               
                                                                if ( $lvl[0] >= 5)
                                                                  {
                                                                       echo '<ul class="nested">';
                                                                       foreach($data[5][$val5['id']] as $key6=>$val6)
                                                                       {
                                                                         
                                                                          if ( $lvl[0] == 5 || !isset($data[6][$val6['id']]))
                                                                          {
                                                                            echo '<li><a href="'.$url.$val6['code'].'" title="'.$val6['it'].'">'.$val6['it'].'</a></li>';
                                                                          }
                                                                          else
                                                                          {
                                                                            echo '<li><span class="caret"><span class="icon ic">&nbsp;</span><a href="'.$url.$val6['code'].'" title="'.$val6['it'].'">'.$val6['it'].'</a></span>';  
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
                                                                             if ( $lvl[0] >= 6)
                                                                  {
                                                                       echo '<ul class="nested">';
                                                                       foreach($data[6][$va6['id']] as $key7=>$val7)
                                                                       {
                                                                         
                                                                          if ( $lvl[0] == 6)
                                                                          {
                                                                            echo '<li><a href="'.$url.$val7['code'].'" title="'.$val7['it'].'">'.$val7['it'].'</a></li>';
                                                                          }
                                                                          else
                                                                          {
                                                                            echo '<li><span class="caret"><span class="icon ic">&nbsp;</span><a href="'.$url.$val7['code'].'" title="'.$val7['it'].'">'.$val7['it'].'</a></span>';  
                                                                            
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
    
    ?>
    </ul>
    
    
    <ul class="v-nav">
        <li><div class="border"><a href="#">menu <?php echo $info['lvl'] + 1 ;?></a><span class="icon">&nbsp;</span></div>
            <ul>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            </ul>
        </li>
        <li><div class="border"><a href="#">menu <?php echo $info['lvl'] + 1 ;?></a><span class="icon">&nbsp;</span></div>
            <ul>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            </ul>
        </li>
        <li><div class="border"><a href="#">menu <?php echo $info['lvl'] + 1 ;?></a><span class="icon">&nbsp;</span></div>
            <ul>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="line">&nbsp;</li>
        <li class="grey"><div class="border"><a href="#">Category</a><span class="icon">&nbsp;</span></div>
            <ul>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            </ul>
        </li>
        
        
        <li class="grey"><div class="border"><a href="#">Category2</a><span class="icon">&nbsp;</span></div>
            <ul>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a><span class="icon">&nbsp;</span>
                    <ul>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                        <li><a href="#">Category</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
                <li><a href="#"><span class="icon">&nbsp;</span>Category</a></li>
            </ul>
        </li>
    </ul>
    <div class="v-box" style="margin-top:30px;">
        <h2 class="header rad5-top"><a class="tcenter" href="#more-services">More Services</a></h2>
        <div class="content">
            Dublu click pe "More Services" pentru a accesa continutul.
        </div>
        <div class="more-services hide">
            <a class="close icon" href="#close"> </a>
            More service content 
        </div>
    </div>
    <div class="v-box">
        <h2 class="header rad5-top"><a class="tcenter" href="#more-services">Flash-Info</a></h2>
        <div class="content">
            Info Flash Romania
        </div>
        <div class="more-services hide">
            <a class="close icon" href="#close"> </a>
            More service content 
        </div>
    </div>
</div><!-- end left coumn-->

<script>
var toggler = document.getElementsByClassName("caret");
var i;
for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
</script>