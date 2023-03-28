<!DOCTYPE HTML>
<html>
    <head>{strip}
	<meta charset="utf-8" />
	<title></title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />

	{stylesheets}{scripts}

    {/strip}
   
   
    </head>
    <style>

body{
    margin-left: 365px;
    font-family: Verdana, Geneva, sans-serif;
    background-image: url(results_cats_bg.png)

}  

input[type=text], select, textarea {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

input[type=submit] {

  background-color: #45a049;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
   margin-left:258px;

}

input[type=submit]:hover {
  background-color: #04AA6D;
    
}


.main{
    background-image: url(templates/media/loghin/results_cats_bg.png);
    font-weight: 600;
    color: #ffffff;
    font-size:13px;
    border-radius: 5px;
    display: inline-block;
    width:120px;
    padding-left:30px;
    padding-right:7px;
    padding-top:7px;
    padding-bottom:7px;


}
#addData{
    background-image: url(templates/media/loghin/footer_bg.jpg);
    margin-top:100px;
    font-size:20px;
    color: #ffffff;
    border-radius: 5px;
    display: inline-block;
    padding-left:205px;
    padding-top:7px;
    padding-right:205px;
    padding-bottom:7px;

}

#discription{
   height:150px;
  

}
</style>
<center>
    <body>
	

<span id="addData"> Add Data </span>

  <form action="#" method="post" enctype='multipart/form-data' >
    <br><br>
    <label for="" class="main">Title</label>
    <br><br>
    <input type="text" id="title" name="title" placeholder="Add Title..">
    <br><br>
 <label for="" class="main">Add Url</label>
    <br><br>
  <input type="text" id="url" name="url" placeholder="Add Url..">
<br><br>

 <label for="" class="main">Image Upload</label>
    <br><br>
 <input type="file" name="image" >
 
 <br><br>
    <input type="submit" value="Submit" name="submit">
    
  </form>

    </body>
    </center>
</html>