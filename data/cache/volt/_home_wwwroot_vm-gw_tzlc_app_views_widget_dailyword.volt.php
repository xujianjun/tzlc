
<div class="panel panel-primary dailyword-panel">
    <div class="panel-heading">
      <h3 class="panel-title"><b><?php echo $dailyword['title']; ?></b></h3>
    </div>
    <div class="panel-body">
    	<div class="dailyword">
    		<div class="dw-title"><a href="/tag/<?php echo $dailyword['word']['id']; ?>.html"><?php echo $dailyword['word']['name']; ?></a></div>
      		<div class="dw-desc"><?php echo $dailyword['word']['description']; ?></div>
    	</div>
    	<div class="dw-change"><button type="button">换一个</button></div>
    	<div class="dw-more">
    		<a href="/tag/">>> 更多词汇</a>
    	</div>
    </div>
  </div>