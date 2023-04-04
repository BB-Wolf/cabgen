<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <title>Кабель-генератор</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

          <script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>
        <link rel="preload" href="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.css" as="style">

        <style>
            #my-loader
            {
            width:100%;
            height:100%;
            position:fixed;
            top:0;
            background:black;
                z-index: 3;
            }

            #my-loader img
            {
                display: table-cell;
                height: 300px;
                text-align: center;
                width: 300px;
                vertical-align: middle;
                margin: 30vh auto;

            }
        </style>
        <script>
            var ldld = new ldLoader({ root: "#my-loader" });
            /* 4. active this loader */
            ldld.on();
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
             setTimeout(function(){ document.getElementById('my-loader').remove();},1000);
            });
        </script>
    </head>
    <body>
    <div id="my-loader" class="loader">
        <img src="Infinity-1s-200px (1).svg">
    </div>
<div class="container">
    <div class="row" style="margin-top:20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-title text-center">Bleed release</div>
                <div class="card-text text-center">Отладочный релиз. Может и будет содержать ошибки и текущие доработки. Предназначен для разработки.</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12 col-xl-12" style="margin-top:20px;">
                <div class="btn btn-info"><a  style="color:white;" href="/bleed">Bleeding release</a></div>
                <div class="btn btn-info"><a  style="color:white;" href="/preview.html">Предпросмотр моделей</a></div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-title text-center">Latest release</div>
                <div class="card-text text-center">Последний стабильный релиз. Включает в себя доработки из  минорного релиза</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12 col-xl-12" style="margin-top:20px;">
                <? $latestFiles = array_diff(scandir('/home/bitrix/ext_www/cablegen.sianlab.site/latest'),array("..",'.'));
                asort($latestFiles,SORT_NATURAL);
                foreach ($latestFiles as $key=>$folder)
                {
                    ?>
                    <div class="btn btn-info"><a  style="color:white;" href="/latest/<?=$folder;?>"><?=$folder;?></a></div>
                    <?
                }
                ?></div>
        </div>
    </div>

    <div class="row" style="margin-top:20px;">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-title text-center">Minor release</div>
                <div class="card-text text-center">Минорный релиз. Содержит небольшие доработки и изменения в коде.</div>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-12 col-xl-12" style="margin-top:20px;">
                <? $latestFiles = array_diff(scandir('/home/bitrix/ext_www/cablegen.sianlab.site/minor'),array("..",'.'));
                asort($latestFiles,SORT_NATURAL);
                foreach ($latestFiles as $key=>$folder)
                {
                    ?>
                    <div class="btn btn-info"><a  style="color:white;" href="/minor/<?=$folder;?>"><?=$folder;?></a></div>
                    <?
                }
                ?></div>
        </div>
    </div>

    <style>.card-text li span {font-weight: bold;}</style>
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                    <div class="card-title text-center">Доступные параметры</div>
                    <div class="card-text">
                        <ul>
                            <li><span>getTotalElems</span> - количество жил 7,9,12,19. По-умолчанию 19</li>
                            <li><span>innerElemsRadius</span> - диаметр жил</li>
                            <li><span>secondBody</span> - Наличие доп. оболочки. secondBody=1 или отсутствует параметр</li>
                            <li><span>noAddHelix </span> - Наличие доп. пленки. noAddHelix=1 или отсутствует параметр</li>
                            <li><span>bodyMaterial </span> - Материал оболочки кабеля</li>
                            <li><span>needFXAA </span> - Быстрый алгоритм сглаживания. 0 - отключен. 1 - включен.  По-умолчанию отключен</li>
                            <li><span>pipeLineSamples </span> - Количество проходов сглаживания. Значения: 1,2,4,8 - по-умолчанию - 1 </li>
                            <li><span>lightShadows </span> - Простые тени. По-умолчанию отключены. lightShadows=1 или отсутствует параметр. </li>
                            <li><span>fullShadows </span> - Каскадные тени. По-умолчанию отключены. fullShadows=1 или отсутствует параметр. </li>
                            <li><span>cameraLowestRadius  </span> Ограничение максимального зума камеры. </li>
                            <li><span>noBump  </span> отключает подгрузку рельефа, предпросчитанных световых карт. </li>
                            <li><span>noHDR  </span> Отключить карту освещенности. </li>
                        </ul>

                    </div>
            </div>
            <div class="card">
                <div class="card-title text-center">Доступные материалы</div>
                    <div class="card-text">
                        <ul>
                            <li><span>blackPBRTextured</span> - черная текстура внешней оболочки. Резина. <a  target="_blank" href="mat_preview.html?objMat=blackPBRTextured">Тестирование</a></li>
                            <li><span>blackLightPBRTextured</span> - Резина тёмно-серая <a target="_blank" href="mat_preview.html?objMat=blackLightPBRTextured">Тестирование</a></li>
                            <li><span>rubberPBRTextured</span> -Полиуретановая оболочка <a target="_blank" href="mat_preview.html?objMat=rubberPBRTextured">Тестирование</a></li>
                            <li><span>rubberPBRTexturedMain</span> - Полиуретан <a target="_blank" href="mat_preview.html?objMat=rubberPBRTexturedMain,">Тестирование</a></li>
                            <li><span>nullLinePBRTextured</span> - оболочка жилы, ноль <a  target="_blank" href="mat_preview.html?objMat=nullLinePBRTextured">Тестирование</a></li>
                            <li><span>plusLinePBRTextured</span> - оболочка жилы, плюсовая <a target="_blank"  href="mat_preview.html?objMat=plusLinePBRTextured">Тестирование</a></li>
                            <li><span>pvhPBRTextured</span> - Поливинилхлорид. светло-серый <a target="_blank"  href="mat_preview.html?objMat=pvhPBRTextured">Тестирование</a></li>
                            <li><span>alumPBRTextured</span> - Алюминий.<a target="_blank"  href="mat_preview.html?objMat=alumPBRTextured">Тестирование</a></li>
                            <li><span>alumLightPBRTextured</span> - Алюминий светлый <a  target="_blank" href="mat_preview.html?objMat=alumLightPBRTextured">Тестирование</a></li>
                            <li><span>copperPBRTextured</span> - медь <a target="_blank"  href="mat_preview.html?objMat=copperPBRTextured">Тестирование</a></li>
                            <li><span>copperLightPBRTextured</span> - медь светлая <a  target="_blank" href="mat_preview.html?objMat=copperLightPBRTextured">Тестирование</a></li>
                            <li><span>plenkaPBRTextured</span> - прозрачная пленка. <a target="_blank"  href="mat_preview.html?objMat=plenkaPBRTextured">Тестирование</a> </li>
                            <li><span>copperPBRNew</span> - медь фактурная <a target="_blank"  href="mat_preview.html?objMat=copperPBRNew">Тестирование</a></li>
                            <li><span>plasticPBRGrey</span> -  текстура оболочки жил серая <a target="_blank"  href="mat_preview.html?objMat=plasticPBRGrey">Тестирование</a></li>
                            <li><span>plasticPBRBlue</span> -  текстура оболочки жил синяя. Плюсовая <a  target="_blank" href="mat_preview.html?objMat=plasticPBRBlue">Тестирование</a></li>
                            <li><span>plasticPBRBlack</span> -  текстура оболочки жил черная <a  target="_blank" href="mat_preview.html?objMat=plasticPBRBlack">Тестирование</a></li>
                            <li><span>plasticPBRGround</span>-   текстура оболочки жил заземления <a  target="_blank" href="mat_preview.html?objMat=plasticPBRGround">Тестирование</a></li>
                            <li><span>plasticPBRPink</span>- -  текстура оболочки жил розовая <a  target="_blank" href="mat_preview.html?objMat=plasticPBRPink">Тестирование</a></li>
                            <li><span>plasticPBRLightBlue</span> - светло-синяя <a target="_blank"  href="mat_preview.html?objMat=plasticPBRLightBlue">Тестирование</a></li>
                            <li><span>ropePBR</span> - текстура каната <a  target="_blank"  href="mat_preview.html?objMat=ropePBR">Тестирование</a></li>
                        </ul>

                    </div>
            </div>

            <div class="card">
                <div class="card-title text-center">Примеры интеграций</div>
                <div class="card-text">
                    <ul>
                        <li><a href="example1.html">Вариант 1. Иконка под изрбанным</a></li>
                        <li><a href="example2.html">Вариант 2. Иконка под избранным. Модалка.</a></li>
                        <li><a href="example3.html">Вариант 3. Вкладка 3д модель</a></li>
                        <li><a href="example4.html">Вариант 4. Изображение, есть 3д модель. Модалка</a></li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
    
</div>
    </body>
</html>