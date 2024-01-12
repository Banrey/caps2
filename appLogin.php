
<?php include("header.php");
?>
    
</body>

<script lang="javascript">
    
    var conn = new WebSocket('ws://localhost:8080/50');
    var comment_data;
    
 $(document).ready(function () {
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

        conn.onmessage = function(e) {
        console.log(e.data);

        var data = JSON.parse(e.data);
        };

 });
</script>
</html>