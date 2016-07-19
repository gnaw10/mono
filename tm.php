<html>
<head>

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>
setInterval(function() {
    $("#content").load(location.href+" #content>*","");
}, 5000);
</script>

</head>
<body>

<p id="content">
<del>laji</del>
<div><del><?php $tm=time();echo $tm;?></del></div>
<del><?php $tm=time();echo $tm;?></del>
</p>


</body>
</html>

