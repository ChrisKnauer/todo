	<footer>
		<!--dynamic year-->
		&copy; <?php echo date('Y'); ?> To-do List
	</footer>
</body>
</html>

<?php
	db_disconnect($db);
?>