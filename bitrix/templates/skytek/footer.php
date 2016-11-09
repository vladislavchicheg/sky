<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<?$curPage = $APPLICATION->GetCurPage(true);?>
<?if ($curPage != SITE_DIR."index.php"):?>
</div>
	<?endif?>
</main>
<footer>
	<div class="bg2">
		<div class="wrapper">
			<div class="container col-md-12">
				<div class="formas2">
					<h2>Не тратьте время!</h2>
					<h5>получите бесплатную консультацию по телефону! Звонок за наш счет</h5>
					<form id="callbackForm11" action="/sendmail.php" method="post">
						<div class="col-md-3 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 nopad">
							<input id="name" type="text" maxlength="183" name="name" placeholder="Ваше имя" required=""/>
						</div>
						<div class="col-md-3 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 nopad">
							<input id="phone" type="tel" maxlength="183" name="phone" placeholder="Телефон" pattern="[0-9]{5,10}" required=""/>
						</div>
						<div class="col-md-2 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2 nopad">
							<button type="submit" class="but1">Получить консультацию</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<div class="row botmenus">
			<div class="col-md-3 col-sm-3 botmenusitem">
				<h2>Услуги</h2>
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"mobile-menu",
					Array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "left",
						"COMPOSITE_FRAME_MODE" => "A",
						"COMPOSITE_FRAME_TYPE" => "AUTO",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(""),
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE" => "uslugi",
						"USE_EXT" => "N"
					)
				);?>
			</div>
			<div class="col-md-3 col-sm-3 botmenusitem">
				<h2>Оборудование</h2>
				<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"mobile-menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "oborud",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "mobile-menu"
	),
	false
);?>
			</div>
			<div class="col-md-3 col-sm-3 botmenusitem">
				<h2>ООО «Скайтек»</h2>
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/includes/fcontacts.php",
						"EDIT_TEMPLATE" => ""
					),
					false
				);?>
			</div>
			<div class="col-md-3 col-sm-3 botmenusitem">
				<h2>Телефоны</h2>
				<? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/includes/ftel1.php",
						"EDIT_TEMPLATE" => ""
					),
					false
				);?><a href="#myModal" data-toggle="modal" title="заказать" class="but1">Заказать звонок</a><br/><? $APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_TEMPLATE_PATH . "/includes/ftel2.php",
						"EDIT_TEMPLATE" => ""
					),
					false
				);?>
			</div>
		</div>
	</div>
	<div class="copyright"><? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH . "/includes/copy.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		);?></div>
</footer>
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

			</div>
			<div class="modal-body">

				<h2>Оставьте контакты и мы перезвоним</h2>

				<div class="forma">
					<div class="formas1  row col-md-12 col-sm-12 col-xs-12">

						<div class="col-md-12">

							<form action="" method="post" class="zvonok" id="callbackForm11">
								<div class=" col-md-12  nopad">
									<input type="text" maxlength="183" name="zname" id="name" placeholder="Ваше имя" required="" />
								</div>
								<div class=" col-md-12  nopad">
									<input type="tel" maxlength="183" name="ztel" id="phone4" placeholder="Телефон"  required="" />
									<input type="hidden"  name="ztovar" value="заказ звонка"  />
								</div>
								<div class="col-md-12  nopad">
									<button type="submit" class="but1 ">Заказать</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>



<div id="myModal2" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

			</div>
			<div class="modal-body">


				<h4 class="elementToReplace"></h4>
				<div class="forma">
					<div class="formas1  row col-md-12 col-sm-12 col-xs-12">

						<div class="col-md-12">

							<form action="" method="post" class="addtovar"  id="callbackForm12">
								<div class=" col-md-12  nopad">
									<input type="text" maxlength="183" name="zname" id="name" placeholder="Ваше имя" required="" />
								</div>
								<div class=" col-md-12  nopad">
									<input type="tel" maxlength="183" name="ztel" id="phone5" placeholder="Телефон"  required="" />
									<input type="hidden"  name="ztovar" id="zamenatovar" value=""  />
								</div>
								<div class="col-md-12  nopad">
									<button type="submit" class="but1 ">Заказать</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<div id="myModal3" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

			</div>
			<div class="modal-body">


				<h2>Задайте свой вопрос</h2>
				<div class="forma">
					<div class="formas1  row col-md-12 col-sm-12 col-xs-12">

						<div class="col-md-12">

							<form action="" method="post" class="addvopros" id="callbackForm13">
								<div class=" col-md-12  nopad">
									<input type="text" maxlength="183" name="zname" id="name" placeholder="Ваше имя" required="" />
								</div>
								<div class=" col-md-12  nopad">
									<input type="email" maxlength="183" name="zmail" id="zmail" placeholder="Ваше email" required="" />
								</div>
								<div class=" col-md-12  nopad">
									<input type="tel" maxlength="183" name="ztel" id="phone5" placeholder="Телефон"  required="" />
									<input type="hidden"  name="ztovar"  value="Вопрос"  />
								</div>
								<div class=" col-md-12  nopad">
									<textarea name="zmess" placeholder="Ваш вопрос"></textarea>
								</div>
								<div class="col-md-12  nopad">
									<button type="submit" class="but1 ">Заказать</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<div id="succ" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

			</div>
			<div class="modal-body">

				<h2>Ваше сообщение успешно отправлено</h2>


			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="https://static.yandex.net/browser-updater/v1/script.js" charset="utf-8"></script>
<script>var browserUpdater = new ya.browserUpdater.init(
 {
    theme: "blue",
    lang: "ru",
    exclusive: false,
    browsers: {
      chromium: 35,
      iron: 35,
      flock: "Infinity",
      palemoon: 25,
      camino: "Infinity",
      safari: 5.2,
      yandexinternet: "Infinity",
      fx: 31,
      ie: 9,
      opera: 16,
      chrome: 35,
      maxthon: 4.4,
      seamonkey: 2.4
    },
    remember: true,
    rememberFor: 30,
    cookiePrefix: "yaBrowserUpdater",
    classNamePrefix: "ya-browser-updater",
    jsonpCallback: "yaBrowserUpdaterJSONPCallback",
    onStripeShow: null,
    onStripeHide: null
 });
</script>
</body>
</html>