<div class="container-fluid">
	<div class="row table-row">
    
        <div class="nav-side-menu col-sm-2">
            <nav class="menu-list">
                
                <div class="brand">Brand Logo</div>
                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            
                <ul id="menu-content" class="menu-content collapse out">
                    <li data-toggle="collapse" data-target="#button-template" class="<?php echo $controller=='template'?'active':'collapsed'; ?>">
                        <div><i class="fa fa-newspaper-o fa-lg"></i> Site <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo $controller=='template'?' in':''; ?>" id="button-template">
						<li<?php echo $controller=='template'&&$page=='topmenu'?' class="active"':''; ?>><a href="<?php echo base_url('template/topmenu');?>">Top menu</a></li>
                        <li<?php echo $controller=='template'&&$page=='pageheader'?' class="active"':''; ?>><a href="<?php echo base_url('template/pageheader');?>">Header</a></li>
                        <li<?php echo $controller=='template'&&$page=='footer'?' class="active"':''; ?>><a href="<?php echo base_url('template/footer');?>">Footer</a></li>
                        <li<?php echo $controller=='template'&&$page=='password'?' class="active"':''; ?>><a href="<?php echo base_url('template/password');?>">Change password</a></li>
                        <li<?php echo $controller=='template'&&$page=='traffic'?' class="active"':''; ?>><a href="<?php echo base_url('template/traffic');?>">Traffic</a></li>
					</ul>
                    
                    <li data-toggle="collapse" data-target="#button-home" class="<?php echo $controller=='homepage'?'active':'collapsed'; ?>">
                        <div><i class="fa fa-file-powerpoint-o fa-lg"></i> Home <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo $controller=='homepage'?' in':''; ?>" id="button-home">
                    	<li<?php echo $controller=='homepage'&&$page=='layout'?' class="active"':''; ?>><a href="<?php echo base_url('homepage/layout');?>">Page layout</a></li>
                    	<li<?php echo $controller=='homepage'&&$page=='pageinfo'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/meta/home');?>">Page SEO</a></li>
                        <li<?php echo $controller=='homepage'&&$page=='gallery'?' class="active"':''; ?>><a href="<?php echo base_url('homepage/gallery');?>">Page gallery</a></li>
                        <li<?php echo $controller=='homepage'&&$page=='pagecontent'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagecontent/home');?>">Page content</a></li>
                        <li<?php echo $controller=='homepage'&&$page=='pagemenu'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagemenu/home');?>">Page lists</a></li>
                    </ul>
                    
                    <li data-toggle="collapse" data-target="#button-practice" class="<?php echo $controller=='practicepage'?'active':'collapsed'; ?>">
                        <div><i class="fa fa-file-powerpoint-o fa-lg"></i> Practice <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo $controller=='practicepage'||$controller=='practice2page'?' in':''; ?>" id="button-practice">
                    	<li<?php echo $controller=='practicepage'&&$page=='layout'?' class="active"':''; ?>><a href="<?php echo base_url('practicepage/layout');?>">Page layout</a></li>
                    	<li<?php echo $controller=='practicepage'&&$page=='pageinfo'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/meta/practice');?>">Page SEO</a></li>
                        <li<?php echo $controller=='practicepage'&&$page=='pagemenu'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagemenu/practice');?>">Left menu</a></li>
                        <li<?php echo $controller=='practice2page'&&$page=='pagecontent'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagecontent/practice2');?>">Left content</a></li>
                        <li<?php echo $controller=='practicepage'&&$page=='pagecontent'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagecontent/practice');?>">Page content</a></li>
                    </ul>
                    
                    <li data-toggle="collapse" data-target="#button-service" class="<?php echo $controller=='servicepage'?'active':'collapsed'; ?>">
                        <div><i class="fa fa-file-powerpoint-o fa-lg"></i> Service <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo $controller=='servicepage'?' in':''; ?>" id="button-service">
                    	<li<?php echo $controller=='servicepage'&&$page=='layout'?' class="active"':''; ?>><a href="<?php echo base_url('servicepage/layout');?>">Page layout</a></li>
                    	<li<?php echo $controller=='servicepage'&&$page=='pageinfo'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/meta/service');?>">Page SEO</a></li>
                        <li<?php echo $controller=='servicepage'&&$page=='pagemenu'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagemenu/service');?>">Left menu</a></li>
                        <li<?php echo $controller=='servicepage'&&$page=='pagecontent'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagecontent/service');?>">Page content</a></li>
                    </ul>
                    
                    <li data-toggle="collapse" data-target="#button-resources" class="<?php echo $controller=='resourcespage'?'active':'collapsed'; ?>">
                        <div><i class="fa fa-file-powerpoint-o fa-lg"></i> Resources <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo $controller=='resourcespage'?' in':''; ?>" id="button-resources">
                    	<li<?php echo $controller=='resourcespage'&&$page=='layout'?' class="active"':''; ?>><a href="<?php echo base_url('resourcespage/layout');?>">Page layout</a></li>
                        <li<?php echo $controller=='resourcespage'&&$page=='pageinfo'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/meta/resources');?>">Page SEO</a></li>
                        <li<?php echo $controller=='resourcespage'&&$page=='pagemenu'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagemenu/resources');?>">Left menu</a></li>
                        <li<?php echo $controller=='resourcespage'&&$page=='pagecontent'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagecontent/resources');?>">Page content</a></li>
                    </ul>
                    
                    <li data-toggle="collapse" data-target="#button-contact" class="<?php echo $controller=='contactpage'?'active':'collapsed'; ?>">
                        <div><i class="fa fa-file-powerpoint-o fa-lg"></i> Contact <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo $controller=='contactpage'?' in':''; ?>" id="button-contact">
                    	<li<?php echo $controller=='contactpage'&&$page=='pageinfo'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/meta/contact');?>">Page SEO</a></li>
                        <li<?php echo $controller=='contactpage'&&$page=='contactinfo'?' class="active"':''; ?>><a href="<?php echo base_url('contactpage/contactinfo');?>">Page content</a></li>
                    </ul>
                    
                    <li data-toggle="collapse" data-target="#button-publications" class="<?php echo ($controller=='pageinfo'&&$page=='publications')||($controller=='categoriespage'&&$page=='pagemenu')?'active':'collapsed'; ?>">
                        <div><i class="fa fa-file-powerpoint-o fa-lg"></i> Publications <span class="arrow"></span></div>
                    </li>
                    <ul class="sub-menu collapse<?php echo ($controller=='pageinfo'&&$page=='publications')||($controller=='categoriespage'&&$page=='pagemenu')?' in':''; ?>" id="button-publications">
                    	<li<?php echo $controller=='pageinfo'&&$page=='publications'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/publications/all/');?>">Articles</a></li>
                        <!--<li<?php echo $controller=='categoriespage'&&$page=='pagemenu'?' class="active"':''; ?>><a href="<?php echo base_url('pageinfo/pagemenu/categories');?>">Categories</a></li>-->
                    </ul>
                    
                    <li<?php echo $controller=='languages'?' class="active"':''; ?>><a href="<?php echo base_url('languages/index');?>"><i class="fa fa-language fa-lg"></i> Languages</a></li>
                    <li><a href="<?php echo base_url('auth/logout');?>"><i class="fa fa-bolt fa-lg"></i> Logout</a></li>
                </ul>
            </nav>
        </div>
    
        <div class="col-md-12 col-offset-menu">
        <!-- Content -->