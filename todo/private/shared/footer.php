	<footer>
		<!--dynamic year-->
		Design & Entwicklung von Christian Knauer<br>
		&copy; <?php echo date('Y'); ?> To-do List
	</footer>
</body>
</html>

<?php
	db_disconnect($db);
?>