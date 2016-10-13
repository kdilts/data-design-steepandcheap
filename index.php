<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Data Design Project</title>
		<link href="stylesheet.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<header>
			<h1>Data Design Project</h1>
		</header>
		<main>

			<!-- Persona -->
			<section>
				<h2 class="subheading">Persona</h2>
				<ul>
					<li><strong>Name:</strong> Kevin</li>
					<li><strong>Age:</strong> 25</li>
					<li><strong>Job:</strong> Web Developer in training. He spends most of his time learning about HTML, CSS, PHP, mySQL, and Javascript.</li>
					<li><strong>Technology:</strong> PC Loyalist. Uses a desktop with Windows 10 and a big screen TV at home. As well as a Windows 10 laptop for traveling.</li>
					<li><strong>Behavior:</strong> Kevin is a climbing enthusiast who compulsively checks and rechecks the website for good deals on climbing gear. Also he enjoys browsing through products just to learn their features and decide if they will be added to his mental wishlist.</li>
					<li><strong>Goals:</strong> Kevin would like to build a collection of climbing gear for cheap. Also, he wants to learn everything he can about climbing, and part of that is gaining familiarity with all the different brands and products out there.</li>
					<li><strong>Frustrations:</strong> REI is one of the only local places to buy gear, and they are very expensive.</li>
				</ul>
			</section>

			<!-- Use Case -->
			<section>
				<h3 class="subheading">Use Case</h3>
				<p>
					Kevin gets home from a day at work, and wants to relax. He fires up Chrome and goes to steepandcheap.com. After glancing at the current steal, he starts browsing the climbing section without any specific intent to buy anything. After spending some time ogling the pulley systems and mechanical ascenders, he stumbles across quick draw spines for $0.80 a piece and quickly orders twenty of them before someone else beats him to it.
				</p>
			</section>

			<!-- Interaction Flow -->
			<section>
				<h4 class="subheading">Interaction Flow</h4>
				<ol>
					<li>Navigate to steepandcheap.com</li>
					<li>Look at current steal</li>
					<li>Don't buy it because it's a shirt</li>
					<li>Search "climb"</li>
					<li>Set category to climb, and filter by >30% off</li>
					<li>Scroll through list of items looking for anything of interest</li>
				</ol>
			</section>

			<!-- Entities -->
			<section>
				<h5 class="subheading">Entities and Attributes</h5>
				<ul id="flexList">
					<li class="listEntity">Product
						<ul>
							<li>productId (Primary Key)</li>
							<li>productReviews (Foreign Key to Review)</li>
							<li>productName</li>
							<li>productPrice</li>
							<li>productImgPath</li>
							<li>productSpecifications</li>
							<li>N-to-M relationship with User</li>
						</ul>
					</li>
					<li class="listEntity">Review (Weak)
						<ul>
							<li>reviewId (Primary Key)</li>
							<li>reviewAuthorId (Foreign Key to User)</li>
							<li>reviewProductId (Foreign Key to Product)</li>
							<li>reviewRating</li>
							<li>reviewDatePosted</li>
							<li>reviewContent</li>
						</ul>
					</li>
					<li class="listEntity">User
						<ul>
							<li>userName (Primary Key)</li>
							<li>userReviewsPosted (Foreign Key to Review)</li>
							<li>userPurchases (Foreign Key to Product)</li>
							<li>userHash</li>
							<li>userSalt</li>
							<li>userAddress</li>
							<li>userEmail</li>
							<li>N-to-M relationship with Product</li>
						</ul>
					</li>
				</ul>
			</section>
		</main>
	</body>
</html>