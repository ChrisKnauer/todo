	<div class="row">
		<footer>
			<!--dynamic year-->
			Design & Entwicklung von Christian Knauer<br>
			&copy; <?php echo date('Y'); ?> To-do List
		</footer>
	</div>
</div> <!-- close bootstraps container-fluid from header -->
</body>
</html>

<?php
	db_disconnect($db);
?>