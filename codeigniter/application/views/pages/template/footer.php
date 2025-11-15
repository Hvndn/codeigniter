<footer id="footer"><!--Footer-->
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="companyinfo">
						<h2><span>e</span>-shopper</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="<?php echo base_url('frontend/images/home/iframe1.png') ?>" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="<?php echo base_url('frontend/images/home/iframe2.png') ?>" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="<?php echo base_url('frontend/images/home/iframe3.png') ?>" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="video-gallery text-center">
							<a href="#">
								<div class="iframe-img">
									<img src="<?php echo base_url('frontend/images/home/iframe4.png') ?>" alt="" />
								</div>
								<div class="overlay-icon">
									<i class="fa fa-play-circle-o"></i>
								</div>
							</a>
							<p>Circle of Hands</p>
							<h2>24 DEC 2014</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="address">
						<img src="<?php echo base_url('frontend/images/home/map.png') ?>" alt="Map" />
						<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-widget">
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Service</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Online Help</a></li>
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Order Status</a></li>
							<li><a href="#">Change Location</a></li>
							<li><a href="#">FAQ’s</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Quick Shop</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">T-Shirt</a></li>
							<li><a href="#">Mens</a></li>
							<li><a href="#">Womens</a></li>
							<li><a href="#">Gift Cards</a></li>
							<li><a href="#">Shoes</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>Policies</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Terms of Use</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Refund Policy</a></li>
							<li><a href="#">Billing System</a></li>
							<li><a href="#">Ticket System</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Company Information</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="#">Store Location</a></li>
							<li><a href="#">Affiliate Program</a></li>
							<li><a href="#">Copyright</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<div class="single-widget">
						<h2>About Shopper</h2>
						<form action="#" class="searchform">
							<input type="text" placeholder="Nhập địa chỉ email của bạn" />
							<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
							<p>Nhận những thông tin mới nhất từ<br />website của chúng tôi...</p>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © 2023 E-SHOPPER Inc. All rights reserved.</p>
				<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
			</div>
		</div>
	</div>

</footer><!--/Footer-->

<script src="<?php echo base_url('frontend/js/jquery.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/jquery.scrollUp.min.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/price-range.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/jquery.prettyPhoto.js') ?>"></script>
<script src="<?php echo base_url('frontend/js/main.js') ?>"></script>


<!-- Chatbot Floating Button -->
<div id="chatbot-container">
  <div id="chatbot-header">🤖 Chatbot</div>
  <div id="chatbot-box" style="display:none;">
    <div id="chatbot-messages"></div>
    <div id="chatbot-input">
      <input type="text" id="userInput" placeholder="Nhập tin nhắn..." />
      <button id="sendBtn">Gửi</button>
    </div>
  </div>
  <button id="chatbot-toggle">💬</button>
</div>

<!-- Chatbot Styles -->
<style>
#chatbot-container {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999;
  font-family: Arial, sans-serif;
}

#chatbot-toggle {
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 50%;
  width: 55px;
  height: 55px;
  cursor: pointer;
  font-size: 22px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

#chatbot-box {
  width: 300px;
  height: 400px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 3px 15px rgba(0,0,0,0.3);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  position: fixed;
  bottom: 90px;
  right: 20px;
}

#chatbot-header {
  background: #007bff;
  color: white;
  padding: 10px;
  text-align: center;
  font-weight: bold;
}

#chatbot-messages {
  flex: 1;
  padding: 10px;
  overflow-y: auto;
}

#chatbot-input {
  display: flex;
  padding: 8px;
  border-top: 1px solid #ddd;
}

#chatbot-input input {
  flex: 1;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#chatbot-input button {
  margin-left: 5px;
  padding: 6px 12px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>

<!-- Chatbot Script -->
<script>
document.getElementById("chatbot-toggle").onclick = function() {
  const box = document.getElementById("chatbot-box");
  box.style.display = box.style.display === "none" ? "flex" : "none";
};

document.getElementById("sendBtn").onclick = async function() {
  const input = document.getElementById("userInput");
  const message = input.value.trim();
  if (!message) return;

  const messagesDiv = document.getElementById("chatbot-messages");
  messagesDiv.innerHTML += `<div><b>Bạn:</b> ${message}</div>`;
  input.value = "";

  try {
    const res = await fetch("http://127.0.0.1:5000/chat", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ message: message })
    });

    const data = await res.json();
    const reply = data.response || data.error || "Không có phản hồi";
    messagesDiv.innerHTML += `<div><b>Bot:</b> ${reply}</div>`;
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
  } catch (err) {
    messagesDiv.innerHTML += `<div><b>Bot:</b> Không thể kết nối máy chủ Flask.</div>`;
  }
};
</script>


</body>

</html>