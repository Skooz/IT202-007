<!DOCTYPE html>
<html>
<head>
<style>
p{color: purple;}
h1,h2{color:white;}
h1,h2{background-color: black;}
.myClassname{background-color:orange;}
#myId{}
</style>
<script>
	function queryParam(){
		var params = new URLSearchParams(location.search);
		if(params.has('page')){
			var page = params.get('page');
			var ele = document.getElementById(page);
			if(ele){
				let home = document.getElementById('home');
				let about = document.getElementById('about');
				home.style.display="none";
				about.style.display = "none";
				ele.style.display = "block";
			}
		}
		else{
			let home = document.getElementById('home');
			home.style.display = "block";
			let about = document.getElementById('about');
			about.style.display=  "none";
		}
	}
</script>
</head>
<body onload="queryParam();">
	<header>
		<nav> 
			<a href="?page=home">Home</a> |
			<a href="?page=about">About</a>
			<!--Create route for Home-->
			<!--Create route for About-->
		</nav>
	</header>
	<div id="home">
		Home is where home is.
	</div>
	<div id="about" style="display:none;">
		<section class="myClassname">
			<h1>About</h1>
			<p>Did I copy the solutions on github? Maybe. But I made all these edits so I could do the learn thing.</p>
		</section>
		<article>
			<h2>The Squad of the Company of the Battallion of the entire Army is this getting too long?</h2>
			<p>"Sample Text", as the kids say.</p>
			<figure>
				<img src="../bwushie.jpg" width="100px" height="100px"/>
				<figcaption>This might be related to our project. Emphasis on might, because big strong knight. No he is not blushing, it is your imagination.</figcaption>
			</figure>
		</article>
		<p>last updated <time>10:40</time></p>
		<!-- About page using HTML5 Semantics-->
		<p>Click this thing, because I said so: <progress value="0" max="100"
			onclick="this.value++" 
			oncontextmenu="this.value--;event.preventDefault();"></progress></p>
	</div>
	<footer></footer>
</body>
</html>