<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
$q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if (strlen($INPUT_ID) <= 0)
    $INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if (strlen($CONTAINER_ID) <= 0)
    $CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if ($arParams["SHOW_INPUT"] !== "N"):
    ?>

    <div class="c-search"  id="<? echo $CONTAINER_ID ?>">
        <form class="c-search__form" name="search" action="<? echo $arResult["FORM_ACTION"] ?>">
            <div class="c-search__form-left">
                <p class="c-search__form-title">Поиск входной двери</p>
                <p class="c-search__form-caption">по названию</p>
            </div>
            <div class="c-search__form-body">
                <div class="c-search__form-field">
                    <input class="c-search__form-input" id="<? echo $INPUT_ID ?>" name="q" autofocus type="text" data-value="<? echo $q ?>"/>
                    <label class="c-search__form-clear" for="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                            <path stroke="#dae5eb" fill="#dae5eb" fill-rule="nonzero" stroke-width="0.6" d="M20.225 1.724l-.8-.8-9.2 9.2-9.2-9.2-.8.8 9.2 9.2-9.2 9.2.8.8 9.2-9.2 9.2 9.2.8-.8-9.2-9.2z"></path>
                        </svg>
                    </label>
                </div>
            </div>
            <div class="c-search__form-right">
                <span class="c-search__form-status" id="search-null">Двери нет в каталоге</span>
                <span class="c-search__form-loader" id="search-loader"></span>
            </div>
        </form>
        <div class="c-search__result" id="search-res"></div>
    </div>


<? endif ?>
<script src="/bitrix/templates/steelline/script/mustache.js"></script>
<script src="/bitrix/templates/steelline/script/blured.js"></script>
<script>

    BX.ready(function () {
        new JCTitleSearch({
            'AJAX_PAGE': '<? echo CUtil::JSEscape(POST_FORM_ACTION_URI) ?>',
            'CONTAINER_ID': '<? echo $CONTAINER_ID ?>',
            'INPUT_ID': '<? echo $INPUT_ID ?>',
            'MIN_QUERY_LEN': 2
        });
    });

</script>
<script>
    (function () {
        var search = document.querySelector('.c-header__search'),
            input  = document.querySelector('.c-search__form-input'),
            clear  = document.querySelector('.c-search__form-clear'),
            res    = document.querySelector('.c-search__result');

        // if (window.Event) {
        //     var event  = new Event("click", {bubbles : true, cancelable : true});
        //     input.dispatchEvent(event);
        // }

        if (input.getAttribute('data-value') || input.value.length !== 0) clear.style.display = 'block';

        $(document).ready(function() {
            $(input).trigger('focus');

            // $(input).trigger('touchstart');
        })
        
        search.addEventListener('click', function () {
            if (document.referrer.length > 0) window.location = document.referrer;
            else window.location = 'http://bitrix-cat.by';
        });

        input.addEventListener('input', function() {
            if (this.value.length > 0) clear.style.display = 'block';
            if (this.value.length === 0) clear.style.display = 'none';
        })

        clear.addEventListener('click', function () {
            input.value = '';
            input.focus();

            this.style.display = 'none';

            if (res.firstChild) res.firstChild.style.display = 'none';
        })

        
    })();
</script>
