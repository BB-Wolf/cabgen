`<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
    <title>Кабель-генератор</title>
    <!--- Link to the last version of BabylonJS --->
      <script src="https://cdn.babylonjs.com/babylon.js"></script>
      <script src="https://cdn.babylonjs.com/loaders/babylonjs.loaders.min.js"></script>
      <script src="https://cdn.babylonjs.com/gui/babylon.gui.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>
    <link rel="preload" href="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.css" as="style">

    <script src="../../js/ammo.js"></script>

    <style>
        html, body {
            overflow: hidden;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #renderCanvas {
            width: 100%;
            height: 100%;
            touch-action: none;
        }
        #my-loader
        {
            width:100%;
            height:100%;
            position:fixed;
            top:0;
            background:black;
            display: none;
        }

        #my-loader img
        {
            display: table-cell;
            height: 300px;
            text-align: center;
            width: 300px;
            vertical-align: middle;
            margin: 0 auto;
        }
        #fps {
            position: absolute;
            background-color: black;
            border: 2px solid red;
            text-align: center;
            font-size: 16px;
            color: white;
            top: 15px;
            right: 10px;
            width: 60px;
            height: 20px;
        }

    </style>
    <script>
        var ldld = new ldLoader({ root: "#my-loader" });
        /* 4. active this loader */
        ldld.on();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function(){ document.getElementById('my-loader').remove();},7000);
        });
    </script>
</head>
<body>
<div id="my-loader" class="loader">
    <img src="http://cablegen.sianlab.site/Infinity-1s-200px (1).svg">
</div>
<div id="fps">0</div>
<div id="info" style="position: absolute; width:auto;top:5vh; left:45%; height:auto; padding: 20px; display: none; background-color: #336699; border-color: #336699;    color: #ffffff;"></div>
<canvas id="renderCanvas"></canvas>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        let divFps = document.getElementById("fps");
        function isEven(n) {
            return n % 2 == 0;
        }

        function getUriParam(name, url) {
            if (!url)
                url = window.location.href;
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'), results = regex.exec(url);
            if (!results)
                return false;
            if (!results[2])
                return false;
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }


        function getRealCut(paramCut)
        {
            return paramCut*100;
        }

        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min)) + min; //Максимум не включается, минимум включается
        }

        var parseUri = function(vl,alias)
        {
            vlOld = vl;
            if(typeof alias == 'undefined' && alias!='') {
                if (getUriParam(vl, location.href)) {
                    vl = eval(getUriParam(vl, location.href));
                    return vl;
                } else {
                    vl = eval(vlOld);
                    return vl;
                }
            }else {
                if (getUriParam(alias, location.href)) {
                    vl = eval(getUriParam(alias, location.href));
                    return vl;
                } else {
                    vl = eval(vlOld);
                    return vl;
                }
            }
        }

        function compareCircles(mainCircle,arrayOfCircles)
        {
            //   if(mainCircle=='' || typeof  mainCircle=== 'undefined') { return  false; }
            if(arrayOfCircles==='') {  return false;}
            var totalCirclesLength = 0;
            var mainCirlceLength = 2*Math.PI * mainCircle;
            for(var i=0; i<arrayOfCircles.length; i++)
            {
                totalCirclesLength = totalCirclesLength + (2*Math.PI * arrayOfCircles[i].diameter);
            }

            if(totalCirclesLength*0.7 > mainCirlceLength)
            {
                return false;
            }else
            {
                return true;
            }

        }


        var canvas = document.getElementById('renderCanvas');
        if(location.href.indexOf('doScreen')==-1) {
            var engine = new BABYLON.Engine(canvas, true);
        }else {
            var engine = new BABYLON.Engine(canvas, true, { preserveDrawingBuffer: true, stencil: true });
        }

        // createScene function that creates and return the scene
        var cv=0;
        var delayCreateScene = function() {
            // Create a scene.
            var scene = new BABYLON.Scene(engine);
            //	scene.enablePhysics();
            var highLight;
            var prevHighLight;
            //    scene.autoClear = false; // Color buffer
            //  scene.autoClearDepthAndStencil = false; // Depth and stencil, obviously



            var nullLinePBRTextured = new BABYLON.PBRMaterial("nullLinePBRTextured", scene);
            nullLinePBRTextured.albedoColor = new BABYLON.Color3(0.824, 0.412, 0.118);
            nullLinePBRTextured.reflectivityColor = new BABYLON.Color3(1.9, 1.9, 1.9);
            nullLinePBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png",scene);
            nullLinePBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_roughness.png", scene);
            nullLinePBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            nullLinePBRTextured.bumpTexture.level = 0.3;
            nullLinePBRTextured.metallic = 0.3;
            nullLinePBRTextured.roughness = 0.7;
            nullLinePBRTextured.sheen.isEnabled = true;
            nullLinePBRTextured.sheen.intensity = 0.1;


            var plusLinePBRTextured = new BABYLON.PBRMaterial("plusLinePBRTextured", scene);
            plusLinePBRTextured.albedoColor = new BABYLON.Color3(0.05, 0.05,1);
            plusLinePBRTextured.reflectivityColor = new BABYLON.Color3(1.9, 1.9, 1.9);
            plusLinePBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png",scene);
            plusLinePBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_roughness.png", scene);
            plusLinePBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            plusLinePBRTextured.bumpTexture.level = 0.5;
            plusLinePBRTextured.metallic = 0.1;
            plusLinePBRTextured.roughness = 0.6;
            plusLinePBRTextured.anisotropy.isEnabled = true;
            plusLinePBRTextured.anisotropy.intensity = 0.8;
            plusLinePBRTextured.enableSpecularAntiAliasing = true;
            plusLinePBRTextured.sheen.isEnabled = true;
            plusLinePBRTextured.sheen.intensity = 0.3;


            var groundLinePBRTextured = new BABYLON.PBRMaterial("groundLinePBRTextured", scene);
            groundLinePBRTextured.albedoColor = new BABYLON.Color3(0.05, 0.05,2);
            groundLinePBRTextured.reflectivityColor = new BABYLON.Color3(1.9, 1.9, 1.9);
            groundLinePBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png",scene);
            groundLinePBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_roughness.png", scene);
            groundLinePBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            groundLinePBRTextured.bumpTexture.level = 0.2;
            groundLinePBRTextured.metallic = 0.1;
            groundLinePBRTextured.roughness = 0.6;
            groundLinePBRTextured.sheen.isEnabled = true;
            groundLinePBRTextured.sheen.intensity = 0.3;


            var pvhPBRTextured = new BABYLON.PBRMaterial("pvhPBRTextured",scene);
            pvhPBRTextured.albedoColor = new BABYLON.Color3(1.0,1.0,1.0);
            pvhPBRTextured.reflectivityColor = new BABYLON.Color3(1.9, 1.9, 1.9);
            pvhPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png",scene);
            pvhPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_roughness.png", scene);
            pvhPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            pvhPBRTextured.bumpTexture.level = 0.2;
            pvhPBRTextured.metallic = 1.3;
            pvhPBRTextured.roughness = 0.8;


            var alumPBRTextured = new BABYLON.PBRMaterial('alumPBRTextured',scene);
            alumPBRTextured.albedoColor = new BABYLON.Color3(0.25,0.25,0.25);
            alumPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            alumPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png", scene);
            alumPBRTextured.microSurface = 1;
            alumPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            alumPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            alumPBRTextured.bumpTexture.level = 0.5;
            alumPBRTextured.anisotropy.isEnabled = true;
            alumPBRTextured.anisotropy.intensity = 0.6;
            alumPBRTextured.enableSpecularAntiAliasing = true;
            alumPBRTextured.metallic = 0.9;
            alumPBRTextured.roughness = 0.6;


            var alumLightPBRTextured = new BABYLON.PBRMaterial('alumLightPBRTextured',scene);
            alumLightPBRTextured.albedoColor = new BABYLON.Color3(0.8,0.8,0.8);
            alumLightPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            alumLightPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png", scene);
            alumLightPBRTextured.microSurface = 1;
            alumLightPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            alumLightPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            alumLightPBRTextured.bumpTexture.level = 0.22;
            alumLightPBRTextured.anisotropy.isEnabled = true;
            alumLightPBRTextured.anisotropy.intensity = 0.7;
            alumLightPBRTextured.enableSpecularAntiAliasing = true;
            alumLightPBRTextured.metallic = 0.6;
            alumLightPBRTextured.roughness = 0.26;

            var copperPBR = new BABYLON.PBRMetallicRoughnessMaterial("copperPBR", scene);
            copperPBR.baseTexture = new BABYLON.Texture("../../copper_new.jpg", scene);//copperPBR.albedoTexture = new BABYLON.Texture("./copper_new.jpg", scene);
            copperPBR.reflectivityTexture = new BABYLON.Texture("../../copper_new_spec.png", scene);
            copperPBR.reflectivityColor = new BABYLON.Color3(1.0, 0.766, 0.736);
            copperPBR.metallic = 3.0;
            copperPBR.roughness = .5;
            copperPBR.reflectivityTexture.wAng = 80;
            copperPBR.forceIrradianceInFragment = true;
            copperPBR.bumpTexture = new BABYLON.Texture("../../copper_new_bmp.png", scene);
            copperPBR.bumpTexture.vAng = 80;
            copperPBR.bumpTexture.wAng = 100;
            copperPBR.bumpTexture.level =3;
            copperPBR.microSurfaceTexture =  new BABYLON.Texture("../../copper_new_bmp.png", scene);

            var blackPBRTextured = new BABYLON.PBRMaterial("blackPBRTextured", scene);
            blackPBRTextured.albedoColor = new BABYLON.Color3(0, 0,0);
            blackPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            blackPBRTextured.bumpTexture.level = 0.3;
            blackPBRTextured.microSurface = 1;
            blackPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            blackPBRTextured.metallic = 0.16;
            blackPBRTextured.roughness = 0.42;
            blackPBRTextured.enableSpecularAntiAliasing = true;
            blackPBRTextured.environmentIntensity = 0.64;
            blackPBRTextured.sheen.isEnabled = true;
            blackPBRTextured.sheen.intensity = 0.13;
            blackPBRTextured.directIntensity = 0.56;
            blackPBRTextured.specularIntensity = 0.536;

            var blackLightPBRTextured = new BABYLON.PBRMaterial("blackLightPBRTextured", scene);
            blackLightPBRTextured.albedoColor = new BABYLON.Color3(0.007, 0.007,0.007);
            blackLightPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            blackLightPBRTextured.bumpTexture.level = 0.8;
            blackLightPBRTextured.microSurface = 1;
            blackLightPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            blackLightPBRTextured.metallic = 0.1;
            blackLightPBRTextured.roughness = 0.7;
            blackLightPBRTextured.sheen.isEnabled = true;
            blackLightPBRTextured.sheen.intensity = 0.2;
            blackLightPBRTextured.anisotropy.isEnabled = true;
            blackLightPBRTextured.anisotropy.intensity = 0.6;
            blackLightPBRTextured.enableSpecularAntiAliasing = true;


            var blackLightPBRTexturedHelix = new BABYLON.PBRMaterial("blackLightPBRTexturedHelix", scene);
            blackLightPBRTexturedHelix.albedoColor = new BABYLON.Color3(0.007, 0.007,0.007);
            blackLightPBRTexturedHelix.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            blackLightPBRTexturedHelix.bumpTexture.level = 0.8;
            blackLightPBRTexturedHelix.microSurface = 1;
            blackLightPBRTexturedHelix.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            blackLightPBRTexturedHelix.metallic = 0.1;
            blackLightPBRTexturedHelix.roughness = 0.7;
            blackLightPBRTexturedHelix.sheen.isEnabled = true;
            blackLightPBRTexturedHelix.sheen.intensity = 0.2;
            blackLightPBRTexturedHelix.enableSpecularAntiAliasing = true;


            var copperPBRTextured = new BABYLON.PBRMaterial("copperPBRTextured", scene);
            copperPBRTextured.albedoTexture = new BABYLON.Texture("../../copper_new.jpg", scene);
            copperPBRTextured.albedoColor = new BABYLON.Color3(0.808,0.714,0.514);
            copperPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            copperPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png", scene);
            copperPBRTextured.microSurface = 1;
            copperPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            copperPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            copperPBRTextured.bumpTexture.level = 0.8;
            copperPBRTextured.metallic = 0.58;
            copperPBRTextured.roughness = 0.43;
            copperPBRTextured.sheen.isEnabled = true;
            copperPBRTextured.sheen.intensity = 0.62;
            copperPBRTextured.sheen.linkSheenWithAlbedo = true;
           copperPBRTextured.anisotropy.isEnabled = false;
            copperPBRTextured.anisotropy.intensity = 0.08;
            copperPBRTextured.enableSpecularAntiAliasing = true;
            copperPBRTextured.clearCoat.isEnabled = true;
            copperPBRTextured.clearCoat.intensity = 0.34;
            copperPBRTextured.clearCoat.roughness = 0.05;
            copperPBRTextured.clearCoat.indexOfRefraction=1.01;
            copperPBRTextured.metallicF0Factor = 1;

            var copperLightPBRTextured = new BABYLON.PBRMaterial("copperLightPBRTextured", scene);
            copperLightPBRTextured.albedoTexture = new BABYLON.Texture("../../copper_new.jpg", scene);
            copperLightPBRTextured.albedoColor = new BABYLON.Color3(0.7,0.7,0.7);
            copperLightPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            copperLightPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png", scene);
            copperLightPBRTextured.microSurface = 1;
            copperLightPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            copperLightPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            copperLightPBRTextured.bumpTexture.level = 0.2;
            copperLightPBRTextured.enableSpecularAntiAliasing = true;
            copperLightPBRTextured.metallic = 0.5;
            copperLightPBRTextured.roughness = 0.35;

            var plenkaPBRTextured = new BABYLON.PBRMaterial("plenkaPBRTextured",scene);
            plenkaPBRTextured.albedoColor = new BABYLON.Color3(1,1,0.878);
            plenkaPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
            plenkaPBRTextured.bumpTexture.level = 1;
            plenkaPBRTextured.microSurface = 1;
            plenkaPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
            plenkaPBRTextured.reflectionTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_metallic.png",scene);
            plenkaPBRTextured.metallic = 1;
            plenkaPBRTextured.roughness = 0.5;
            plenkaPBRTextured.alpha = 0.6;
            plenkaPBRTextured.sheen.isEnabled = false;
            plenkaPBRTextured.sheen.intensity = 0.01;
            plenkaPBRTextured.sheen.linkSheenWithAlbedo = true;


            var copperPBRNew =  new BABYLON.PBRMaterial("copperPBRNew",scene);
            copperPBRNew.albedoTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_albedo.png");
            copperPBRNew.bumpTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_normal.png");
            copperPBRNew.bumpTexture.level = 1;
            copperPBRNew.reflectionTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_metallic.png",scene);
            copperPBRNew.reflectionTexture.level = 1;
            copperPBRNew.microSurface = 1;
            copperPBRNew.microSurfaceTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_roughness.png",scene);
            copperPBRNew.metallic = 0.6;
            copperPBRNew.roughness = 0.4;
            copperPBRNew.anisotropy.isEnabled = true;
            copperPBRNew.anisotropy.intensity = 0.4;
            copperPBRNew.enableSpecularAntiAliasing = true;


           // var hdrTexture = new BABYLON.CubeTexture.CreateFromPrefilteredData("https://assets.babylonjs.com/environments/environmentSpecular.env", scene);
            var hdrTexture =  new BABYLON.HDRCubeTexture("../../textures/cubemap/sky/reinforced_concrete_02_1k.hdr", scene, 128, false, true, false, true);
           scene.environmentTexture = hdrTexture;

            scene.fogMode = BABYLON.Scene.FOGMODE_EXP;
            scene.fogDensity = 0.001;


            var rubberPBRTextured = new BABYLON.PBRMaterial("rubberPBRTextured", scene);
            rubberPBRTextured.albedoTexture = new BABYLON.Texture("../../textures/rubber/Rubber_albedo.png");
            rubberPBRTextured.bumpTexture = new BABYLON.Texture("../../textures/rubber/Rubber_normal.png");
            rubberPBRTextured.microSurface = 1;
            rubberPBRTextured.microSurfaceTexture = new BABYLON.Texture("../../textures/rubber/Rubber_height.png",scene);
            rubberPBRTextured.metallic = 0.1;
            rubberPBRTextured.metallicTexture =  new BABYLON.Texture("../../textures/rubber/Rubber_ao.png");
            rubberPBRTextured.roughnessTexture =  new BABYLON.Texture("../../textures/rubber/Rubber_roughness.png");
            rubberPBRTextured.roughness = 0.8;
            rubberPBRTextured.sheen.isEnabled = true;
            rubberPBRTextured.sheen.intensity = 0.1;
            rubberPBRTextured.metallicF0Factor = 0.3;
            rubberPBRTextured.specularIntensity = 0.02;

            var rubberPBRTexturedMain = new BABYLON.PBRMaterial("rubberPBRTexturedMain", scene);
            rubberPBRTexturedMain.albedoColor = new BABYLON.Color3(0.1,0.1,0.1);
            rubberPBRTexturedMain.albedoTexture = new BABYLON.Texture("../../textures/rubber/Rubber_albedo.png");
            rubberPBRTexturedMain.bumpTexture = new BABYLON.Texture("../../textures/rubber/Rubber_normal.png");
            rubberPBRTexturedMain.microSurface = 1;
            rubberPBRTexturedMain.microSurfaceTexture = new BABYLON.Texture("../../textures/rubber/Rubber_height.png",scene);
            rubberPBRTexturedMain.metallic = 0.1;
            rubberPBRTexturedMain.metallicTexture =  new BABYLON.Texture("../../textures/rubber/Rubber_ao.png");
            rubberPBRTexturedMain.roughnessTexture =  new BABYLON.Texture("../../textures/rubber/Rubber_roughness.png");
            rubberPBRTexturedMain.roughness = 0.8;
            rubberPBRTexturedMain.sheen.isEnabled = true;
            rubberPBRTexturedMain.sheen.intensity = 0.1;
            rubberPBRTexturedMain.metallicF0Factor = 0.3;
            rubberPBRTexturedMain.specularIntensity = 0.02;

            var plasticPBRGrey = new BABYLON.PBRMaterial("plasticPBRGrey",scene);
            plasticPBRGrey.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.png");
            plasticPBRGrey.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRGrey.microSurface = 1;
            plasticPBRGrey.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRGrey.metallic = 0.2;
            plasticPBRGrey.metallicTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png");
            plasticPBRGrey.roughnessTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.png");
            plasticPBRGrey.roughness = 0.7;
            plasticPBRGrey.sheen.isEnabled = true;
            plasticPBRGrey.sheen.intensity = 0.1;
            plasticPBRGrey.metallicF0Factor = 0.3;

            var plasticPBRGreyForCut = new BABYLON.PBRMaterial("plasticPBRGreyForCut",scene);
            plasticPBRGreyForCut.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.png");
            plasticPBRGreyForCut.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRGreyForCut.microSurface = 1;
            plasticPBRGreyForCut.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRGreyForCut.metallic = 0.2;
            plasticPBRGreyForCut.metallicTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png");
            plasticPBRGreyForCut.roughnessTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.png");
            plasticPBRGreyForCut.roughness = 0.7;
            plasticPBRGreyForCut.sheen.isEnabled = false;
            plasticPBRGreyForCut.metallicF0Factor = 0.3;


            var plasticPBRBlue = new BABYLON.PBRMaterial("plasticPBRBlue",scene);
            plasticPBRBlue.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic8-alb.png");
            plasticPBRBlue.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRBlue.bumpTexture.level =2
            plasticPBRBlue.microSurface = 3;
            plasticPBRBlue.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRBlue.metallic = 0.2;
            plasticPBRBlue.roughness = 0.5;
            plasticPBRBlue.sheen.isEnabled = true;
            plasticPBRBlue.sheen.intensity = 0.2;

            var plasticPBRBlack = new BABYLON.PBRMaterial("plasticPBRBlack",scene);
            plasticPBRBlack.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic7-alb.png");
            plasticPBRBlack.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRBlack.microSurface = 0.5;
            plasticPBRBlack.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRBlack.metallic = 0.15;
            plasticPBRBlack.roughness = 0.5;
            plasticPBRBlack.sheen.isEnabled = true;
            plasticPBRBlack.sheen.intensity = 0.2;

            var plasticPBRGround = new BABYLON.PBRMaterial("plasticPBRGround",scene);
            plasticPBRGround.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic9-alb.png");
            plasticPBRGround.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRGround.microSurface = 0.5;
            plasticPBRGround.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRGround.metallic = 0.15;
            plasticPBRGround.roughness = 0.5;
            plasticPBRGround.sheen.isEnabled = true;
            plasticPBRGround.sheen.intensity = 0.2;

            var plasticPBRPink = new BABYLON.PBRMaterial("plasticPBRPink",scene);
            plasticPBRPink.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic10-alb.png");
            plasticPBRPink.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRPink.microSurface = 0.5;
            plasticPBRPink.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRPink.metallic = 0.15;
            plasticPBRPink.roughness = 0.5;
            plasticPBRPink.sheen.isEnabled = true;
            plasticPBRPink.sheen.intensity = 0.2;

            var plasticPBRLightBlue = new BABYLON.PBRMaterial("plasticPBRLightBlue",scene);
            plasticPBRLightBlue.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic11-alb.png");
            plasticPBRLightBlue.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
            plasticPBRLightBlue.microSurface = 0.5;
            plasticPBRLightBlue.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
            plasticPBRLightBlue.metallic = 0.15;
            plasticPBRLightBlue.roughness = 0.5;
            plasticPBRLightBlue.sheen.isEnabled = true;
            plasticPBRLightBlue.sheen.intensity = 0.2;

            var ropePBR = new BABYLON.PBRMaterial('ropePBR',scene);
            ropePBR.albedoTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Color.jpg");
            ropePBR.bumpTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Normal.jpg");
            ropePBR.microSurface = 1;
            ropePBR.microSurfaceTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Displacement.jpg",scene);
            ropePBR.metallic = 0.15;
            ropePBR.roughness = 0.5;
            ropePBR.sheen.isEnabled = true;
            ropePBR.sheen.intensity = 0.2;
            ropePBR.metallicTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Metalness.jpg",scene);
            ropePBR.useParallax = true;
            ropePBR.useParallaxOcclusion = true;
            ropePBR.parallaxScaleBias = 0.5;
            ropePBR.specularPower = 3000.0;
            ropePBR.specularColor = new BABYLON.Color3(0.5, 0.5, 0.5);

            var zeroVector = new BABYLON.Vector3(0,0,0);
            var rotateVectorMain = new BABYLON.Vector3(0, 90, 0);

            var bodyMainCylinder;
            var bodyDiameter = 4.5;
            var bodyLength = bodyDiameter *2;
            var bodyDiameterTop = bodyDiameter;
            var bodyDiameterBottom = bodyDiameter;

            var bodyDiameterOffset = 0;
            var cableFillingLength = 1;
            var cableFillingDiameter = bodyDiameter/2;
            var cableFillingDiameterTop = cableFillingDiameter;
            var cableFillingDiameterBottom = cableFillingDiameter;

            var cableMetalLength = 1;
            var cableMetalDiameter = cableFillingDiameter/1.5;
            var cableMetalDiameterTop = cableMetalDiameter;
            var cableMetalDiameterBottom = cableMetalDiameter;
            var cableFillings = [];
            var cutFillings = [];
            var totalCableFillings = 0;
            var previewPic;
            var accumMinus = 0.01;


            var createCableFilling = function(isCentered =0,cabFillLength=1.6,mat,diameter=bodyDiameter+0.1,
                                              diameterTop =bodyDiameter/2 ,diameterBottom =bodyDiameter/2,
                                              wrapWith,wrapMaterial=pvhPBRTextured,innerLine=0,positionX=0,positionY=0,positionZ=0,angle=0,cutMat= copperPBRTextured,storage = cableFillings,name="Оболочка жилы"){
                if(isCentered!=0) {
                    diameterTop = diameter / 6;
                    diameterBottom = diameter / 6;
                    cabFillLength +=0.3;
                }
                cabFillLength = cabFillLength - accumMinus;
                accumMinus = accumMinus - 0.005;


                var newCF = BABYLON.MeshBuilder.CreateCylinder(name, {
                    height: cabFillLength,
                    diameterTop : diameterTop,
                    diameterBottom : diameterBottom,
                    tessellation : 16,
                    updatable: true
                }, scene);

                newCF.id = name+getRandomInt(1,100000);

                var isWrapped = 0;

                if(typeof mat === 'undefined' || mat =='')
                {
                    if(totalCableFillings==0){ mat = plasticPBRGrey;}
                    if(totalCableFillings==1){ mat =plasticPBRGrey;}
                    if(totalCableFillings==2){ mat =plasticPBRGrey;}
                    if(totalCableFillings>2){ mat = plasticPBRGrey;}
                }

                newCF.material = mat;
                newCF.lookAt(rotateVectorMain);
                newCF.receiveShadows = true;
                if(isCentered!=0) {
                    newCF.position.x = positionX;
                    newCF.position.y =0;
                }else {
                    newCF.position.x = positionX;
                    newCF.position.y = positionY;
                    newCF.position.z = positionZ;
                }

                if(wrapWith.indexOf('helix')!=-1) { wrapWithHelix(newCF,wrapMaterial,cabFillLength); isWrapped = 1; }
                var cfObj = {'object':newCF,'diameter':diameter,'diameterTop':diameterTop,'diameterBottom':diameterBottom,
                    'material':mat, 'isWrapped':isWrapped,'innerLine':innerLine,
                    'positionX':positionX,'positionY':positionY,'positionZ':positionZ};
                if(isCentered==0) {
                    storage.push(cfObj);
                }
                totalCableFillings++;

           //     newCF.scaling = new BABYLON.Vector3(1,1,0.8);
           //     var axis = new BABYLON.Vector3(0, 1, 0);
            //    newCF.rotate(axis, totalCableFillings, BABYLON.Space.LOCAL);
            }

            var cableCuts = [];
            var totalCableCuts = 0;


            var getInnerCirlce = function(mainCircle,circle)
            {
                let innerCirlce = mainCircle - circle;
                return innerCirlce;
            }

            var getAngle = function(count)
            {
                let angleSteps = 360/count;
                return angleSteps;
            }


            var getCoords = function(radius,angle)
            {
                var x = bodyLength * 1.6;
                var y = radius * Math.cos(angle * Math.PI/180);
                var z = radius * Math.sin(angle* Math.PI/180);

                var coords = {"x":x,"y":y,"z":z};

                return coords;
            }

            var coordinates = [];


            function isMainFit(arrayOfObj,rad,elems)
            {
                var effRad = rad;
                var newEffRad = 0;
                var angles = getAngle(elems);

                for(var i=0; i<arrayOfObj.length;i++)
                {
                    newEffRad = newEffRad + (2*Math.PI * arrayOfObj[i].diameter);
                }

                if(newEffRad > bodyDiameter)
                {
                    newEffRad = newEffRad + (newEffRad - bodyDiameter);
                }
                var nfr = newEffRad/ (2 * Math.PI);
                newEffRad = nfr/(elems/3);

                for(var objI=0;objI<arrayOfObj.length;objI++) {
                    coords = getCoords(newEffRad/3,angles*objI);
                    arrayOfObj[objI].object.position.z = coords.z;
                    arrayOfObj[objI].object.position.y = coords.y;
                }
                bodyMainCylinder.dispose();
                createMainBody(bodyLength,newEffRad,newEffRad,newEffRad);

            }

            var buildCable = function(elemCount,elemRadius,rad,cablen,offset=1,inner=0)
            {
                var angles = getAngle(elemCount);

                for(var k =0;k<elemCount;k++)
                {
                    curAngle = angles * k + offset;
                    elemCoords =  getCoords(rad,curAngle);
                    coordinates.push(elemCoords);
                    createCableFilling(0,cablen,'',elemRadius,elemRadius,elemRadius,'','',0,
                        elemCoords.x,  elemCoords.y,  elemCoords.z,curAngle);
                    if(inner==0){
                        createTubes(10,0.15,10,'','',elemCoords.x/2.5,elemCoords.y,elemCoords.z,0.1);
                    }else {
                        createTubes(10,0.15,10,'','',elemCoords.x/1.4,elemCoords.y,elemCoords.z,0.1);
                    }
                }
            }

            var isCableFit = function(firstElemZ,firstElemY,firstElemRad,nextElemZ,nextElemY,nextElemRad)
            {
                var getSquare = (Math.pow( (nextElemZ-firstElemZ),2 )) + (( Math.pow( (nextElemY - firstElemY),2 )));
                var getRadSumm = firstElemRad + nextElemRad;

                if(getSquare <= getRadSumm)
                {
                    return false;
                }else
                {
                    return true;
                }


            }

            var createMainBody = function(length,diameter,diameterTop,diameterBottom,mat=blackPBRTextured,tessel = 64)
            {
                bodyMainCylinder = BABYLON.MeshBuilder.CreateCylinder("Внешняя оболочка", {
                    height : length*3,
                    diameterTop : diameter,
                    diameterBottom : diameter,
                    tessellation : tessel
                }, scene);

                bodyMainCylinder.material = mat;
                bodyMainCylinder.lookAt(new BABYLON.Vector3(0, 90, 0));

                return bodyMainCylinder;
            }

            var reColorElems = function (element,mat) {
                if(typeof element == 'undefined' || element ==''){ return false;}
                if(element.hasOwnProperty('object'))
                {
                    element.object.material = mat;
                }else {
                    element.material = mat;
                }
            }

            var otherCurve = function(r,R,h,steps=10,mod = 1)
            {
                var path = [];
                for(var i =1;i<=steps; i+=mod)
                {
                    x = R * Math.cos(i);
                    y = R * Math.sin(i);
                    z = h*i;
                    path.push(new BABYLON.Vector3(z,x,y));
                }
                return path;
            }

            var tube;
            var createTubes = function(count,radius = 0.2,steps=10,mod=0.5,mat = copperPBRTextured,positionX,positionY,positionZ,innerRad = 0.21)
            {
                var newInstance;

                for(var i=1; i<=count;i++)
                {
                    if(i==1) {
                        tube = BABYLON.MeshBuilder.CreateTube("Токопроводящая жила", {
                            path: otherCurve('', 0.25, 3, 5, 1),
                            radius: radius,
                            sideOrientation: BABYLON.Mesh.DOUBLESIDE,
                            updatable: true,
                            cap: BABYLON.Mesh.CAP_ALL,
                            tesselation: 8
                        }, scene);
                        tube.material = copperPBRTextured;
                        tube.id = 'tubeId';
                    }

                    newInstance = tube.createInstance("Токопроводящая жила" + getRandomInt(1,1000000000));
                    newInstance.position.x = positionX;
                    newInstance.position.y = positionY
                    newInstance.position.z =positionZ;

                    newInstance.rotation.x = i;
                    newInstance.name = "Токопроводящая жила";
                    newInstance.thinInstanceEnablePicking = true;
                }

            }


            //scene.createDefaultCamera(true, true, true);
//scene.activeCamera.alpha += Math.PI;

// Parameters: name, alpha, beta, radius, target position, scene
            var camera =  new BABYLON.ArcRotateCamera("Camera", 0, 0, -10, new BABYLON.Vector3(0, 0, 0), scene);
// Positions the camera overwriting alpha, beta, radius
            camera.setPosition(new BABYLON.Vector3(30, 0, 30));
// This attaches the camera to the canvas
            camera.attachControl(canvas, true);
            camera.minZ = 0.01;
            camera.lowerRadiusLimit = 30;
            camera.upperRadiusLimit = 100;
            camera.wheelDeltaPercentage = 0.01;
//var layer = new BABYLON.Layer('','https://fwlogistics.com/wp-content/uploads/2019/09/FWL_Sept_BlogImages_1_Warehouse.jpg', scene, true);
            scene.clearColor = new BABYLON.Color3(0.95, 0.95, 0.95);

            scene.gravity = new BABYLON.Vector3(0, -0.15, 0);
            camera.applyGravity = true;

            const assumedFramesPerSecond = 60;
            const earthGravity = -9.81;
            scene.gravity = new BABYLON.Vector3(0, earthGravity / assumedFramesPerSecond, 0);
            camera.ellipsoid = new BABYLON.Vector3(1, 1, 1);

            scene.collisionsEnabled = true;
            camera.checkCollisions = true;



            var lightCollection = new Array();

            var createLight = function(lightType,lightName,vector = zeroVector,_scene = scene)
            {
                var newLight = '';
                if(lightType=='' || typeof lightType === 'undefined' || lightType=='undefined')
                {
                    let lightGenericName = "HemiSphericLight"+eval(lightCollection.length+1);
                    newLight = new BABYLON.HemisphericLight(lightGenericName,vector,_scene);
                }
                if(lightType == 'hemi'){
                    if(lightName =='' || typeof lightName === 'undefined'){
                        let lightGenericName = "HemiSphericLight"+eval(lightCollection.length+1);
                        newLight = new BABYLON.HemisphericLight(lightGenericName,vector,_scene);
                    }else
                    {
                        newLight = new BABYLON.HemisphericLight(lightName,vector,_scene);
                    }
                }
                if(lightType == 'point'){
                    if(lightName =='' || typeof lightName === 'undefined'){
                        let lightGenericName = "PointLight"+eval(lightCollection.length+1);
                        newLight = new BABYLON.PointLight(lightGenericName,vector,_scene);
                    }else
                    {
                        newLight = new BABYLON.PointLight(lightName,vector,_scene);
                    }
                }
                if(lightType == 'direct'){
                    if(lightName =='' || typeof lightName === 'undefined'){
                        let lightGenericName = "DirectLight"+eval(lightCollection.length+1);
                        newLight = new BABYLON.DirectionalLight(lightGenericName,vector,_scene);
                    }else
                    {
                        newLight = new BABYLON.DirectionalLight(lightName,vector,_scene);
                    }
                }
                lightCollection.push(newLight);
            };


            var modifyLight = function (obj,param,paramVal)
            {
                if(obj=='' || typeof obj === 'undefined' || obj === 'undefined')
                {
                    console.log('You must provide right type of object');
                    return false;
                }

                if(param=='' || typeof param === 'undefined' || param === 'undefined'){
                    console.log('No parameter specified');
                    return false;
                }
                if(typeof paramVal === 'undefined' || paramVal === 'undefined'){
                    console.log('No value specified');
                    console.log(typeof paramVal);
                    return false;
                }
                if(param == 'intensity'){ obj.intensity=paramVal;}
                if(param == 'range'){ obj.range=paramVal;}
                if(param == 'radius'){ obj.radius=paramVal;}
                if(param == 'diffuse'){obj.diffuse = paramVal;}
                if(param == 'specular'){obj.specular = paramVal;}
            }



            createLight('direct','',new BABYLON.Vector3(0, 0, 0.5));
            createLight('direct','',new BABYLON.Vector3(0, 0, -0.5));
            createLight('direct','',new BABYLON.Vector3(0, 0, 0.5));
            createLight('direct','',new BABYLON.Vector3(-40, 0, 10));
            createLight('direct','',new BABYLON.Vector3(-40, 0, -10));

            modifyLight(lightCollection[1],'intensity',5);
            modifyLight(lightCollection[2],'intensity',5);
            modifyLight(lightCollection[3],'intensity',1);

            /*
            createLight('direct','',new BABYLON.Vector3(0,1,3));
            createLight('direct','',new BABYLON.Vector3(0,1.5,-3));
            createLight('direct','',new BABYLON.Vector3(0,1,-3));
            */
//createLight('hemi','',new BABYLON.Vector3(10,0,0));
//createLight();
//createLight();
//createLight('direct','',new BABYLON.Vector3(-5,0,0));
            /*
            modifyLight(lightCollection[0],'intensity',4);
            modifyLight(lightCollection[0],'range',12);
            modifyLight(lightCollection[1],'intensity',4);
            modifyLight(lightCollection[1],'range',12);*/

//modifyLight(lightCollection[3],'intensity',0.5);




            var createHelix = function(helixMaterial = pvhPBRTextured,objectDiameter =0.3,offset = 20,helixPositionX = 0, helixPositionY = 0,helixPositionZ=0,stepLen = 50,name="Сепаратор по скрученным жилам") {
                pathHelix = [];
                for (var i = 0; i <= stepLen; i++) {
                    var v = 2.0 * Math.PI * i / 20;
                    pathHelix.push(new BABYLON.Vector3(3 * Math.cos(v), i / 4, 3 * Math.sin(v)));
                }

                var helix = BABYLON.MeshBuilder.CreateRibbon(name, {
                    pathArray : [pathHelix],
                    offset : offset
                }, scene);
                helix.id = helix.name + getRandomInt(1,100000);
                helix.material = helixMaterial;
                helix.material.backFaceCulling = false;

                let scaleParam = (objectDiameter/1.55) - objectDiameter/stepLen;
                helix.scaling ﻿= new BABYLON.Vector3(scaleParam,scaleParam,scaleParam);
                var direction = new BABYLON.Vector3(helixPositionX, helixPositionY/1.22, helixPositionZ);
                direction.normalize();
                helix.position.x = helixPositionX/1.7;
                helix.position.y = helixPositionY;
                helix.position.z = helixPositionZ;
                helix.translate(direction, 1, BABYLON.Space.WORLD);
                helix.rotate(new BABYLON.Vector3(0, 0, 1), 1.58, BABYLON.Space.WORLD);

                var shadowGenerator = new BABYLON.ShadowGenerator(1024, lightCollection[0   ]);
                shadowGenerator.addShadowCaster(helix);
                shadowGenerator.useExponentialShadowMap = true;

                var shadowGenerator2 = new BABYLON.ShadowGenerator(1024, lightCollection[1]);
                shadowGenerator2.addShadowCaster(helix);
                shadowGenerator2.usePoissonSampling = true;
            }


            var wrapWithHelix = function(object,material,cablen,diameter,ofst,)
            {

                var helixPositionX = object.position.x + (cablen*1.07);
                var helixPositionY = object.position.y;
                var helixPositionZ = object.position.z;
                createHelix(material,diameter,ofst,helixPositionX,helixPositionY,helixPositionZ);
            }


            /**/

            /**/

            var elemsFirstRow = 10;
            var elemsSecondRow = 9;
            var innerElemsRadius = 1.5;

            var innerElements = 2;
            var radiusModifier = 2.76;


            var firstRowMaterial,secondRowMaterial,globalFillMaterial ;
            var centerCutMaterial,centerCutFillingMaterial;
            var isCentered = 0;

            if(getUriParam('firstRow',location.href))
            {
                elemsFirstRow = getUriParam('firstRow',location.href);
            }
            if(getUriParam('secondRow',location.href))
            {
                elemsSecondRow =  getUriParam('secondRow',location.href);
            }


            var parseUri = function(vl,alias)
            {
                vlOld = vl;
                if(typeof alias == 'undefined' && alias!='') {
                    if (getUriParam(vl, location.href)) {
                        vl = eval(getUriParam(vl, location.href));
                        return vl;
                    } else {
                        vl = eval(vlOld);
                        return vl;
                    }
                }else {
                    if (getUriParam(alias, location.href)) {
                        vl = eval(getUriParam(alias, location.href));
                        return vl;
                    } else {
                        vl = eval(vlOld);
                        return vl;
                    }
                }
            }

            globalFillMaterial =  parseUri('globalFillMaterial');
            firstRowMaterial = parseUri('firstRowMaterial','fRowMat');
            secondRowMaterial = parseUri('secondRowMaterial','sRowMat');

            if(typeof globalFillMaterial!='undefined' && globalFillMaterial!='')
            {
                firstRowMaterial = globalFillMaterial;
                secondRowMaterial  = globalFillMaterial;
            }
            if(getUriParam('bodyMainDiameter',location.href))
            {
                bodyDiameter = getUriParam('bodyMainDiameter',location.href);
                bodyDiameterTop = getUriParam('bodyMainDiameter',location.href);
                bodyDiameterBottom = getUriParam('bodyMainDiameter',location.href);
            }

            bodyLength = parseUri('bodyLength');
            bodyMaterial = blackPBRTextured;
            bodyMaterial = parseUri('bodyMaterial');


            if(getUriParam('innerElemsRadius',location.href))
            {
                innerElemsRadius = getUriParam('innerElemsRadius',location.href);
            }

            var magicParam = 3.08;
            var curSpacing = 3.08 - innerElemsRadius;

            var bodyModifier = 0.5;

            bodyModifier = parseUri('bodyModifier','diameterMod');

            if(elemsFirstRow>7) {
                bodyDiameter = elemsFirstRow;
            }else if(elemsFirstRow > 0 && elemsFirstRow <=7) {
                bodyDiameter = parseInt(elemsFirstRow) + parseInt(elemsSecondRow);
            }else {
                bodyDiameter =parseInt(elemsSecondRow)*0.66;
            }

            var startMod = 3.3;
            if(elemsSecondRow==0)
            {
                startMod = 4.01;
                bodyDiameter = bodyDiameter*0.7;
            }

            bodyDiameter = bodyDiameter * innerElemsRadius * bodyModifier;
            var secondBody =0;
            if(getUriParam('secondBody',location.href))
            {
                secondBody = 1;
                secondBodyMaterial = blackPBRTextured;
                secondBodyMaterial = parseUri('secondBodyMaterial','secBodyMat');
                bodyDiameter = bodyDiameter + (bodyDiameter/elemsSecondRow);
                minMod = '0.'+elemsSecondRow;
                minMod = parseFloat(minMod);
                createCableFilling(0,bodyLength,secondBodyMaterial,bodyDiameter-0.4,bodyDiameter-0.4,bodyDiameter-0.4,
                    '','',0,bodyLength*1.2,0,0,'','',cutFillings,'Дополнительная оболочка');
                createHelix(rubberPBRTextured,bodyDiameter/3.8,20,20,0,0,50,'Лента из прорезиненной ткани');
                createHelix(plenkaPBRTextured,bodyDiameter/4.1,20,30,0,0,50);
            }else {
                createHelix(plenkaPBRTextured,bodyDiameter/3.9,20,30,0,0,50);
            }

            if(eval(parseInt(elemsFirstRow)+ parseInt(elemsSecondRow))>12){
        bodyDiameter = bodyDiameter + 0.9;
                }
            createMainBody(bodyLength,bodyDiameter,bodyDiameter,bodyDiameter,bodyMaterial);

            if(getUriParam('secondBody',location.href)) {
                bodyMainCylinder.position.x = -6;
            }

            buildCable(elemsFirstRow,innerElemsRadius,bodyDiameter/startMod,8);
            if(elemsFirstRow==0){
                buildCable(elemsSecondRow,innerElemsRadius,bodyDiameter/3.5,18,15,1);
            }else {
                buildCable(elemsSecondRow,innerElemsRadius,bodyDiameter/6.9,18,15,1);
            }

            createCableFilling(1,bodyLength*2.5,blackLightPBRTextured,6,6,6,'','','',
                bodyLength*1.6,0,0,'','','','Изоляция упрочняющего сердечника');
            createCableFilling(1,bodyLength*2.7,ropePBR,5,5,5,'','','',
                bodyLength*1.6,0,0,'','','','Упрочняющий сердечник');

            var totalElems = parseInt(elemsFirstRow)+ parseInt(elemsSecondRow);

            if(totalElems>10) {
                for (var randRecolor = 0; randRecolor < 3; randRecolor++) {
                    reColorElems(cableFillings[getRandomInt(randRecolor, cableFillings.length - 1)], plasticPBRLightBlue);
                    reColorElems(cableFillings[getRandomInt(randRecolor, cableFillings.length - 1)], plasticPBRPink);
                }
            }else if(totalElems){
                for (var randRecolor = 0; randRecolor < 2; randRecolor++) {
                    reColorElems(cableFillings[getRandomInt(randRecolor, cableFillings.length - 1)], plasticPBRLightBlue);
                }
                reColorElems(cableFillings[getRandomInt(randRecolor, cableFillings.length - 1)], pvhPBRTextured);
            }


            frameRotate = 60;
            frameRotate = parseUri('frameRotate');
            camera.setPosition(new BABYLON.Vector3(frameRotate, 0, frameRotate));




            highLight = new BABYLON.HighlightLayer("highLight", scene);

            var babGreen = new BABYLON.Color3.Green();

            var onPointerMove = function(e) {
                if(prevHighLight!='' && typeof prevHighLight != 'undefined'){
                    highLight.removeMesh(prevHighLight);
                    removeColorPulser(scene.getMeshByID('tubeId'));
                    document.getElementById('info').style.display='none';
                }
                var result = scene.pick(scene.pointerX, scene.pointerY);
                if (result.hit) {
                    if(result.pickedMesh.id != prevHighLight) {
                        if(result.pickedMesh.name!='Токопроводящая жила') {
                            highLight.addMesh(scene.getMeshByID(result.pickedMesh.id), babGreen);
                        }else {
                            colorPulser(scene.getMeshByID('tubeId'));
                        }
                        prevHighLight = result.pickedMesh;
                        //  colorPulser(scene.getMeshByID(result.pickedMesh.id));
                        document.getElementById('info').textContent = result.pickedMesh.name;
                        document.getElementById('info').style.display = 'block';
                    }else {

                    }
                }
            }

            canvas.addEventListener("pointermove", onPointerMove, false);
            var alpha = .2;
            var colorPulser = function(mesh) {
                mesh.material.unfreeze();
                mesh.material.emissiveColor = new BABYLON.Color3.Green();
            };

            var removeColorPulser = function(mesh)
            {
                mesh.material.emissiveColor = new BABYLON.Color3(0,0,0);
            }


            for(var x=0;x<scene.meshes.length;x++)
            {
                scene.meshes[x].checkCollisions = true;
            }


            if(location.href.indexOf('doScreen')!=-1) {
                scene.afterRender = function () {

                    doonce++;
                    if (doonce == 60) {
                        camera.setPosition(new BABYLON.Vector3(60, 0, 60));
                        camera.radius = 40;
                        camera.alpha = 120;
// Positions the camera overwriting alpha, beta, radius
                    }
                    if (doonce == 62) {
                        BABYLON.Tools.CreateScreenshot(engine, camera, {width: 800, height: 400}, function (data) {
                            previewPic = data;
                        });
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '../../savepic.php', true);

                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                        xhr.send("name=total"+eval(totalElems)+"firstrow"+elemsFirstRow+";secrow"+elemsSecondRow+";cut"+innerElemsRadius+";secondBody"+secondBody+"&picfile=" + previewPic);

                    }
                    if (doonce == 63) {
                        camera.setPosition(new BABYLON.Vector3(60, 0, 60));
                    }
                }
            }


            if(location.href.indexOf('debug')!=-1) {
                scene.debugLayer.show({showExplorer: true, embedMode: true}).then(() => {
                });
            }

            /*
            var newCurve = function()
            {
              var angle = getAngle(64);
              var path =[];
              var mod =1;
              for(var l=0;l<=64;l++) {
               var getPoints = getCoords(0.5,angle*l);
               if(l>=22 && l<=46) {
                 if(l>=22 && l<=30)
                 {
                   mod = mod - 0.05;
                 }else if(l>30 && l<=37)
                 {
                  mod = mod + 0.05;
                 }else {
                  mod = 1;
                 }
                 console.log(mod);
                getPoints.y = getPoints.y*mod;
                getPoints.z = getPoints.z;
               }
               path.push(new BABYLON.Vector3(getPoints.y,getPoints.z,0));
              }
              return path;
            }


            const options = {
             shape: newCurve(), //vec3 array with z = 0,
             path: [new BABYLON.Vector3(0,0,0),new BABYLON.Vector3(0,5,0)], //vec3 array
             updatable: true,
             cap: BABYLON.Mesh.CAP_ALL,
            }

            var createExtruded = function(rot,posx,posy,posz)
            {
             var  extruded = BABYLON.MeshBuilder.ExtrudeShape("ext", options, scene);
             extruded.lookAt(rotateVectorMain);
             //
             extruded.position.x = posx;
             extruded.position.y = posy;
             extruded.position.z = posz;
             extruded.material = plasticPBRGrey;
             var axis = new BABYLON.Vector3(0, 1, 0);
             extruded.rotate(axis, rot, BABYLON.Space.LOCAL);
            }

            var angl= getAngle(10);

            for(var k =1;k<11;k++) {
                cpos = getCoords(bodyDiameter/3.08,angl*k);
                createExtruded(190,cpos.x*1.2,cpos.y,cpos.z);
            }


            /*
            var customMesh = new BABYLON.Mesh("custom", scene);
            var positions = newCurve();
            var indices = [0, 1, 2, 3, 4, 5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31]


            var normals = [];
            //Calculations of normals added
            BABYLON.VertexData.ComputeNormals(positions, indices, normals);

            var vertexData = new BABYLON.VertexData();
            vertexData.positions = positions;
            vertexData.indices = indices;
            vertexData.applyToMesh(customMesh);*/


            var pipeline = new BABYLON.DefaultRenderingPipeline(
                "defaultPipeline", // The name of the pipeline
                true, // Do you want the pipeline to use HDR texture?
                scene, // The scene instance
                [camera] // The list of cameras to be attached to
            );
            pipeline.bloomEnabled = false;
            pipeline.bloomThreshold = 0.6;
            pipeline.bloomWeight = 0.05;
            pipeline.bloomKernel = 2;
            pipeline.bloomScale = 0.5;

            pipeline.depthOfFieldEnabled = false;
            pipeline.depthOfFieldBlurLevel = BABYLON.DepthOfFieldEffectBlurLevel.Low;

            pipeline.depthOfField.focusDistance  = 3094.3; // distance of the current focus point from the camera in millimeters considering 1 scene unit is 1 meter
            pipeline.depthOfField.focalLength  = 225.5; // focal length of the camera in millimeters
            pipeline.depthOfField.fStop  = 23.7; // aka F number of the camera defined in stops as it would be on a physical device

            pipeline.grainEnabled = true;
            pipeline.grain.intensity = 5.3;

            //     camera.setPosition(new BABYLON.Vector3(0, 0, 5));
            return scene;
        };

        var doonce =0 ;
        // call the createScene function
        var scene = delayCreateScene();


        // run the render loop


        engine.runRenderLoop(function() {
            scene.render();

            divFps.innerHTML = engine.getFps().toFixed() + " fps";
            // dCR.render();
        });



        // the canvas/window resize event handler
        window.addEventListener('resize', function() {
            engine.resize();
        });

    });
</script>
</body>
</html>`