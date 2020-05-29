<style>
	@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

	body {
		background: #e2e2e2;
		width: 98%;
		height: 100vh;
	}

	body .card {
		width: 800px;
		height: 400px;
		background: transparent;
		position: absolute;
		left: 0;
		right: 0;
		margin: auto;
		top: 0;
		bottom: 0;
		border-radius: 10px;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		box-shadow: 0px 20px 30px 3px rgba(0, 0, 0, 0.55);
	}

	body .card_left {
		width: 40%;
		height: 400px;
		float: left;
		overflow: hidden;
	}

	body .card_left img {
		width: 100%;
		height: auto;
		border-radius: 10px 0 0 10px;
		-webkit-border-radius: 10px 0 0 10px;
		-moz-border-radius: 10px 0 0 10px;
		position: relative;
	}

	body .card_right {
		width: 60%;
		float: left;
		background: #000000;
		height: 400px;
		border-radius: 0 10px 10px 0;
		-webkit-border-radius: 0 10px 10px 0;
		-moz-border-radius: 0 10px 10px 0;
	}

	body .card_right h1 {
		color: white;
		font-family: 'Montserrat', sans-serif;
		text-align: left;
		font-size: 40px;
		margin: 30px 0 0 0;
		padding: 0 0 0 40px;
		letter-spacing: 1px;
	}

	body .card_right h2 {
		color: white;
		font-family: 'Montserrat', sans-serif;
		text-align: left;
		font-size: 40px;
		margin: 20px 0 0 0;
		padding: 0 0 0 40px;
		letter-spacing: 1px;
	}

	body .card_right h3 {
		color: white;
		font-family: 'Montserrat', sans-serif;
		text-align: left;
		font-size: 20px;
		margin: 20px 0 0 0;
		padding: 0 0 0 40px;
		letter-spacing: 1px;
	}

	body .card_right__details ul {
		list-style-type: none;
		padding: 0 0 0 40px;
		margin: 10px 0 0 0;
	}

	body .card_right__details ul li {
		color: #e3e3e3;
		font-family: 'Montserrat', sans-serif;
		font-weight: 400;
		font-size: 14px;
		padding: 0 40px 0 0;
	}

	body .card_right__review table {
		color: white;
		font-family: 'Montserrat', sans-serif;
		font-size: 12px;
		padding: 0 40px 0 40px;
		letter-spacing: 1px;
		margin: 10px 0 10px 0;
		line-height: 20px;
	}

	body .card_right__review a {
		text-decoration: none;
		font-family: 'Montserrat', sans-serif;
		font-size: 14px;
		padding: 0 0 0 40px;
		color: #ffda00;
		margin: 0;
	}
</style>
<div class='card'>
	<div class='card_left'>
		<img src='assets/img/logo.png'>
	</div>
	<div class='card_right'>
		<h1>R.S. EMPPS AHH</h1>
		<div class='card_right__details'>
			<ul>
				<li>Jl. R. A. Kartini No. 666 Mojoroto, Kode Pos : 66669</li>
				<li>Kediri, Jawa Timur.</li>
			</ul>
			<div class='card_right__review'>
				<h2>104081998</h2>
				<h3>LEON PRASETYA MULYA</h3>
				<table>
					<tr>
						<td>Tgl. Lahir</td>
						<td> : 04 Agustus 1998</td>
					</tr>
					<tr>
						<td>Alamat Pasien</td>
						<td> : Jl. Dr. Wahidin Sudirohusodo No. 666 Trenggalek</td>
					</tr>
				</table>
				<p><br /></p>
			</div>
		</div>
	</div>
</div>