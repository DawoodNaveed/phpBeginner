<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="searchstyle.css">
    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {

                    document.getElementById("livesearch").innerHTML=this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
<span id="span1">Search: </span>
<a href="addBooks.php">Back</a>
<form>

    <input id="i1" type="text" size="30" onkeyup="showResult(this.value)">
    <div class="container">
        <div class="row">
    <div class="col" id="livesearch"></div>
        </div>
    </div>

</form>

</body>
</html>
