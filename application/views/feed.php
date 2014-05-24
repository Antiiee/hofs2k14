<?php 
if($event)
{
foreach ($event as $content) 
{
?>
<div class="col-sm-10 col-sm-offset-2">
	<h1>
		<?php echo $content['title']; ?>
	</h1>
	<div class="col-md-4">
		<img class="img-responsive" src="<?php echo base_url(); ?><?php echo $content['pic']; ?>">
	</div>
	<p>
		<?php echo $content['comment']; ?>
	</p>
</div>
<?php
}
}
else
{
?>
<div class="col-sm-10 col-sm-offset-2">
	<h3>Nothing in your feed</h3>
</div>
<?php }?>