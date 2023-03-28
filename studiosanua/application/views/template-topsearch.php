<div class="search">
    <form action="<?php echo base_url('article/show/all/');?>" method="get">
        <input class="inputText" type="text" name="keyword" value="<?php echo isset($search_word)?$search_word:NULL;?>" placeholder="Search..." />
        <input class="inputSubmit" type="submit" value="" />
    </form>
</div>