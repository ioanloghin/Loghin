{include file='header.tpl'}

 {foreach $lang AS $item2}
    <h2>Add page in {$item2.language}</h2>
 
 {/foreach} 
 
    <form action="" method="post" enctype="multipart/form-data">
        
 
        <h2 style="margin:0px;font-size:12px;">Parent</h2>
       <input class="inputText" type="text" name="item1" style="width:50%;border-radius:3px; margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Title</h2>
       <input class="inputText" type="text" name="item2" style="width:50%;border-radius:3px;margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Short Title</h2>
       <input class="inputText" type="text" name="item3" style="width:50%;border-radius:3px;margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Page Title</h2>
       <input class="inputText" type="text" name="item4" style="width:50%;border-radius:3px;margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Content</h2>
        <div class="form-group">
          
          <textarea class="form-control" name="item5" cols="40" rows="10" ></textarea>
        </div>
       
      
       <input class="form-control" type="hidden" name="language_id" value="{$item2.language}" />
       
       <br>
     	<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" style="margin-bottom:10px;"/>
       <input type="hidden" name="isitem" value="1" />
    </form>


{include file='footer.tpl'}