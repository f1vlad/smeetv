<?
require_once('func.php');
session_start();

if(isUserLoggedIn()==1){
    header("Location:index.php");
    return;
}

require_once($_SERVER['DOCUMENT_ROOT'].'/smeetv/header.php');
drawHeader('remote control',$u,'1');



$_POST['username']=advancedClean(3,$_POST['username']);
$_POST['password']=advancedClean(3,$_POST['password']);
$_POST['process']=advancedClean(3,$_POST['process']);


/*
        connect2db();
        $query="select id from accounts where username='".$_POST['username']."'";
        $go=mysql_query($query);
        $num=mysql_num_rows($go);
*/

if($_POST['process']==1 && $_POST['username'] && $_POST['password']){
    connect2db();
    $query="select id from accounts where username='{$_POST['username']}' and password=password('{$_POST['password']}')";
    $go=mysql_query($query);
    $num=mysql_num_rows($go);
    if($num==1){
        $_SESSION['authenticated']=1;
        $_SESSION['username']=$_POST['username'];
    }
}

?>

<script src="/js/jquery.js"></script>
<?/*
<script src="/js/smeetv.js/smeetv.js"></script>
*/?>
<script type="text/javascript" src="/js/jquery.cycle.all.2.72.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
    $('#recent').cycle({
		fx: 'fadeZoom',
                timeout: 7500,
	});
<?
/*
    $('#recent > article').each(function(){
               var content=$(this).html(),
                   thisid=$(this).attr('id');
               //imagify(content,thisid);
    });
*/
?>




});
</script> 

<form id="login" method="post" action="/smeetv/auth.php">
    <input type="hidden" name="process" value="1">
    <p><label class="fleft w100" for="username">username:</label> <input type="text" name="username" value="" id="username"></p>
    <p><label class="fleft w100" for="password">password:</label> <input type="password" name="password" value="" id="password"></p>
    <p><label class="fleft w100">&nbsp;</label><input type="submit" value="Login">
</form>

<hr class="clearfix">
<h2 style="margin-left:100px;margin-top:2em;">Recent photographs:</h2>
<section id="recent" style="width:730px; margin-left:100px; clear:both display:inline-block;">
<?require_once($_SERVER['DOCUMENT_ROOT'].'/etc/util/_landing_content.txt');?>
</section>






 
<?require_once('footer.php');?>
