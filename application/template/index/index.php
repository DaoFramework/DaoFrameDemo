<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>My First Framework</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="alternate icon" type="image/png" href="/assets/i/favicon.png">
  <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>

	<!--[if lt IE 9]>
	<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
	<script src="/assets/js/amazeui.ie8polyfill.min.js"></script>
	<![endif]-->

	<!--[if (gte IE 9)|!(IE)]><!-->
	<script src="/assets/js/jquery.min.js"></script>
	<!--<![endif]-->
	<script src="/assets/js/amazeui.min.js"></script>
	<link rel="stylesheet" href="/assets/css/app.css"/>

	</head>

	<body>
		<?php require VIEWS_PATH."/layout/".'top.php';?>
		<div class="get">
  <div class="am-g">
    <div class="am-u-lg-12 am-animation-scale-up">
      <h1 class="get-title">为您提供专业的互联网解决方案</h1>
      <p>
        期待与您的合作，共同打造更好的科技生活
      </p>
      <p>
        <a href="#showcase" class="am-btn am-btn-sm get-btn">查看我们的作品</a>
      </p>
    </div>
  </div>
</div>

<div class="detail">
  <div class="am-g am-container">
    <div class="am-u-lg-12">
      <h2 class="detail-h2">网站 、App 、硬件、微信公众号 我们皆可实现!</h2>

      <div class="am-g">
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">

          <h3 class="detail-h3">
            <i class="am-icon-mobile am-icon-sm"></i>
            专业的开发团队
          </h3>

          <p class="detail-p">
            我们拥有专业的Web、IOS、Android App开发团队，丰富开发经验，为您的产品提供最优的技术保障，保驾护航
          </p>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
          <h3 class="detail-h3">
            <i class="am-icon-html5 am-icon-sm"></i>
            先进的Html5技术
          </h3>

          <p class="detail-p">
            W3C官方推荐标准，支持多设备跨平台，自适应网页设计，构建体验优秀的跨屏页面，大幅度提升页面效率
          </p>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
          <h3 class="detail-h3">
            <i class="am-icon-codepen am-icon-sm"></i>
            智能硬件先行者
          </h3>

          <p class="detail-p">
            通过软硬件结合的方式，使硬件具备连接的能力，实现互联网服务的加载，形成“云+端”的大数据典型架构
          </p>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
          <h3 class="detail-h3">
            <i class="am-icon-github-alt am-icon-sm"></i>
            始终如一的服务
          </h3>

          <p class="detail-p">
            我们从需求分析、交互设计到视觉创意，从技术开发、软件测试到双方项目验收，为您提供始终如一的服务
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hope">
  <div class="am-g am-container">
    <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
      <img src="/assets/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
      <hr class="am-article-divider am-show-sm-only hope-hr">
    </div>
    <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
      <h2 class="hope-title">同我们一起改变世界！</h2>

      <p>
        在科技爆炸的年代，我们愿为社会贡献我们微弱的力量，为您提供最专业的设计、开发、运营服务，为共建美好生活，努力！
      </p>
    </div>
  </div>
</div>

<div class="about">
  <div class="am-g am-container">
    <div class="am-u-lg-12">
      <h2 class="about-title about-color">我们崇尚开放、自由，非常欢迎大家的沟通交流</h2>

      <div class="am-g">
        <div class="am-u-lg-6 am-u-md-4 am-u-sm-12">
          <form method="post" class="am-form">
            <label for="name" class="about-color">你的姓名</label>
            <input id="name" type="text">
            <br/>
            <label for="email" class="about-color">你的邮箱</label>
            <input id="email" type="email">
            <br/>
            <label for="message" class="about-color">你的留言</label>
            <textarea id="message"></textarea>
            <br/>
            <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="am-icon-check"></i> 提 交</button>
          </form>
          <hr class="am-article-divider am-show-sm-only">
        </div>

        <div class="am-u-lg-6 am-u-md-8 am-u-sm-12">
          <h4 class="about-color">关于我们</h4>

          <p>This is ..</p>
          <h4 class="about-color">团队介绍</h4>

          <p>This is ...</p>
        </div>
      </div>
    </div>
  </div>
</div>

		<?php require VIEWS_PATH."/layout/".'footer.php';?>
	</body>
</html>
