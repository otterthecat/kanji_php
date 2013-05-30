<?php include ('includes/header.php'); ?>
<!-- end header include -->

<!-- start body/content -->
	<body>
		<header>
			<hgroup>
				<h1><?php echo $title; ?></h1>
				<?php if (isset($db_data)):?>
					<?php foreach($db_data as $row): ?>

						<h2>
							<?php echo  $row['title'] ?>
						</h2>
						<p>
							<?php  echo $row['content'] ?>
						</p>

					<?php endforeach;?>
				<?php endif;?>
			</hgroup>
			<nav>
				<ul>
					<li><a href="">Menu Item 1</a></li>
					<li><a href="">Menu Item 2</a></li>		<footer>
		</footer>
                    <li><a href="">Menu Item 3</a></li>
				</ul>
			</nav>
		</header>

		<?php if (isset($newTitle)):?>
		<h3><?php echo $newTitle; ?></h3>
		<p><?php echo $newContent;?></p>
		<?php else: ?>
		<section>
            <h3>Content Title</h3>
			<p>
                This is default filler content.
            </p>
		</section>
		<?php endif ?>



		<?php if (isset($rss)): ?>

			<?php echo $rss[0];  ?>

		<?php endif ?>

<!-- include footer -->
<?php include ("includes/footer.php"); ?>

	</body>
</html>