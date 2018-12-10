<!-- Footer -->

<footer class="footer">
	<div class="container">
		<div class="row">

			<div class="col-lg-3 footer_col">
				<div class="footer_column footer_contact">
					<div class="logo_container">
						<div class="logo"><a href="#">{{ config('app.name') }}</a></div>
					</div>
					<div class="footer_title">Got Question? Call Us 24/7</div>
					<div class="footer_phone">+977 9846055581</div>
					<div class="footer_contact_text">
						<p>Bhaktapur</p>
						<p>Changunarauan</p>
					</div>
					<div class="footer_social">
						<ul>
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-youtube"></i></a></li>
							<li><a href="#"><i class="fab fa-google"></i></a></li>
							<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-2 offset-lg-2">
				<div class="footer_column">
					<div class="footer_title">Find it Fast</div>
					<ul class="footer_list">
						<li><a href="{{ route('login') }}">Login</a></li>
						<li><a href="{{ route('register') }}">Customer Register</a></li>
						<li><a href="{{ url('seller/register/step1') }}">Seller Register</a></li>						
					</ul>
					
				</div>
			</div>

			<div class="col-lg-2">
				<div class="footer_column">
					<ul class="footer_list footer_list_2">
						
					</ul>
				</div>
			</div>

			<div class="col-lg-2">
				<div class="footer_column">
					<div class="footer_title">Customer Care</div>
					<ul class="footer_list">
						<li><a href="{{ url('customer') }}">My Account</a></li>
						<li><a href="{{  url('wishlist') }}">My Wishlist</a></li>
						<li><a href="{{ url('cart') }}">My Cart</a></li>
						<li><a href="mailto:subash.niroula4455@gmail.com">subash.niroula4455@gmail.com</a></li>
						<li>9846055581</li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</footer>
