
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><b><?php echo $dailyword['title']; ?></b></h3>
    </div>
    <div class="panel-body">
    	<div class="dailyword">
    		<a href="/tag/<?php echo $dailyword['word']['id']; ?>.html"><?php echo $dailyword['word']['name']; ?></a>
      		<p><?php echo $dailyword['word']['description']; ?></p>
    	</div>
    </div>
  </div>