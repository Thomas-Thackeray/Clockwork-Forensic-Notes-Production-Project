<button id = "login_submitButton" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
<style>
#login_submitButton {
	background-color: #24292f;
	font-family: 'Montserrat', sans-serif;
	padding: 0px;
	font-size: 15px;

	color: white;
	transition: 0.5s;
	border: 1px solid transparent;
    width: 100%;
    height: 50px;
    border-radius: 25px;
    font-weight: 800;
    line-height: 1.2;
}
#login_submitButton:hover {
	cursor: pointer;
	background-color: #006bec;
	border: 1px solid white;
}

</style>