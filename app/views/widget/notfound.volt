<div class="nf">
	<div class="nf-title"><b>404!!</b> 您访问的页面不存在或已删除</div>
	<div class="nf-desc"><span class="leftsecond">5</span>秒后返回<a class="nf-tohome" href="/">慧学网首页</a></div>
</div>

<script>
	var leftTime = 5;
	var intervalid = setInterval(countTime, 1000);
	function countTime(){
		if (leftTime == 0) {
			clearInterval(intervalid);
			location.href = "/";
		}
		$('.leftsecond').text(leftTime);
		leftTime--;
	}
</script>