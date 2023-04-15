<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="question-container">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="question-form">
                    <?=$arResult["FORM_HEADER"]?>
                    <div class="header"><?=$arResult["FORM_TITLE"]?></div>
                    <div class="text-danger error-msg mb-4"></div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]["NAME"], $arResult["arrVALUES"])?>
                            </div>
                            <div class="form-group">
                                <?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]["PHONE"], $arResult["arrVALUES"])?>
                            </div>
                            <div class="form-group">
                                <?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]["EMAIL"], $arResult["arrVALUES"])?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]['QUESTION'], $arResult["arrVALUES"])?>
                            </div>
                            <div class="d-flex justify-content-between align-items-start">
                                    <div class="form-group d-flex align-items-start">
                                        <div class="mr-2">
                                            <?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]['APPROVAL'], $arResult["arrVALUES"])?>
                                        </div>
                                        <label for="question-form-approval" class="question-form-approval">
                                            <?=$arResult["QUESTIONS"]["APPROVAL"]["CAPTION"]?>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>
                                    </button>
                            </div>
                        </div>
                    </div>
                    <?=$arResult["FORM_FOOTER"]?>
                </div>

                <script>
                    ajaxForm(document.getElementsByName('<?=$arResult['arForm']['SID']?>')[0], '/local/ajax/form.php')

                    function ajaxForm (obForm, link) {
                      BX.bind(obForm, 'submit', BX.proxy(function (e) {
                        BX.PreventDefault(e)
                        obForm.getElementsByClassName('error-msg')[0].innerHTML = ''

                        let xhr = new XMLHttpRequest()
                        xhr.open('POST', link)

                        xhr.onload = function () {
                          console.log(xhr);
                          if (xhr.status != 200) {
                            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`)
                          }
                          else {
                            var json = JSON.parse(xhr.responseText)

                            if (!json.success) {
                              let errorStr = ''
                              for (let fieldKey in json.errors) {
                                errorStr += json.errors[fieldKey] + '<br>'
                              }

                              // Ошибки вывести в элемент с классом error-msg
                              obForm.getElementsByClassName('error-msg')[0].innerHTML = errorStr
                            }
                            else {
                              // Показываем сообщение об успешной отправке
                              // popupSuccess()

                              let form = document.getElementsByClassName("question-form")[0]
                              form.innerHTML = "<div class='text-center question-answer'>Спасибо за ваш вопрос!<br>Мы скоро свяжемся с вами!</div>"
                              console.log(form)
                            }
                          }
                        }

                        xhr.onerror = function () {
                          alert('Запрос не удался')
                        }

                        // Передаем все данные из формы
                        xhr.send(new FormData(obForm))
                      }, obForm, link))
                    }
                </script>
            </div>
        </div>
    </div>
</div>