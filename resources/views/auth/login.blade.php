@php
    $warna1 = DB::table('h1')->where('id_h1', 16)->first()->isi;
    $warna2 = DB::table('h1')->where('id_h1', 17)->first()->isi;
@endphp
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>
    img{
	width: 100%;
}
.login {
    height: 100%;
    width: 100%;
    background: {{$warna1}};
    position: relative;
}
.login_box {
    width: 1050px;
    height: 600px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: {{$warna2}};
    border-radius: 10px;
    box-shadow: 1px 4px 22px -8px #0004;
    display: flex;
    overflow: hidden;
}
.login_box .left{
  width: 41%;
  height: 100%;
  padding: 25px 25px;
  
}
.login_box .right{
  width: 59%;
  height: 100%  
}
.left .top_link a {
    color: #452A5A;
    font-weight: 400;
}
.left .top_link{
  height: 20px
}
.left .contact{
	display: flex;
    align-items: center;
    justify-content: center;
    align-self: center;
    height: 100%;
    width: 73%;
    margin: auto;
}
.left h3{
  text-align: center;
  margin-bottom: 20px;
}
.left input {
    border: none;
    width: 80%;
    margin: 15px 0px;
    border-bottom: 1px solid #4f30677d;
    padding: 7px 9px;
    width: 100%;
    overflow: hidden;
    background: transparent;
    font-weight: 600;
    font-size: 14px;
}
.left{
	background: linear-gradient(-45deg, #dcd7e0, #fff);
}
.submit {
    border: none;
    padding: 15px 70px;
    border-radius: 8px;
    display: block;
    margin: auto;
    margin-top: 120px;
    background: #583672;
    color: #fff;
    font-weight: bold;
    -webkit-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
    -moz-box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
    box-shadow: 0px 9px 15px -11px rgba(88,54,114,1);
}





.right .right-text{
  height: 100%;
  position: relative;
  transform: translate(0%, 45%);
}
.right-text h2{
  display: block;
  width: 100%;
  text-align: center;
  font-size: 50px;
  font-weight: 500;
}
.right-text h5{
  display: block;
  width: 100%;
  text-align: center;
  font-size: 19px;
  font-weight: 400;
}

.right .right-inductor{
  position: absolute;
  width: 70px;
  height: 7px;
  background: #fff0;
  left: 50%;
  bottom: 70px;
  transform: translate(-50%, 0%);
}
.top_link img {
    width: 28px;
    padding-right: 7px;
    margin-top: -3px;
}
.register {
    
}



</style>
<body>

  @php
            $img = DB::table('h1')->where('id_h1', 2)->first()->isi;
            $url_asset = ' http://127.0.0.1:2222/assets/img/';
        @endphp
	<section class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
					<form method="POST" action="{{ route('login') }}">
            @csrf
            <img src="{{$url_asset . $img}}"  style="width: 100px; object-fit: cover; text-align: center; margin-left: 90px; margin-bottom: 10px;" alt="">
						<h3>SIGN IN</h3>
						<input type="text" name="email" placeholder="EMAIL">
						<input type="password" name="password" placeholder="PASSWORD">
            <a href="{{ route('register') }}" class="register">Tidak punya akun ?</a>
						<button class="submit">LOGIN</button>
					</form>
				</div>
			</div>
			<div class="right">
        <img src="{{ asset('images-upload/login.jpg') }}" alt="">
				<div class="right-text">
					<h2>Happy Kids Login</h2>
					<h5>A UX BASED CREATIVE AGENCEY</h5>
				</div>
				<div class="right-inductor"></div>
			</div>
		</div>
	</section>
</body>
</html>