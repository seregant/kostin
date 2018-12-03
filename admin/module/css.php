<?php 
$invoice_css = '@import url("http://fonts.googleapis.com/css?family=Open+Sans");
	body {
		font-family:"Open Sans";
		font-style:normal;
		font-weight:400;
		src:local("Open Sans"),
		local("OpenSans"),
		url("http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3bO3LdcAZYWl9Si6vvxL-qU.woff") format("woff");
	}
	.wrapper {
		background-color: #fff;
		border: 1px solid;
		border-color: #b7b7b7;
		width: 60%;
		padding: 3em 3em 3em 3em;
		margin: auto;
	}
	.wrapper img {
		padding-left: 3em;
		padding-top: 1em;
	}
	.wrapper p {
		padding-left: 3em;
		padding-top: 0.5em;
	}
	.body-invoice {
		width: 80%;
		border: 1px solid;
		border-color: #b7b7b7;
		border-radius: 4px;
		margin: auto;
	}
	.body-invoice table {
		width: 100%;
		background-color: #fff;
		margin: auto;
		border-radius: 4px;
	}
	.body-invoice th {
		background-color: #1971ff;
		color: white;
		font-weight: bold;
		text-align: left;
		padding: 0.5em;
	}
	.col-kiri {
		border-bottom: 1px solid #ddd;
		text-align: left;
		padding-left: 1em;
	}
	.col-kanan {
		border-bottom: 1px solid #ddd;
		text-align: right;
		padding-right: 1em;
	}
	.total {
		text-align: right;
		font-weight: bold;
		padding-right: 1em;
	}
	.how-to {
		width: 80%;
		border: 1px solid;
		border-radius: 4px;
		border-color: #b7b7b7;
		margin: auto;
		margin-top: 1em;
	}
	.how-to table {
		margin: auto;
		background-color: #fff;
		width: 100%;
		text-align: left;
	}
	.how-to table tr td h3{
		padding-left: 1em;
	}
	.konfirmasi {
		width: 80%;
		padding-left: 1em;
		padding-top: 1em;
		padding-bottom: 1em;
		text-align: center;
		margin: auto;
	}
	.button {
		margin: auto;
		background-color: #1971ff;
		border: none;
		color: white;
		padding: 1em 2em;
		text-align: center;
		display: inline-block;
		font-size: 1em;
		border-radius: 2px;
	}
	.button:hover {
		background-color: #0099cc;
	}
	hr {
		width: 95%;
		display: block;
		height: 1px;
		border: 0;
		border-top: 1px solid  #b7b7b7;
		margin: auto;
		padding: 0;
		}
	.invoice-footer {
		width: 80%;
		margin: auto;
		padding-top: 1em;
	}
	.invoice-footer p {
		padding: 0;
		text-align: center;
	}
	.socmed {
		margin-bottom: 1em;
	}
	.socmed p {
		text-align: right;
		margin: 0;
		padding: 0;
		font-weight: bold;
	}
	.socmed ul {
		float: right;
		padding: 0;
	}
	.socmed ul li {
		float: left;
		list-style-type: none;
		margin-bottom: 1em;
	}
	.socmed ul li a img {
		padding-top: 0px;
		padding-left: 0.5em;
		padding-bottom: 0.5em;
		max-width: 2.5em;
	}
	.copyright {
		width: 100%;
		background-color: #fff8ea;
		text-align: center;
		padding-top: 1em;
		padding-bottom: 1em;
	}
	.copyright a {
		color: #1971ff;
	}
	@media only screen and (max-width: 800px) {
		body {
			font-size: 0.75em;
		}
		.wrapper {
			width: 90%;
		}
		.wrapper img {
			max-width: 200px;
		}
		.body-invoice th {
			font-size: 0.7em;
			font-weight: bold;
		}
		.col-kiri {
			font-size: 0.7em;
		}
		.col-kanan {
			font-size: 0.7em;
		}
		.total {
			font-size: 0.7em;
			font-weight: bold;
		}
		.how-to table tr td h3{
			font-size: 0.8em;
			font-weight: bold;
		}
		.how-to table tr td ol li{
			font-size: 0.7em;
		}
		.how-to table tr td p{
			font-size: 0.7em;
		}
		.socmed ul li a img {
			max-width: 1.5em;
		}
	}
';


$payment_booking_css = '@import url("http://fonts.googleapis.com/css?family=Open+Sans");
				
