<!--l'éditeur des pages question et theme-->
<?php
	session_start();
 ?>
<!DOCTYPE HTML>
<html>
	<head>
	   <meta charset="utf-8">
		<script src="../framework/jquery-3.1.1.min.js"></script>
		<script src="../framework/bootstrap.min.js"></script>
		<script src="../assets/js/editor.js"></script>
		<script>
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		</script>
		<link rel="stylesheet" href="../framework/bootstrap.min.css">
		<link rel="stylesheet" href="../framework/font-awesome.min.css">
		<link href="../assets/css/editor.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>
		<?php
				if(isset($_SESSION['pageCourante']) && (strcmp($_SESSION['pageCourante'],"question")==0)){
					echo '<form action="../fonction/posterRep.php" method="post">
								<input name="reponse" id="rep" type="hidden" value="">
								<input type="hidden" name="domaine" value="'.$_SESSION['domaine'].'">
								<input type="hidden" name="id_quest" value="'.$_SESSION['id_quest'].'">';
				}
				else echo '<form action="../fonction/posterQuest.php" method="post">
									<input name="question" id="rep" type="hidden" value="">
									<input type="hidden" name="domaine" value="'.$_SESSION['domaine'].'">
									<div>
										<label for="" class="col-xs-11 fl">Objet</label>
										<input type="text" class="col-xs-11 row fl obj" name="titre_quest" value="" style="margin-left:10px;">
									</div>
									<label for="" class="col-xs-11 fl">Contenu</label>';
		?>
				<div class="container" style="width:100%; height:378px">
					<div class="row">
						<div class="col-lg-12 nopadding">
							<textarea id="txtEditor"></textarea>
							<div class="text-right">
								<button id="btn">Poster</button>
							</div>
									<style>
											.fl{
												float: none;
											}
											.fl.obj{
												border: none;
												border-bottom: 1px solid #16cbfc;
											}
											.fl.obj:focus{
												border-bottom: 2px solid #16cbfc;
											}
											#btn{
													margin: 20px 20px 0px 20px;
													font-weight: bold;
													text-transform: capitalize;
											    text-decoration: none;
											    color: #fff;
											    text-align: right;
											    letter-spacing: .5px;
											    transition: .2s ease-out;
											    cursor: pointer;
													outline: 0;
													border: none;
													border-radius: 2px;
													display: inline-block;
													height: 36px;
													line-height: 36px;
													padding: 0 2rem;
													vertical-align: middle;
													-webkit-tap-highlight-color: transparent;
													box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 1px 5px 0 rgba(0,0,0,0.12),0 3px 1px -2px rgba(0,0,0,0.2);
													background-color: #f4511e !important;
													position: relative;
											    cursor: pointer;
											    display: inline-block;
											    overflow: hidden;
											    -webkit-user-select: none;
											    -moz-user-select: none;
											    -ms-user-select: none;
											    user-select: none;
											    -webkit-tap-highlight-color: transparent;
											    vertical-align: middle;
											    z-index: 1;
											    will-change: opacity, transform;
											    transition: .3s ease-out;
											}
									</style>
							</form>

						</div>
					</div>
				</div>
				<script type="text/javascript">
						$("#btn").click(function(){
							var contenu = $('.Editor-editor').html();
							$("#rep").attr("value",contenu);
						});
				</script>
	</body>
</html>
