<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
body {
  background-color: #ddd;
}

h3 {
  margin-top: 0;
}

.badge {
  background-color: #777;
}

.tabs-left {
  margin-top: 3rem;
}

.nav-tabs {
  float: left;
  border-bottom: 0;
}
.nav-tabs li {
  float: none;
  margin: 0;
}
.nav-tabs li a {
  margin-right: 0;
  border: 0;
  border-radius: 0;
  background-color: #333;
}
.nav-tabs li a:hover {
  background-color: #444;
}
.nav-tabs .glyphicon {
  color: #fff;
}
.nav-tabs .active .glyphicon {
  color: #333;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
  border: 0;
}

.tab-content {
  margin-left: 45px;
}
.tab-content .tab-pane {
  display: none;
  background-color: #fff;
  padding: 1.6rem;
  /* overflow-y: auto; */
}
.tab-content .active {
  display: block;
}

.list-group {
  width: 100%;
  height:100%;
}
.list-group .list-group-item {
  /* height: 50px; */
}
.list-group .list-group-item h4, .list-group .list-group-item span {
  line-height: 11px;
}

</style>
</head>
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="tabs-left">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#a" data-toggle="tab"><span class="glyphicon glyphicon-heart"></span></a></li>
          <li><a href="#b" data-toggle="tab"><span class="glyphicon glyphicon-star"></span></a></li>
          <li><a href="#c" data-toggle="tab"><span class="glyphicon glyphicon-headphones"></span></a></li>
          <li><a href="#d" data-toggle="tab"><span class="glyphicon glyphicon-time"></span></a></li>
          <li><a href="#e" data-toggle="tab"><span class="glyphicon glyphicon-calendar"></span></a></li>
          <li><a href="#f" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span></a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="a">
            <h3>Who do you Love?</h3>
            <ul class="list-group pull-left">
              <li class="list-group-item">
                <h4>Jen &nbsp; &nbsp;<span class="badge pull-right">100%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Dezi &nbsp; &nbsp;<span class="badge pull-right">100%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Eli &nbsp; &nbsp;<span class="badge pull-right">100%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Mojo &nbsp; &nbsp;<span class="badge pull-right">83%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Myself &nbsp; &nbsp;<span class="badge pull-right">100%</span></h4>
              </li>
            </ul>
          </div>
          <div class="tab-pane" id="b">
            <h3>What's your Favorite?</h3>
            <ul class="list-group pull-left">
              <li class="list-group-item">
                <h4>Crystals &nbsp; &nbsp;<span class="badge pull-right">100%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Healing &nbsp; &nbsp;<span class="badge pull-right">90%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Exploring &nbsp; &nbsp;<span class="badge pull-right">78%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>QiGong &nbsp; &nbsp;<span class="badge pull-right">83%</span></h4>
              </li>
              <li class="list-group-item">
                <h4>Myself &nbsp; &nbsp;<span class="badge pull-right">100%</span>
                </h4></li>
            </ul>
          </div>
          <div class="tab-pane" id="c">CCCCThirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
          <div class="tab-pane" id="d">DDDDDSecondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. Aliquam in felis sit amet augue.</div>
          <div class="tab-pane" id="e">EEEEEThirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
          <div class="tab-pane" id="f">FFFFFFThirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. Quisque mauris augue, molestie tincidunt condimentum vitae.</div>
        </div><!-- /tab-content -->
      </div><!-- /tabbable -->
    </div><!-- /col -->
  </div><!-- /row -->
</div><!-- /container -->

<script>
// var tabsFn = (function() {
  
//   function init() {
//     setHeight();
//   }
  
//   function setHeight() {
//     var $tabPane = $('.tab-pane'),
//         tabsHeight = $('.nav-tabs').height();
    
//     $tabPane.css({
//       height: tabsHeight
//     });
//   }
    
//   $(init);
// })();
</script>