body {
	font-family:"Open Sans";
	font-style:normal;
	font-weight:400;
	src:local("Open Sans"),
	local("OpenSans"),
	url("http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3bO3LdcAZYWl9Si6vvxL-qU.woff") format("woff");
}

					.wrapper {
						width: 75%;
						background-color: #fff;
						border: 1px solid;
						border-color: #b7b7b7;
						margin: auto;
					}
					.wrapper img {
						padding-left: 3em;
						padding-top: 1em;
					}
					.wrapper p {
						padding-left: 3em;
						padding-top: 0.5em;
					}
					.body-invoice {
						width: 80%;
						border: 1px solid;
						border-color: #b7b7b7;
						border-radius: 4px;
						margin: auto;
					}
					.body-invoice table {
						width: 100%;
						background-color: #fff;
						margin: auto;
						border-radius: 4px;
					}
					.body-invoice th {
						background-color: #1971ff;
						color: white;
						font-weight: bold;
						padding: 0.5em;
					}
					.col-kiri {
						border-bottom: 1px solid #ddd;
						text-align: left;
						padding-left: 1em;
					}
					.col-tengah {
						border-bottom: 1px solid #ddd;
						text-align: center;
						padding-left: 1em;
					}
					.col-kanan {
						border-bottom: 1px solid #ddd;
						text-align: right;
						padding-right: 1em;
					}
					.total {
						text-align: right;
						font-weight: bold;
						padding-right: 1em;
					}
					.text-wrap {
						overflow-wrap: break-word;
					}
					.how-to {
						width: 80%;
						border: 1px solid;
						border-radius: 4px;
						border-color: #b7b7b7;
						margin: auto;
						margin-top: 1em;
					}
					.how-to table {
						margin: auto;
						background-color: #fff;
						width: 100%;
						text-align: left;
					}
					.how-to table tr td h3{
						padding-left: 1em;
					}
					.konfirmasi {
						width: 80%;
						padding-left: 1em;
						padding-top: 1em;
						padding-bottom: 1em;
						text-align: center;
						margin: auto;
					}
					.button {
						margin: auto;
						background-color: #1971ff;
						border: none;
						color: white;
						padding: 1em 2em;
						text-align: center;
						display: inline-block;
						font-size: 1em;
						border-radius: 2px;
					}
					hr {
						width: 95%;
						display: block;
						height: 1px;
						border: 0;
						border-top: 1px solid  #b7b7b7;
						margin: auto;
						padding: 0;
					}
					.invoice-footer {
						width: 80%;
						margin: auto;
						padding-top: 1em;
					}
					.invoice-footer p {
						padding: 0;
						text-align: center;
					}
					.socmed {
						margin-bottom: 1em;
					}
					.socmed p {
						text-align: right;
						margin: 0;
						padding: 0;
						font-weight: bold;
					}
					.socmed ul {
						float: right;
						padding: 0;
					}
					.socmed ul li {
						float: left;
						list-style-type: none;
						margin-bottom: 1em;
					}
					.socmed ul li a img {
						padding-top: 0px;
						padding-left: 0.5em;
						padding-bottom: 0.5em;
						max-width: 2.5em;
					}
					.copyright {
						width: 100%;
						background-color: #fff8ea;
						text-align: center;
						padding-top: 1em;
						padding-bottom: 1em;
					}
					.copyright a {
						color: #1971ff;
					}

					@media only screen and (max-width: 800px) {
						body {
							font-size: 0.75em;
						}
						.wrapper {
							width: 90%;
						}
						.wrapper img {
							max-width: 200px;
						}
						.body-invoice th {
							font-size: 0.7em;
							font-weight: bold;
						}
						.col-kiri {
							font-size: 0.7em;
						}
						.col-tengah {
							font-size: 0.7em;
						}
						.col-kanan {
							font-size: 0.7em;
						}
						.total {
							font-size: 0.7em;
							font-weight: bold;
						}
						.how-to table tr td h3{
							font-size: 0.8em;
							font-weight: bold;
						}
						.how-to table tr td h5{
							font-size: 0.8em;
							font-weight: bold;
						}
						.how-to table tr td h6{
							font-size: 0.7em;
						}					
						.how-to table tr td ol li{
							font-size: 0.7em;
						}
						.how-to table tr td p{
							font-size: 0.7em;
						}
						.socmed ul li a img {
							max-width: 1.5em;
						}
					}';



?>