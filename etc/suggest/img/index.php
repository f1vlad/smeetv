<? // in this script we check for new updates
session_start();
require_once($_SERVER["DOCUMENT_ROOT"].'/smeetv/func.php');

connect2db();




$qh="select * from twits where content like '%the%' and uid!='{$_SESSION['id']}' limit ".rand(1,14).",1";
$qh=mysql_query($qh);
$gh=mysql_fetch_array($qh);


echo "
<html><head><style>body {margin:0;padding:0;}html{overflow:hidden;}article {position:relative;overflow:hidden;height:110px;}img {width:100%;cursor:pointer;-moz-border-radius: 10px;-webkit-border-radius: 10px;-o-border-radius: 10px;background-color: rgb(229,229,229);}.description a{display:inline-block;position:absolute;top:.25em;left:.25em;text-decoration:none;color:rgba(255,255,255,.1);letter-spacing: -1px;line-height: 0.75em;margin: 0;text-align: left;text-decoration: none;text-transform: uppercase;font-family:Helvetica, Verdana;}article:hover .description a {color:rgba(0,0,0,.9);}article:hover img {opacity:.45;}</style></head><body>
<section>
<article onclick=\"top.window.location.href='/img/{$gh['id']}'\" id=\"{$gh['id']}\" rel=\"".$gh['link']."\">
".$gh['content']."</article>
</section>
";


?>
<script src="/js/jquery.js"></script>
<script src="/js/smeetv.js/smeetv.js"></script>

<script>
    $(document).ready(function(){
           $('section > article').each(function(){
               var content=$(this).html();
               imagify(content,'<?=$gh['id']?>');
           });
    });

</script>



</body></html>
<?
return;
?>
