<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

    <?if($APPLICATION->GetCurDir() != "/"){?>
        </div><!--end .container-->
    <?}?>

    </div><!--end .workarea-->

	<footer class="py-5">
			<div class="container">
				<div class="row mb-5">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="row pr-md-2">
                            <div class="col-12 col-md-4">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_menu_1.php"
                                    ),
                                    false
                                );?>
                            </div>
                            <div class="col-12 col-md-3">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_menu_2.php"
                                    ),
                                    false
                                );?>
                            </div>
                            <div class="col-12 col-md-5">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_menu_3.php"
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="row px-md-3">
                            <div class="col-12 col-md-6">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_menu_4.php"
                                    ),
                                    false
                                );?>
                            </div>
                            <div class="col-12 col-md-6">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_menu_5.php"
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="row pl-md-2">
                            <div class="col-12 col-md-6">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_social.php"
                                    ),
                                    false
                                );?>
                            </div>
                            <div class="col-12 col-md-6">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR."include/footer_contacts.php"
                                    ),
                                    false
                                );?>
                            </div>
                        </div>
                    </div>
				</div>

				<div class="row mb-5">
                    <div class="col-12 col-md-4">
                        <div class="pr-md-2">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/footer_text_1.php"
                                ),
                                false
                            );?>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="px-md-3">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/footer_text_2.php"
                                ),
                                false
                            );?>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="pl-md-2">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR."include/footer_text_3.php"
                                ),
                                false
                            );?>
                        </div>
                    </div>
				</div>

                <div class="text-center">
                    GTU GROUP, 2022
                </div>
			</div>
	</footer>
</div> <!-- //bx-wrapper -->


<script>
	BX.ready(function(){
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});
</script>
</body>
</html>