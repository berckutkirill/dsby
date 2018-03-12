<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Непромерзающие двери для частного дома");
$APPLICATION->SetPageProperty("keywords", "Непромерзающие двери для частного дома");
$APPLICATION->SetPageProperty("title", "Непромерзающие двери для частного дома");
$APPLICATION->SetTitle("1A72F50E-07A4-4989-83D5-2BE9EFE10AA1");
$str_ids = htmlspecialcharsbx($_GET["IDS"]);
?><div class="wrap">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array(), false); ?>
</div>

<div class="haski">
    <div class="c-wrapper">
        <section class="haski-hero">
            <h1 class="haski-hero__title">Непромерзающие двери для частного дома </h1>
            <img class="haski-hero__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-hero.jpg" 
                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-hero.jpg 2x"/>
        </section>
        <section class="haski-trabl">
            <div class="haski-trabl__body">
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", "", Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/haski/problems_doors.php"
                        )
                );
                ?>
            </div>
            <div class="haski-trabl__aside">
                <div class="haski-manager">
                    <img class="haski-manager__photo" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-manager.jpg" 
                         srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-manager.jpg 2x"/>
                    <div class="haski-manager__body">                       
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/haski-manager.php"
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="haski-features">
            <div class="haski-features-block">
                <div class="haski-features__body">
                    <h2 class="haski-features__title c-h2">Особенности конструкции дверей «Хаски» и «Хаски Pro»</h2>
                    <div class="haski-features-item">
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/features-1.php"
                                )
                        );
                        ?>
                    </div>
                    <div class="haski-features-item">
                        <img class="haski-features-item__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-review.jpg" 
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-review.jpg 2x"/>                       
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/features-2.php"
                                     )
                             );
                             ?>
                    </div>
                    <div class="haski-features-item" id="scene1">
                        <img class="haski-features-item__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-thermal-break.jpg"
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-thermal-break.jpg 2x"/>
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/features-3.php"
                                     )
                             );
                             ?>
                    </div>
                    <div class="haski-features-item">
                        <img class="haski-features-item__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-insulation.jpg"
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-insulation.jpg 2x"/>
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/features-4.php"
                                     )
                             );
                             ?>
                    </div>
                    <div class="haski-features-item">
                        <img class="haski-features-item__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-sill.jpg"
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-sill.jpg 2x"/>
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/features-5.php"
                                     )
                             );
                             ?>                         
                    </div>
                </div>          
                <div class="haski-features__aside">
                    <div class="haski-doorsfly">
                        <div class="haski-doorsfly__item">
                            <img class="haski-doorsfly__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-pro.jpg" 
                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-pro.jpg 2x"/>                         
                                 <?
                                 $APPLICATION->IncludeComponent(
                                         "bitrix:main.include", "", Array(
                                     "AREA_FILE_SHOW" => "file",
                                     "AREA_FILE_SUFFIX" => "inc",
                                     "EDIT_TEMPLATE" => "",
                                     "PATH" => "/include/haski/features-door-left.php"
                                         )
                                 );
                                 ?>
                        </div>
                        <div class="haski-doorsfly__item">
                            <img class="haski-doorsfly__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski.jpg" 
                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski.jpg 2x"/>                        
                                 <?
                                 $APPLICATION->IncludeComponent(
                                         "bitrix:main.include", "", Array(
                                     "AREA_FILE_SHOW" => "file",
                                     "AREA_FILE_SUFFIX" => "inc",
                                     "EDIT_TEMPLATE" => "",
                                     "PATH" => "/include/haski/features-door-right.php"
                                         )
                                 );
                                 ?>
                        </div><span class="haski-doorsfly__underline"></span>
                    </div>
                </div>
            </div>
            <div class="haski-features-block">
                <div class="haski-features__fct">               
                    <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/haski/features-40.php"
                            )
                    );
                    ?>                      
                </div>
                <div class="haski-features__main">                    
                    <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/haski/features-main.php"
                            )
                    );
                    ?>
                    <div class="haski-furnit">
                        <div class="haski-furnit__head">                            
                            <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/haski/features-furnitura-title.php"
                                    )
                            );
                            ?>
                        </div>
                        <div class="haski-furnit__main">                           
                            <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/haski/features-furnitura.php"
                                    )
                            );
                            ?>
                            <div class="haski-furnit__item">
                                <div class="haski-furnit__pen">
                                    <img class="haski-furnit__item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-pen1.jpg" 
                                         srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-pen1.jpg 2x"/>
                                         <?
                                         $APPLICATION->IncludeComponent(
                                                 "bitrix:main.include", "", Array(
                                             "AREA_FILE_SHOW" => "file",
                                             "AREA_FILE_SUFFIX" => "inc",
                                             "EDIT_TEMPLATE" => "",
                                             "PATH" => "/include/haski/features-furnitura-1.php"
                                                 )
                                         );
                                         ?>
                                </div>
                                <div class="haski-furnit__pen">
                                    <img class="haski-furnit__item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-pen2.jpg"
                                         srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-pen2.jpg 2x"/>
                                         <?
                                         $APPLICATION->IncludeComponent(
                                                 "bitrix:main.include", "", Array(
                                             "AREA_FILE_SHOW" => "file",
                                             "AREA_FILE_SUFFIX" => "inc",
                                             "EDIT_TEMPLATE" => "",
                                             "PATH" => "/include/haski/features-furnitura-2.php"
                                                 )
                                         );
                                         ?>
                                </div>
                            </div>
                            <div class="haski-furnit__item">
                                <img class="haski-furnit__item-img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-pen3.jpg" 
                                     srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-pen3.jpg 2x"/>
                                     <?
                                     $APPLICATION->IncludeComponent(
                                             "bitrix:main.include", "", Array(
                                         "AREA_FILE_SHOW" => "file",
                                         "AREA_FILE_SUFFIX" => "inc",
                                         "EDIT_TEMPLATE" => "",
                                         "PATH" => "/include/haski/features-furnitura-3.php"
                                             )
                                     );
                                     ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="haski-features-block">
                <div class="haski-features__body">
                    <div class="haski-features-item haski-features-hinge">
                        <div class="haski-features-hinge__fct">                           
                            <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/haski/features-hinge.php"
                                    )
                            );
                            ?>
                        </div>
                        <div class="haski-features-hinge__main">
                            <img class="haski-features-hinge__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-hinge.jpg"
                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-hinge.jpg 2x"/>                          
                                 <?
                                 $APPLICATION->IncludeComponent(
                                         "bitrix:main.include", "", Array(
                                     "AREA_FILE_SHOW" => "file",
                                     "AREA_FILE_SUFFIX" => "inc",
                                     "EDIT_TEMPLATE" => "",
                                     "PATH" => "/include/haski/features-3d.php"
                                         )
                                 );
                                 ?>
                        </div>
                    </div>
                    <div class="haski-features-item haski-features-noise">                       
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/features-noise.php"
                                )
                        );
                        ?>
                    </div>

                    <div class="haski-features-item">
                        <img class="haski-features-item__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-glas.jpg"
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-glas.jpg 2x"/>                    
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/features-glass.php"
                                     )
                             );
                             ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="haski-design">
        <div class="c-wrapper">
            <img class="haski-design__hero" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-design.jpg"
                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-design.jpg 2x"/>
            <div class="haski-design__main">
                <div class="haski-design__body">
                    <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/haski/features-desing.php"
                            )
                    );
                    ?>
                </div>
                <div class="haski-design__aside">
                    <div class="haski-designer">
                        <img class="haski-design__photo" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-designer.png"
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-designer.png 2x"/>                        
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/design__photo.php"
                                     )
                             );
                             ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="haski-indiv">
        <div class="c-wrapper">
            <div class="haski-indiv__main">
                <div class="haski-indiv__content">
                    <div class="haski-indiv__body">
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/haski-consept.php"
                                )
                        );
                        ?>                    
                    </div>
                    <div class="haski-indiv__foot">
                        <a href="/catalog-dverei/stalnaya-liniya/concept_sever.html?offer=3766" class="c-link c-p1 haski-indiv__link">Концепт «Хаски»</a>
                    </div>
                </div>
                <div class="haski-indiv__hero"><img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-indiv.jpg" srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-indiv.jpg 2x" alt=""></div>
            </div>
        </div>
    </section>
    <section class="haski-colors">
        <div class="c-wrapper">
            <div class="haski-colors__main">
                <div class="haski-colors__body">
                    <div class="haski-colors__head">                 
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/haski-colors.php"
                                )
                        );
                        ?>
                    </div>
                    <div class="haski-colors__palette">
                        <div class="haski-palette">
                            <div class="haski-palette__item"><span class="c-p1 haski-palette__title">Lampre</span>
                                <ul class="haski-palette__list">
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img  src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color1.jpg" 
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color1.jpg 2x"/>
                                            </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Дуб тёмный</span></div>
                                    </li>
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img  src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color2.jpg"
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color2.jpg 2x"/>
                                            </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Дуб золотистый</span></div>
                                    </li>
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img  src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color3.jpg" 
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color3.jpg 2x"/>
                                            </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Белый</span></div>
                                    </li>

                                     <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img  src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/grey_hasky.jpg" 
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/grey_hasky.jpg 2x"/>
                                            </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Серый</span></div>
                                    </li>
                                     <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img  src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/darktree_hasky.jpg" 
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/darktree_hasky.jpg 2x"/>
                                            </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Тёмное дерево</span></div>
                                    </li>
                                </ul>
                            </div>
                            <div class="haski-palette__item"><span class="c-p1 haski-palette__title">Муар</span>
                                <ul class="haski-palette__list">
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color4.jpg"
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color4.jpg 2x"/>
                                             </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Антрацит</span></div>
                                    </li>
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color5.jpg" 
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color5.jpg 2x"/>
                                             </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Слоновая кость</span></div>
                                    </li>
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color6.jpg"
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color6.jpg 2x"/>
                                             </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Белый</span></div>
                                    </li>
                                    <li class="haski-palette__color">
                                        <div class="haski-color">
                                            <div class="haski-color__img">
                                                <img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-color7.jpg" 
                                                 srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-color7.jpg 2x"/>
                                             </div>
                                            <span class="haski-color__title c-p3 c-p3--small">Коричневый</span></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="haski-colors__aside">
                    <img class="haski-colors__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-colors.png"
                         srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-colors.png 2x"/>
                    <p class="c-p3 c-p3--small">Коробка и полотно могут окрашиваться в 2 цвета</p>
                </div>
            </div>
        </div>
    </section>
    <section class="haski-sizes">
        <div class="c-wrapper">
            <div class="haski-sizes__main">
                <div class="haski-sizes__body">
                    <h3 class="haski-sizes__title c-h4">Размерный ряд</h3>
                    <svg class="svg-haski-sizes">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/haski/sprite.svg#haski-sizes"></use>
                    </svg>
                </div>
                <div class="haski-sizes__aside">
                    <div>                   
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/haski-sizes__aside.php"
                                )
                        );
                        ?>
                    </div>
                    <div>
                        <img class="haski-sizes__img" src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-sample.png"
                             srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-sample.png 2x"/>                     
                             <?
                             $APPLICATION->IncludeComponent(
                                     "bitrix:main.include", "", Array(
                                 "AREA_FILE_SHOW" => "file",
                                 "AREA_FILE_SUFFIX" => "inc",
                                 "EDIT_TEMPLATE" => "",
                                 "PATH" => "/include/haski/haski-sizer.php"
                                     )
                             );
                             ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="haski-dobor">
        <div class="c-wrapper">
            <div class="haski-dobor__main">
                <div class="haski-dobor__content">
                    <div class="haski-dobor__body">
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/haski-pro-consept.php"
                                )
                        );
                        ?>   
                    </div>
                    <div class="haski-dobor__foot">
                        <a href="/poleznaya-informaciya/vot_eto_masshtab_novoe_kontseptualnoe_reshenie_dlya_doma_.html" class="c-link c-p1 haski-dobor__link">Подробнее о новом концепте</a>
                    </div>
                </div>
                <div class="haski-dobor__hero"><img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-dobor.png" srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-dobor.png 2x" alt=""></div>
            </div>
        </div>
    </section>
    <div class="c-wrapper">
        <section class="haski-install">
            <div class="haski-install__main">
                <div class="haski-install__body">
                    <?
                    $APPLICATION->IncludeComponent(
                            "bitrix:main.include", "", Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/haski/haski-install.php"
                            )
                    );
                    ?>
                </div>
                <div class="haski-install__aside">
                    <div class="haski-install-type">
                        <div class="haski-install-type__main">
                            <div class="haski-install-type__item">
                                <svg class="haski-install-type__chema svg-haski-inst1">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/haski/sprite.svg#haski-inst2"></use>
                                </svg><span class="c-p3 c-p3--small">С улицы в тамбур</span>
                            </div>
                            <div class="haski-install-type__item">
                                <svg class="haski-install-type__chema svg-haski-inst2">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/svg/haski/sprite.svg#haski-inst1"></use>
                                </svg><span class="c-p3 c-p3--small">Без тамбура</span>
                            </div>
                        </div>                       
                        <?
                        $APPLICATION->IncludeComponent(
                                "bitrix:main.include", "", Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/haski/haski-install-type.php"
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="haski-install__foot">
                <p class="c-p3 c-p3--small"><span class="bold">Александр,</span> мастер по установке</p>
            </div>
        </section>
        <section class="haski-causes">
            <div class="haski-causes__body">
                <?
                $APPLICATION->IncludeComponent(
                        "bitrix:main.include", "", Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/include/haski/haski-why.php"
                        )
                );
                ?>            
            </div>
            <div class="haski-causes__aside">
                <div class="haski-causes__fct"><span class="haski-causes__fct-title">2</span>
                    <p class="haski-causes__fct-desc c-p3 c-p3--small">года полной гарантии</p>
                </div>
            </div>
        </section>     
        <section class="haski-finish">            
            <?
            $APPLICATION->IncludeComponent(
                    "bitrix:main.include", "", Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/haski/haski-footer-title.php"
                    )
            );
            ?>  
            <?
            $conformity = [3743 => "HASKIPRO", 2170 => "HASKI", 3746 => "HASKIPRO", 2169 => "HASKI", 2154 => "HASKIB", 2155 => "HASKIB",
                4249 => "HASKIPROB", 4248 => "HASKIPROB"];

            if (CModule::IncludeModule("catalog")) {
                $arFilter = Array("IBLOCK_ID" => 22, "ACTIVE" => "Y", "ID" => [3743, 2170, 2155, 4248]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array("ID", "NAME", "DETAIL_PAGE_URL", "IBLOCK_ID"));
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                   $pro = $conformity[$arFields["ID"]];
                    $result[$pro] = $arFields;
                    $ids[] = $arFields["ID"];
                }

                $arFilter = Array("IBLOCK_ID" => 21, "ACTIVE" => "Y", "ID" => [3746, 2169, 2154, 4249]);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, array("ID", "NAME", "IBLOCK_ID"));
                while ($ob = $res->GetNextElement()) {
                    $arFields = $ob->GetFields();
                    $pro = $conformity[$arFields["ID"]];
                    $price = getPriceWithDiscount($arFields["ID"]);
                    $result[$pro]["PRICE"] = number_format($price["DISCOUNT_PRICE"], 0, "", "");
                    $result[$pro]["OFFER_ID"] = $arFields["ID"];
                }
            }
            ?>    
            <div class="haski-finish__main">
                <div class="haski-finish__item">
                    <a class="haski-link c-link-block" href="<?= $result["HASKIPRO"]["DETAIL_PAGE_URL"] ?>?offer=<?= $result["HASKIPRO"]["OFFER_ID"]?>">
                        <div class="haski-link__head c-link">
                            <span class="haski-link__title">«<?= trim($result["HASKIPRO"]["NAME"]) ?>»</span>
                            <? if ($result["HASKIPRO"]["PRICE"]) { ?>
                                <span class="haski-link__price"><?= $result["HASKIPRO"]["PRICE"] ?> руб.</span>
                            <? } ?>
                        </div>
                        <div>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-doorspro.jpg" srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-doorspro.jpg 2x"/>
                        </div>
                    </a>
                </div>
                <div class="haski-finish__item">
                    <a class="haski-link c-link-block" href="<?= $result["HASKI"]["DETAIL_PAGE_URL"] ?>?offer=<?= $result["HASKI"]["OFFER_ID"]?>">
                        <div class="haski-link__head c-link">
                            <span class="haski-link__title">«<?= trim($result["HASKI"]["NAME"]) ?>»</span>
                            <? if ($result["HASKI"]["PRICE"]) { ?>
                                <span class="haski-link__price"><?= $result["HASKI"]["PRICE"] ?> руб.</span>
                            <? } ?>
                        </div>
                        <div><img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-doors.jpg" srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-doors.jpg 2x"/>
                        </div>
                    </a>
                </div>
            </div>
            <div class="haski-finish__main">
                <div class="haski-finish__item">
                    <a class="haski-link c-link-block" href="<?= $result["HASKIPROB"]["DETAIL_PAGE_URL"] ?>?offer=<?= $result["HASKIPROB"]["OFFER_ID"]?>">
                        <div class="haski-link__head c-link">
                            <span class="haski-link__title">«<?= trim($result["HASKIPROB"]["NAME"]) ?>»</span>
                            <? if ($result["HASKIPROB"]["PRICE"]) { ?>
                                <span class="haski-link__price"><?= $result["HASKIPROB"]["PRICE"] ?> руб.</span>
                            <? } ?>
                        </div>
                        <div>
                            <img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-doorspro_2.png" srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-doorspro_2.png 2x"/>
                        </div>
                    </a>
                </div>
                <div class="haski-finish__item">
                    <a class="haski-link c-link-block" href="<?= $result["HASKIB"]["DETAIL_PAGE_URL"] ?>?offer=<?= $result["HASKIB"]["OFFER_ID"]?>">
                        <div class="haski-link__head c-link">
                            <span class="haski-link__title">«<?= trim($result["HASKIB"]["NAME"]) ?>»</span>
                            <? if ($result["HASKIB"]["PRICE"]) { ?>
                                <span class="haski-link__price"><?= $result["HASKIB"]["PRICE"] ?> руб.</span>
                            <? } ?>
                        </div>
                        <div><img src="<?= SITE_TEMPLATE_PATH ?>/img/haski/1x/haski-doors_2.png" srcset="<?= SITE_TEMPLATE_PATH ?>/img/haski/2x/haski-doors_2.png 2x"/>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>