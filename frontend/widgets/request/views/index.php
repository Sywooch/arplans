<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.10.2018
 * Time: 11:27
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \frontend\widgets\request\Request */
?>
    <div class="modal" data-modal="consultation">
        <div class="bg close"></div>
        <div class="modal-box">
            <span class="close">&times;</span>
            <h3 class="modal-title">Мы очень быстро свяжемся с вами</h3>
            <div class="modal-form consultation-form">
                <div id="senden-cons"></div>
                <? $form = ActiveForm::begin([
                    'action'  => '#',
                    'method'  => 'post',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'id'      => 'consultation-form',
                ]); ?>
                <?= Html::hiddenInput('Request[url]', Yii::$app->request->getAbsoluteUrl()) ?>
                <?= Html::hiddenInput('Request[type]', \common\models\Request::PAGE_OTHER) ?>
                <?= Html::hiddenInput('Request[email]', null) ?>
                <?= Html::hiddenInput('Request[name]', '-') ?>
                <?= Html::hiddenInput('Request[phone]', '-') ?>
                <div class="modal-form--fields">
                    <div class="custom-form">
                        <div class="form-row-element">
                            <div class="input">
                                <?= Html::activeTextInput($model, 'contact', ['placeholder' => '*Ваш телефон, e-mail или любой другой контакт']) ?>
                            </div>
                        </div>
                        <div class="form-row-element">
                            <div class="textarea">
                                <?= Html::activeTextarea($model, 'text', ['placeholder' => '*Ваше сообщение', 'rows' => 3]) ?>
                            </div>
                        </div>
                        <div class="form-row-element">
                            <div class="file">
                                <?= Html::activeFileInput($model, 'file', ['id' => 'supportFileUpload']) ?>
                                <label for="supportFileUpload">
                                    <i class="icon-loadFile">
                                        <svg xmlns="http://www.w3.org/2000/svg">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 xlink:href="#icon-file-change"/>
                                        </svg>
                                    </i>
                                    <span id="supportFileName" data-default="Прикрепить файл">Прикрепить файл</span>
                                </label>
                                <i id="supportFileRemove" class="remove hide">&times;</i>
                            </div>
                        </div>
                    </div>
                    <div class="filter-form">
                        <div class="form-row-element">
                            <div class="check">
                                <label>
                                    <input type="checkbox" name="Request[accept]">
                                    <span>Согласен на <a href="/page/privacy">обработку персональных данных</a></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-form--submit">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn--lt submit-consult']) ?>
                </div>
                <? ActiveForm::end() ?>
            </div>
            <div class="modal-thanks">
                <h4 class="modal-thanks--title">Спасибо!</h4>
                <p>Ваше сообщение успешно отправлено, мы свяжемся с Вами в ближайшее время! </p>
            </div>
        </div>
    </div>
<?php
$js = <<<JS
    $('#consultation-form').validate({
        onfocusout: false,
        ignore: ".ignore",
        rules: {
            'Request[contact]': {required: true},
            'Request[text]': {required: true},
            'Request[accept]': {required: true}
        },
        messages: {
           'Request[contact]': {required: ""},
           'Request[text]': {required: ""},
           'Request[accept]': {required: ""}
        },
        errorClass: 'invalid',
        highlight: function(element, errorClass) {
            $(element).closest('.form-row-element').addClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).closest('.form-row-element').removeClass(errorClass)
        },
        errorPlacement: $.noop,
        submitHandler:function (form) {
            if(!$('#senden-cons').hasClass('senden')){
                $('#senden-cons').addClass('senden');
                var data = $('#consultation-form');
                formData = new FormData(data.get(0));
                $.ajax({
                contentType: false, 
                processData: false,
                url: '/site/request',
                type: 'POST',
                data: formData,
                success: function(res){
                  if(res.status==='success'){
                       $('[data-modal="consultation"]').addClass('successful');
                       $('#senden-cons').removeClass('senden');
                  }
                },
            
          });
                }
        }
     });
JS;

$this->registerJs($js);