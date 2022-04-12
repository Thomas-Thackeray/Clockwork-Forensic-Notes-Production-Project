<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<nav class = 'flex-column'>

	<section class = 'sidebar-header flex-row align-center justify-content-center'>

		<h1>LBU Forensic Investigators</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
            			<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
				<path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
			</svg>
            </x-dropdown-link>

        </form>
		
	</section>
	
	<section class = 'sidebar-body flex-column'>

		<ul class = 'flex-column'>
			<li class = 'sidebar-item'>
				<a class = 'flex-row align-center space-between' href="#">

					<p>Dashboard</p>

					<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
					</svg>
					
				</a>
			</li>
			<li class = 'sidebar-item'>
				<a class = 'flex-row align-center space-between' href="#">

					<p>Create Case</p>

					<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
		  				<path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
		  				<path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
					</svg>
					
				</a>
			</li>
			<li class = 'sidebar-item'>
				<a class = 'flex-row align-center space-between' href="#">

					<p>New Note</p>

					<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
						<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
					</svg>
					
				</a>
			</li>
			<li class = 'sidebar-item'>
				<a class = 'flex-row align-center space-between' href="#">

					<p>Download PDF</p>

					<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
					</svg>
					
				</a>
			</li>
			<li class = 'sidebar-item'>
				<a class = 'flex-row align-center space-between' href="#">

					<p>All Evidence Items</p>

						<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
						</svg>
				</a>
			</li>

			<li class = 'sidebar-item sidebar-popup-link'>
				<a class = 'flex-row align-center space-between' href="#">

					<p>Notes View</p>

						<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
						</svg>
				</a>

				<section class = 'sidebar-popup'>

					<section class = 'sidebar-popup-container'>

						<ul>
							<li class = 'sidebar-item'>
								<a class = 'flex-row align-center space-between' href="#">

									<p>Timeline View</p>

									<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
										<path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
										<path d="M7 10a1 1 0 0 0 0-2H1v2h6zm2-3h6V5H9a1 1 0 0 0 0 2z"/>
									</svg>
								</a>
							</li>

							<li class = 'sidebar-item'>
								<a class = 'flex-row align-center space-between' href="#">

									<p>Table View</p>

									<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
										<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
									</svg>
								</a>
							</li>
						</ul>

					</section>
					
				</section>
			</li>

			<li class = 'sidebar-item sidebar-popup-link'>

				<a class = 'flex-row align-center space-between' href="#">

					<p>Tool Kit</p>

						<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
						</svg>
				</a>

				<section class = 'sidebar-popup'>

					<section class = 'sidebar-popup-container'>

						<ul>
							<li class = 'sidebar-item'>
								<a class = 'flex-row align-center space-between' href="#">

									<p>Timeline View</p>

									<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
										<path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
										<path d="M7 10a1 1 0 0 0 0-2H1v2h6zm2-3h6V5H9a1 1 0 0 0 0 2z"/>
									</svg>
								</a>
							</li>

							<li class = 'sidebar-item'>
								<a class = 'flex-row align-center space-between' href="#">

									<p>Table View</p>

									<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
										<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
									</svg>
								</a>
							</li>
						</ul>

					</section>
					
				</section>
			</li>

			<li class = 'sidebar-item sidebar-popup-link'>

				<a class = 'flex-row align-center space-between' href="#">

					<p>Settings</p>

						<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
							<path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
						</svg>
				</a>

				<section class = 'sidebar-popup'>

					<section class = 'sidebar-popup-container'>

						<ul>
							<li class = 'sidebar-item'>
								<a class = 'flex-row align-center space-between' href="#">

									<p>Timeline View</p>

									<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
										<path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
										<path d="M7 10a1 1 0 0 0 0-2H1v2h6zm2-3h6V5H9a1 1 0 0 0 0 2z"/>
									</svg>
								</a>
							</li>

							<li class = 'sidebar-item'>
								<a class = 'flex-row align-center space-between' href="#">

									<p>Table View</p>

									<svg class = 'sidebar-svg-small' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
										<path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
									</svg>
								</a>
							</li>
						</ul>

					</section>
					
				</section>
			</li>
		</ul>
		
	</section>

	<section class = 'sidebar-footer flex-column'>
		
	</section>

</nav>

<style>
nav {
	height: 100%;
	width: 100%;
}
.sidebar-svg-small {
	height: 20px;
	width: 20px;
	fill: white;
}
.side-menuBar {
	background-color: var(--primary-colour);
	min-height: 100%;
	width: 20%;
	border-right:  1px solid white;
	max-width: 247px;
}

.sidebar-header {
	width: 100%;
	height: 60px;
	background-color: #0969da;
	padding: 5px;
	color: white;
}
.sidebar-header h1 {
	font-size: 16px;
	margin-bottom: 5px;
	letter-spacing: 1px;
}

.sidebar-body {
	padding: 5px;
}

.sidebar-body h4 {
	font-size: 13px;
	color: white;
	font-weight: 100;
}

.sidebar-item a {
	text-decoration: none;
	padding: 7px;
}
.sidebar-item a p {
	color: white;
	font-size: 13px;
}

.sidebar-item {
	border-top: 1px solid #484848;
	border-bottom: 1px solid #484848;
	margin-bottom: 6px;
}


.sidebar-popup {
	height: 0px;
	width: 100%;
	background-color: var(--primary-colour);
	position: relative;
	/*left: 18.1%;*/
	color: white;
	transition: 1s;
	overflow: hidden;
}
.sidebar-popup-container {
	padding: 7px;
}
</style>

<script>

	$(".sidebar-popup-link").click(function(){
		// $(".sidebar-popup").css({"height": "200px"});
		$(this).find(".sidebar-popup").css("height", "200px");
	});

	$(document).mouseup(function (e) {
	    $(".sidebar-popup").css({"height": "0px"});
	});
</script>