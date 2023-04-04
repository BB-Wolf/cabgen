<? include("../compiler.php");?>
<!DOCTYPE html>
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
<!--
        <script src="../../js/babylon.js"></script>
        
         <script src="../../js/babylonjs.loaders.min.js"></script>
        <script src="../../js/babylon.gui.min.js"></script>-->
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
blackPBRTextured.bumpTexture.level = 0.1;
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


var blackPBRTexturedShiny = new BABYLON.PBRMaterial("blackPBRTexturedShiny", scene);
blackPBRTexturedShiny.albedoColor = new BABYLON.Color3(0, 0,0);
blackPBRTexturedShiny.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
blackPBRTexturedShiny.bumpTexture.level = 0.1;
blackPBRTexturedShiny.microSurface = 1;
blackPBRTexturedShiny.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
blackPBRTexturedShiny.metallic = 0.16;
blackPBRTexturedShiny.roughness = 0.42;
blackPBRTexturedShiny.enableSpecularAntiAliasing = true;
blackPBRTexturedShiny.environmentIntensity = 0.94;
blackPBRTexturedShiny.sheen.isEnabled = true;
blackPBRTexturedShiny.sheen.intensity = 0.13;
blackPBRTexturedShiny.directIntensity = 1;
blackPBRTexturedShiny.specularIntensity = 1;
blackPBRTexturedShiny.clearCoat.isEnabled = true;
blackPBRTexturedShiny.clearCoat.intensity = 1;
blackPBRTexturedShiny.clearCoat.roughness = 0.36;



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
copperPBRTextured.metallicF0Factor = 1;/*
copperPBRTextured.subSurface.thicknessTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
copperPBRTextured.subSurface.maximumThickness = 2.2;
copperPBRTextured.subSurface.isTranslucencyEnabled = true;*/

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
plenkaPBRTextured.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
plenkaPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
plenkaPBRTextured.bumpTexture.level = 1;
plenkaPBRTextured.microSurface = 1;
plenkaPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
plenkaPBRTextured.reflectionTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_metallic.png",scene);
plenkaPBRTextured.metallic = 1;
plenkaPBRTextured.roughness = 0.5;
plenkaPBRTextured.alpha = 0.9;
plenkaPBRTextured.sheen.isEnabled = true;
plenkaPBRTextured.sheen.intensity = 0.001;
plenkaPBRTextured.sheen.linkSheenWithAlbedo = false;

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
plasticPBRBlue.microSurface = 1;
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


var hdrTexture =  new BABYLON.HDRCubeTexture("../../textures/cubemap/sky/reinforced_concrete_02_1k.hdr", scene, 128, false, true, false, true);
scene.environmentTexture = hdrTexture;
scene.fogMode = BABYLON.Scene.FOGMODE_EXP;
scene.fogDensity = 0.002;

                    var zeroVector = new BABYLON.Vector3(0,0,0);
var rotateVectorMain = new BABYLON.Vector3(0, 90, 0);

var bodyMainCylinder;
var bodyDiameter = 4.5;
var bodyLength = bodyDiameter *2;
var bodyDiameterTop = bodyDiameter;
var bodyDiameterBottom = bodyDiameter;

var bodyDiameterOffset = 0;
var cableFillingLength = 1.5;
var cableFillingDiameter = bodyDiameter/2;
var cableFillingDiameterTop = cableFillingDiameter;
var cableFillingDiameterBottom = cableFillingDiameter;

var cableMetalLength = 1;
var cableMetalDiameter = cableFillingDiameter/1.5;
var cableMetalDiameterTop = cableMetalDiameter;
var cableMetalDiameterBottom = cableMetalDiameter;
var cableFillings = [];
var cutFillings = [];
var tubeFillings = [];
var totalCableFillings = 0;
var previewPic;


var createCableFilling = function(isCentered =0,cabFillLength=1.6,mat,diameter=bodyDiameter+0.1,
                                  diameterTop =bodyDiameter/2 ,diameterBottom =bodyDiameter/2,
                                  wrapWith,wrapMaterial=pvhPBRTextured,innerLine=0,positionX=0,positionY=0,positionZ=0,angle=0,cutMat= copperPBRTextured,storage = cableFillings,name="Оболочка жилы"){
    if(isCentered!=0) {
        diameterTop = diameter / 6;
        diameterBottom = diameter / 6;
        cabFillLength +=0.3;
    }

    var newCF = BABYLON.MeshBuilder.CreateCylinder(name, {
        height: cabFillLength,
        diameterTop : diameterTop,
        diameterBottom : diameterBottom,
        tessellation : 16,
        updatable: true
    }, scene);


    newCF.id = name+getRandomInt(1,100000);
   // shadowGenerator.addShadowCaster(newCF, true);
    if(location.href.indexOf('fullShadows')!=-1) {
        csmShadowGenerator.getShadowMap().renderList.push(newCF);
        csmShadowGenerator2.getShadowMap().renderList.push(newCF);
        csmShadowGenerator3.getShadowMap().renderList.push(newCF);
        csmShadowGenerator4.getShadowMap().renderList.push(newCF);
        newCF.receiveShadows = true;
    }
    newCF.checkCollisions = true;

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
           createTubes(10,innerElemsRadius/(elemCount*(1.1/innerElemsRadius)) ,10,'','',elemCoords.x/2.5,elemCoords.y,elemCoords.z,0.1);
       }else {
           createTubes(10,innerElemsRadius/(elemCount*(2.2/innerElemsRadius)),10,'','',elemCoords.x/1.4,elemCoords.y,elemCoords.z);
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

var lastCoords =[];
var lastCoordsIter = 0;

var otherCurve = function(R,h,steps=10,mod = 1,startX=0,startY=0,startZ=0,curveStep=2,invert=0,skipStep=1,xMod = 0,yMod=0.38,zMod=0,curveMod = 3)
{
    var path = [];
    var x,y,z;
    lastCoords[lastCoordsIter] = [];
    if(curveMod == 0) { curveMod=1;} // ;)
    for(var i =skipStep;i<=steps; i+=mod)
    {
        if(invert==0) {
            y = R * Math.sin(i/curveMod);
            z = R * Math.cos(i/curveMod);
        }else {
            y = R * Math.cos(i/curveMod);
            z = R * Math.sin(i/curveMod);
        }
        x = h*i*curveStep+xMod;
        z= z+0.2+zMod;
        y= y+yMod;
       path.push(new BABYLON.Vector3(x,y,z));
       lastCoords[lastCoordsIter].push(new BABYLON.Vector3(x,y,z));
    }
lastCoordsIter+=1;

    return path;
}

var linearCurve = function(x=5){ return [new BABYLON.Vector3(0,0,0), new BABYLON.Vector3(x,0,0)];};

var tube;

var createTubes = function(count,radius = 0.2,steps=5,mod=0.5,mat = copperPBRTextured,positionX,positionY,positionZ,innerRad = 0.21,length=3,path,invert=0,skipStep=1)
{
    var newInstance;
    if(typeof path == 'undefined' || path=='')
    {
       path =  otherCurve( innerRad, length, steps, mod,0,0,0,2);
    }
    for(var i=skipStep; i<=count;i++)
    {
        if(i==1) {
            tube = BABYLON.MeshBuilder.CreateTube("Токопроводящая жила", {
                path: path,
                radius: radius,
                sideOrientation: BABYLON.Mesh.DOUBLESIDE,
                updatable: true,
                cap: BABYLON.Mesh.CAP_ALL,
                tesselation: 128
            }, scene);
        tube.material = copperPBRTextured;
        tube.id = 'tubeId';
            tube.position.x = positionX;
            tube.position.y = positionY
            tube.position.z =positionZ;
            tube.rotation.x = i;
            tube.name = "Токопроводящая жила";
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


var createTubesUnOpt = function(name="Токопроводящая жила",count,radius = 0.2,steps=5,mod=0.5,mat = copperPBRTextured,positionX,positionY,positionZ,innerRad = 0.21,length=3,invert=0,skipStep=1,curveStep=2,xMod=0,yMod=0.38,zMod=0,path,bdm,storage=[],curveMod=3)
{

    if(typeof path == 'undefined' || path=='') {
         path = otherCurve(innerRad, length, steps, mod, 0, 0, 0, curveStep, invert, skipStep, xMod, yMod,zMod,curveMod);
    }

    var agl = getAngle(count);

    for(var i=1; i<=count;i++) {
        tube = BABYLON.MeshBuilder.CreateTube(name, {
            path: path,
            radius: radius,
            sideOrientation: BABYLON.Mesh.DOUBLESIDE,
            updatable: true,
            cap: BABYLON.Mesh.CAP_ALL,
            tesselation: 64
        }, scene);

        tube.material = mat;
        if(name == '' ){
            tube.name = 'Токопроводящая жила';
        }
        tube.id = tube.id+getRandomInt(1,100000000000000);
        tube.checkCollisions = true;

        if(typeof storage!='boolean'){
            storage.push(tube);}
        if(location.href.indexOf('fullShadows')!=-1) {
            csmShadowGenerator.getShadowMap().renderList.push(tube);
            csmShadowGenerator2.getShadowMap().renderList.push(tube);
            csmShadowGenerator3.getShadowMap().renderList.push(tube);
            csmShadowGenerator4.getShadowMap().renderList.push(tube);
            tube.receiveShadows = true;
        }
        var rad = getCoords(bdm,agl*i);

        if(bdm==0 || typeof bdm === 'undefined' || bdm =='')
        {
            tube.position.x = positionX;
            tube.position.y = positionY;
            tube.position.z = positionZ;

        }else {
            tube.position.x = positionX;
            tube.position.y = rad.y;
            tube.position.z = rad.z;
        }
        if(count>3 && count<8) {
            tube.rotation.x = i*1.3;
          //  tube.rotation.x+= getRandomInt(3,10);
        }
        if(count == 4)
        {
            tube.rotation.x = i* 1.5;
        }

        if(count == 6)
        {
            tube.rotation.x = i * 1.1;
        }

        if(count==7) {
             tube.rotation.x = i*0.9;
        }
        if(count==8) {
             tube.rotation.x = i *0.8;
        }
         if (count<=3) {
            tube.rotation.x = i*2.2;
        }
         if(count>=9 && count<12){
            tube.rotation.x = i*0.7;
        }

         if(count == 10){
             tube.rotation.x = i* 0.62;
         }
         if(count==12){
            tube.rotation.x = i * 0.52;
        }
   //   tube.rotation.x+=rad.x;
     //   tube.name = "Токопроводящая жила";

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
camera.minZ = 0.05;
camera.lowerRadiusLimit = 0.7;
camera.upperRadiusLimit = 100;
camera.wheelDeltaPercentage = 0.01;
//var layer = new BABYLON.Layer('','https://fwlogistics.com/wp-content/uploads/2019/09/FWL_Sept_BlogImages_1_Warehouse.jpg', scene, true);
scene.clearColor = new BABYLON.Color3(0.95, 0.95, 0.95);

const assumedFramesPerSecond = 60;
const earthGravity = -9.81;
scene.gravity = new BABYLON.Vector3(0, earthGravity / assumedFramesPerSecond, 0);
//camera.ellipsoid = new BABYLON.Vector3(1, 1, 1);
scene.collisionsEnabled = true;
camera.checkCollisions = false;

camera.collisionRadius = new BABYLON.Vector3(0.5, 0.5, 0.5);               
				   
				  							 
				 
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
createLight('direct','',new BABYLON.Vector3(0.5, 0.5, -0.5));

modifyLight(lightCollection[1],'intensity',5);
modifyLight(lightCollection[2],'intensity',5);


/*
var shadowGenerator = new BABYLON.ShadowGenerator(1024, lightCollection[2]);
shadowGenerator.useCloseExponentialShadowMap = true;
*/

if(location.href.indexOf('fullShadows')!=-1){
var csmShadowGenerator = new BABYLON.CascadedShadowGenerator(1024, lightCollection[2]);
var csmShadowGenerator2 = new BABYLON.CascadedShadowGenerator(1024, lightCollection[1]);
var csmShadowGenerator3 = new BABYLON.CascadedShadowGenerator(1024, lightCollection[3]);
var csmShadowGenerator4 = new BABYLON.CascadedShadowGenerator(1024, lightCollection[0]);
csmShadowGenerator.cascadeBlendPercentage = 0.52;
csmShadowGenerator2.cascadeBlendPercentage = 0.52;
csmShadowGenerator3.cascadeBlendPercentage = 0.52;
csmShadowGenerator4.cascadeBlendPercentage = 0.52;

csmShadowGenerator.stabilizeCascades = true;
csmShadowGenerator.autoCalcDepthBounds = true;
csmShadowGenerator.depthClamp = true;
csmShadowGenerator.lambda = 1;
csmShadowGenerator.darkness = 0.4;
csmShadowGenerator.normalBias = 0.09;



csmShadowGenerator2.stabilizeCascades = true;
csmShadowGenerator2.autoCalcDepthBounds = true;
csmShadowGenerator2.depthClamp = true;
    csmShadowGenerator2.lambda = 1;
    csmShadowGenerator2.darkness = 0.4;
    csmShadowGenerator2.normalBias = 0.09;
    csmShadowGenerator2.numCascades = 8;


    csmShadowGenerator3.stabilizeCascades = true;
csmShadowGenerator3.autoCalcDepthBounds = true;
    csmShadowGenerator3.depthClamp = true;
    csmShadowGenerator3.lambda = 1;
    csmShadowGenerator3.darkness = 0.4;
    csmShadowGenerator3.normalBias = 0.09;

    csmShadowGenerator4.stabilizeCascades = true;
csmShadowGenerator4.autoCalcDepthBounds = true;
    csmShadowGenerator4.depthClamp = true;
    csmShadowGenerator4.lambda = 1;
    csmShadowGenerator4.darkness = 0.4;
    csmShadowGenerator4.normalBias = 0.09;

}

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

				  

				  
				  var createHelix = function(helixMaterial = pvhPBRTextured,objectDiameter =0.3,offset = 20,helixPositionX = 0, helixPositionY = 0,helixPositionZ=0,stepLen = 50,name="Сепаратор по скрученным жилам",scaleParam) {
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

    if(scaleParam=='' || typeof scaleParam==='undefined') {
        var scaleParam = (objectDiameter / 1.55) - objectDiameter / stepLen;
    }
    helix.scaling ﻿= new BABYLON.Vector3(scaleParam,scaleParam,scaleParam);
    var direction = new BABYLON.Vector3(helixPositionX, helixPositionY/1.22, helixPositionZ);
    direction.normalize();
    helix.position.x = helixPositionX/1.7;
    helix.position.y = helixPositionY;
    helix.position.z = helixPositionZ;
    helix.translate(direction, 1, BABYLON.Space.WORLD);
    helix.rotate(new BABYLON.Vector3(0, 0, 1), 1.58, BABYLON.Space.WORLD);

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

var noAddHelix;


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


frameRotate = 60;
frameRotate = parseUri('frameRotate');
camera.setPosition(new BABYLON.Vector3(frameRotate, 0, frameRotate));


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
   // $.post('savepic.php', {name:'cab1',picfile:previewPic})
   var xhr = new XMLHttpRequest();
   if(typeof secondBody==='undefined') { secondBody='nb';}
   if(typeof noAddHelix==='undefined') { noAddHelix='na';}
   xhr.open('POST', '../savepic.php', true);
   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhr.send("name="+getTotalElems+""+innerElemsRadius+""+secondBody+""+noAddHelix+"&picfile=" + previewPic);
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

var getTotalElems, buildElemsDiameter;

getTotalElems = 19;
getTotalElems = parseUri('getTotalElems');

var buildRows = function(elemsToCut)
{
    var elemsLeft = elemsToCut;
    var buildRow = new Array();
    var rows = 0;
    var it = 0;
    while(elemsLeft>0) {
        it++;
        if(it>=12) { buildRow[rows] = it;  it = 0; rows = rows + 1;}
        if(elemsLeft<=1){ buildRow[rows] = it++;}
        elemsLeft--;
    }
    return buildRow;
}

var getRowsToBuild = buildRows(getTotalElems);

var options = [];


if(innerElemsRadius==1.5){buildElemsDiameter=0.6;}
if(innerElemsRadius==2.5){buildElemsDiameter=1;}

var opts = [];
opts[1.5] = {
    '19':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
}],
    '12':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
    }],
    '9':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}],
    '7':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}]


};


opts[2.5] = {
    '19':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
    }],
    '12':[{
        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0
    }],
    '9':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}],
    '7':[{        'length':3,
        'radius':buildElemsDiameter,
        'innerElemsRadius':buildElemsDiameter-0.3,
        'material':plasticPBRGrey,
        'cutmaterial':copperPBRTextured,
        'mod':0.1,
        'innerRadBase':1.3,
        'innerRad':1.009,
        'bodyMod':3.7,
        'helixDiameter':0,
        'secondHelixDiameter':0,
        'secondBodyDiameter':0,
        'skipStep':0,
        'xMod':0,
        'yMod':0.38,
        'zMod':0,
        'fixX':0,
        'fixY': 0,
        'fixZ': 0,
        'invertFirstRow': 1,
        'invertSecondRow':0}]


};

if(innerElemsRadius == 1.5)
{
    options =
        {
            'length':3,
            'radius':buildElemsDiameter,
            'innerElemsRadius':buildElemsDiameter-0.3,
            'material':plasticPBRGrey,
            'cutmaterial':copperPBRTextured,
            'mod':0.1,
            'innerRadBase':1.3,
            'innerRad':1.009,
            'bodyMod':3.7,
            'helixDiameter':0,
            'secondHelixDiameter':0,
            'secondBodyDiameter':0,
            'skipStep':0,
            'xMod':0,
            'yMod':0.38,
            'zMod':0,
            'fixX':0,
            'fixY': 0,
            'fixZ': 0,
            'invertFirstRow': 1,
            'invertSecondRow':0,
            'initLength': 6.25,
            'initLengthMod':0.95,
            'initCutLength':6.45,
            'initCutLengthMod': 0.95
        };
}

if(innerElemsRadius == 2.5)
{
    options =
        {
            'length':3,
            'radius':buildElemsDiameter,
            'innerElemsRadius':buildElemsDiameter-0.3,
            'material':plasticPBRGrey,
            'cutmaterial':copperPBRTextured,
            'mod':0.1,
            'innerRadBase':2.2,
            'innerRad':2,
            'bodyMod':5.6,
            'helixDiameter':0,
            'secondHelixDiameter':0,
            'secondBodyDiameter':0,
            'xMod':0,
            'yMod':0.39,
            'zMod':0,
            'fixX':0,
            'fixY': 0,
            'fixZ': 0,
            'invert': 0,
            'invertFirstRow': 1,
            'invertSecondRow':0,
            'initLength': 6.25,
            'initLengthMod':0.95,
            'initCutLength':6.45,
            'initCutLengthMod': 0.95
        };
}


var scaleParamFix;
var helixDiameter = 1;

var bodyResultDiameter = 0;

if(getTotalElems<9 && innerElemsRadius!=2.5) {
    bodyResultDiameter = Math.ceil(4 * getRowsToBuild.length);
}else if(getTotalElems<9 && innerElemsRadius==2.5)
{
    bodyResultDiameter = Math.ceil(3.6 * getRowsToBuild.length);
}else {
    bodyResultDiameter = Math.ceil(options.bodyMod * getRowsToBuild.length) + 0.5;
}


if(getTotalElems>12){
getRowsToBuild = getRowsToBuild.reverse();
}

if(getTotalElems==9) {
    getRowsToBuild = [5,4];
}

if(getTotalElems==12) {
    getRowsToBuild = [2,10];
}

if(innerElemsRadius==1.5) {
    helixDiameter = 1.96;
}else {
    helixDiameter = 2.86;
}

for(var i=0; i<getRowsToBuild.length;i++) {

    if(getTotalElems == 7)
    {
        options.innerRad = 0.6;
        options.innerRadBase = 0.8;
        options.yMod = 0.53;
        options.initLength = 4.45;
        options.initCutLength = 4.85;
    }

    if(getTotalElems == 7 && innerElemsRadius ==2.5)
    {
        options.innerRad = 1.8;
        options.innerRadBase = 1.8;
        options.yMod = 0.53;
        bodyResultDiameter += 0.7;
    }

    if (getTotalElems == 9) {
        helixDiameter = 0.8;
        scaleParamFix = 0.9;
        bodyResultDiameter +=-0;
        options.innerRad = 0.52;
        options.innerRadBase = 1;
        options.skipStep = 1;
        if(i==1) {
            options.yMod = 0.68;
            options.zMod = -1;
        }
    }

    if (getTotalElems == 12) {
        helixDiameter = 0.35;
        scaleParamFix = 0.35;
        bodyResultDiameter -= 1.;
        options.innerRad = 0.99;
        options.innerRadBase = 0.99;
        options.skipStep = 1;


        if (i == 0) {
          //  options.zMod = -0.28;
            options.yMod =  0.08
            options.invert = 1;
        }else{
            options.yMod = 0.38;
        }
    }


    if(getTotalElems==12 && innerElemsRadius == 2.5)
    {
        options.innerRad = 1.8;
        options.innerRadBase = 1.8;
    }


    if (getTotalElems == 9 && innerElemsRadius == 2.5) {
        options.innerRad = 1.25;
        options.innerRadBase = 2.05;
        bodyResultDiameter+=1;
        if (i == 0) {
            //  options.zMod = -0.28;
            options.yMod =  0.38
            options.invert = 1;
        }else{
            options.yMod = 0.38;
        }
        options.skipStep = 2;
        options.length = 2.5
    }
    if (getTotalElems == 7 && innerElemsRadius == 2.5) {
        options.zMod = 0;
        bodyResultDiameter += 1.5;
        options.skipStep = 2;
    }
    if(getTotalElems>7) {
        if (i == 0) {
            options.invert = options.invertFirstRow;
        } else {
            options.invert = options.invertSecondRow;
        }
    }
    if (getTotalElems != 12 && getTotalElems!=9) {
        createTubesUnOpt("Оболочка жилы",getRowsToBuild[i], options.radius, options.initLength - (i * options.initLengthMod), options.mod, options.material, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, options.skipStep, 2, options.xMod, options.yMod, options.zMod, '','',tubeFillings);
         if(innerElemsRadius==1.5) {
           var gtc = getAngle(10);
           for (var gcc = 0; gcc <= 10; gcc++) {
               var gco = getCoords(0.1, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
               var gco = getCoords(0.2, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
       }else {
           var gtc = getAngle(5);
           for (var gcc = 0; gcc <= 5; gcc++) {
               var gco = getCoords(0.1, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
           var gtc = getAngle(10);
           for (var gcc = 0; gcc <= 10; gcc++) {
               var gco = getCoords(0.2, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
           var gtc = getAngle(20);
           for (var gcc = 0; gcc <= 20; gcc++) {
               var gco = getCoords(0.35, gtc * gcc);
               createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength - (i * options.initCutLengthMod), options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
           }
       }
    } else {
        if(innerElemsRadius==1.5){ options.initLength = 4.45; options.initCutLength=4.95;}
        if(innerElemsRadius==2.5){ options.initLength = 5.55; options.initCutLength=6.05;}
        if(getTotalElems==12 && innerElemsRadius==1.5){ options.initLength = 4.45; options.initCutLength=4.95;}
        if(getTotalElems==12 && innerElemsRadius==2.5){ options.initLength = 4.55; options.initCutLength=5.05;}
        createTubesUnOpt('Оболочка жилы',getRowsToBuild[i], options.radius, options.initLength, options.mod, options.material, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, options.skipStep, 2, options.xMod, options.yMod, options.zMod, '','',tubeFillings);

        if(innerElemsRadius==1.5) {
            var gtc = getAngle(10);
            for (var gcc = 0; gcc <= 10; gcc++) {
                var gco = getCoords(0.1, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
                var gco = getCoords(0.2, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.05, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
        }else {
            var gtc = getAngle(5);
            for (var gcc = 0; gcc <= 5; gcc++) {
                var gco = getCoords(0.1, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
            var gtc = getAngle(10);
            for (var gcc = 0; gcc <= 10; gcc++) {
                var gco = getCoords(0.2, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
            var gtc = getAngle(20);
            for (var gcc = 0; gcc <= 20; gcc++) {
                var gco = getCoords(0.35, gtc * gcc);
                createTubesUnOpt('',getRowsToBuild[i], 0.09, options.initCutLength, options.mod, copperPBRTextured, 0, 0 + options.fixY, 0 + options.fixZ, options.innerRadBase + (i * options.innerRad), options.length, options.invert, 4, 2, options.xMod, options.yMod + gco.y, options.zMod + gco.z, '', '', false, 3);
            }
        }
    }
}

if(getTotalElems!=9 && innerElemsRadius!=2.5){
    helixDiameter = helixDiameter - ((19 - getTotalElems)/10);
}else {
    helixDiameter = Math.ceil(helixDiameter - ((19 - getTotalElems)/10));
}

if(!getUriParam('secondBody',location.href)){
    var scaleParamFix = 1.25
    if(innerElemsRadius==2.5 && getTotalElems==19)
    {
        scaleParamFix = 1.95;
    }
    if(getTotalElems==7){ helixDiameter = 0.8; scaleParamFix = 0.9; bodyResultDiameter +=1.8; options.innerRad = 1.1; options.innerRadBase = 1.2; options.skipStep=1; }
    if(getTotalElems==9){ helixDiameter = 0.8; scaleParamFix = 1; bodyResultDiameter +=1.9; options.innerRad = 1.5; options.innerRadBase = 1.3; options.skipStep=1; options.zMod =0.9;}
    if(getTotalElems==9 && innerElemsRadius == 2.5) { scaleParamFix = 1.8; bodyResultDiameter+=1.15;}
    if(getTotalElems==7 && innerElemsRadius == 2.5) { scaleParamFix = 1.2;}
    if(getTotalElems==12) { scaleParamFix = 1.11; bodyResultDiameter+=1;}
    if(getTotalElems==12 && innerElemsRadius == 2.5) { scaleParamFix = 1.75; bodyResultDiameter+=1;}
    createCableFilling(0, 60, bodyMaterial, bodyResultDiameter, bodyResultDiameter, bodyResultDiameter, '', '', '',
        -10, 0, 0, '', '', cableFillings, 'Оболочка кабеля');
    createHelix(plenkaPBRTextured, helixDiameter, 20, 40, 0, 0, 50,'Сепаратор по скрученным жилам',scaleParamFix);
}else {
    var cablePosX = -17;
    var cableAddPosX = 4;
    var fillPosX = 28;
    var fillAddPosX = 42;

    if(getTotalElems==19 && innerElemsRadius==2.5){
        cablePosX = -25;
        cableAddPosX = -1.7;
        fillPosX = 16;
        fillAddPosX = 35;
        bodyResultDiameter+=2;
    }
    if(getTotalElems==19 && innerElemsRadius==1.5){bodyResultDiameter+=2; }
    if(getTotalElems == 7) { bodyResultDiameter+=1;}
    if(getTotalElems==7 && innerElemsRadius==2.5){bodyResultDiameter+=2; }
    if(getTotalElems==9 && innerElemsRadius==1.5){bodyResultDiameter+=2.28;scaleParamFix+=0.1 }
    if(getTotalElems==9 && innerElemsRadius==2.5){bodyResultDiameter+=3; scaleParamFix=1.63; }
   if(getTotalElems==12) { scaleParamFix = 1.1; bodyResultDiameter+=1;}
    if(getTotalElems==12 && innerElemsRadius == 2.5) { scaleParamFix = 1.73; bodyResultDiameter+=1;}

    createCableFilling(0, 60, bodyMaterial, bodyResultDiameter+0.55, bodyResultDiameter+0.55, bodyResultDiameter+0.55, '', '', '',
        cablePosX, 0, 0, '', '', cableFillings, 'Оболочка кабеля');
    if(getTotalElems==7 && innerElemsRadius==2.5){helixDiameter -=0.52;}

  if(parseUri('noAddHelix')!=1) {
      createHelix(blackLightPBRTexturedHelix, helixDiameter + 0.38, 20, fillAddPosX, 0, 0, 50, 'Лента из прорезиненной ткани ', scaleParamFix);
  }else {
      createHelix(blackLightPBRTexturedHelix, helixDiameter + 0.38, 20, fillAddPosX, 0, 0, 50, 'Сепаратор по скрученным жилам ', scaleParamFix);
  }

    if(getTotalElems==7 && innerElemsRadius==1.5)    { helixDiameter += 0.34; }
    if(getTotalElems==7 && innerElemsRadius==2.5){helixDiameter +=0.64;}
    if(getTotalElems==9 && innerElemsRadius==1.5){scaleParamFix=1.1;}
    if(getTotalElems==9 && innerElemsRadius==2.5){scaleParamFix=1.91;}
    if(getTotalElems==19 && innerElemsRadius==1.5){scaleParamFix=1.7; }
    if(getTotalElems==19 && innerElemsRadius == 2.5) { scaleParamFix = 2.39;}
    if(getTotalElems==12) { scaleParamFix = 1.2;}
    if(getTotalElems==12 && innerElemsRadius == 2.5) { scaleParamFix = 2.09; bodyResultDiameter+=0;}

    if(parseUri('noAddHelix')!=1) {
        createHelix(plenkaPBRTextured, helixDiameter + 0.34, 20, fillPosX, 0, 0, 40, 'Сепаратор по скрученным жилам', scaleParamFix);
    }
    if(parseUri('noAddHelix')!=1) {
        createCableFilling(0, 33, blackLightPBRTextured, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, '', '', '',
            cableAddPosX, 0, 0, '', '', cableFillings, 'Дополнительная оболочка');
    }else {
        createCableFilling(0, 33, blackPBRTextured, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, bodyResultDiameter - 0.5, '', '', '',
            cableAddPosX, 0, 0, '', '', cableFillings, 'Дополнительная оболочка');
    }
}

// ############################################################################################# ///

if(getTotalElems>12) {
    createCableFilling(0, 40, blackLightPBRTextured, innerElemsRadius - 0.3, innerElemsRadius - 0.3, innerElemsRadius - 0.3, '', '', '',
        20, 0, 0, '', '', cableFillings, 'Изоляция упрочняющего сердечника');
    createCableFilling(0, 43, ropePBR, innerElemsRadius - 0.6, innerElemsRadius - 0.6, innerElemsRadius - 0.6, '', '', '',
        20, 0, 0, '', '', cableFillings, 'Упрочняющий сердечник');
}else
{
    if(innerElemsRadius==1.5) {
        createCableFilling(0, 20, blackLightPBRTextured, innerElemsRadius - 0.3, innerElemsRadius - 0.3, innerElemsRadius - 0.3, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Изоляция упрочняющего сердечника');
        createCableFilling(0, 23, ropePBR, innerElemsRadius - 0.6, innerElemsRadius - 0.6, innerElemsRadius - 0.6, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Упрочняющий сердечник');
    }else {
        createCableFilling(0, 25, blackLightPBRTextured, innerElemsRadius - 0.3, innerElemsRadius - 0.3, innerElemsRadius - 0.3, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Изоляция упрочняющего сердечника');
        createCableFilling(0, 28, ropePBR, innerElemsRadius - 0.6, innerElemsRadius - 0.6, innerElemsRadius - 0.6, '', '', '',
            20, 0, 0, '', '', cableFillings, 'Упрочняющий сердечник');
    }
}



if(getTotalElems>10) {
    for (var randRecolor = 0; randRecolor < 3; randRecolor++) {
        reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRLightBlue);
        reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRPink);
    }
    reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRGround);
}
if(getTotalElems<=10){
    for (var randRecolor = 0; randRecolor < 2; randRecolor++) {
        reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRLightBlue);
    }
    reColorElems(tubeFillings[getRandomInt(randRecolor, tubeFillings.length - 1)], plasticPBRGround);
}

var pipeLineSamples = 2;
pipeLineSamples = parseUri('pipeLineSamples');


var pipeline = new BABYLON.DefaultRenderingPipeline(
    "defaultPipeline", // The name of the pipeline
    true, // Do you want the pipeline to use HDR texture?
    scene, // The scene instance
    [camera] // The list of cameras to be attached to
);
pipeline.samples = pipeLineSamples;
pipeline.bloomEnabled = true;
pipeline.bloomThreshold = 0.6;
pipeline.bloomWeight = 0.05;
pipeline.bloomKernel = 2;
pipeline.bloomScale = 0.5;
pipeline.fxaaEnabled = true;


pipeline.depthOfFieldEnabled = false;
pipeline.depthOfFieldBlurLevel = BABYLON.DepthOfFieldEffectBlurLevel.Low;

pipeline.depthOfField.focusDistance  = 3094.3; // distance of the current focus point from the camera in millimeters considering 1 scene unit is 1 meter
pipeline.depthOfField.focalLength  = 225.5; // focal length of the camera in millimeters
pipeline.depthOfField.fStop  = 23.7; // aka F number of the camera defined in stops as it would be on a physical device

pipeline.grainEnabled = true;
pipeline.grain.intensity = 5.3;



highLight = new BABYLON.HighlightLayer("highLight", scene);

var babGreen = new BABYLON.Color3.Green();

var result;
var hlCounter=0;
var onPointerMove = function(e) {
    result = scene.pick(scene.pointerX, scene.pointerY);
    if (result.hit) {
        if(hlCounter>0) {
            for (var xkl = 0; xkl < scene.meshes.length; xkl++) {
                removeColorPulser(scene.getMeshByID(scene.meshes[xkl].id));
                highLight.removeMesh(scene.meshes[xkl]);

            }
        }
        hlCounter= hlCounter+1;
        if(result.pickedMesh.id != prevHighLight) {
            if(result.pickedMesh.name!='Токопроводящая жила') {
                highLight.addMesh(scene.getMeshByID(result.pickedMesh.id), babGreen);
            }else {
                colorPulser(scene.getMeshByID(result.pickedMesh.id));
            }
            prevHighLight =scene.getMeshByID(result.pickedMesh.id);
            //  colorPulser(scene.getMeshByID(result.pickedMesh.id));
            document.getElementById('info').textContent = result.pickedMesh.name;
            document.getElementById('info').style.display = 'block';
        }else {
            scene.getMeshByID(result.pickedMesh.id)
        }

    }else {
        if(hlCounter>0) {
            for (var xkl = 0; xkl < scene.meshes.length; xkl++) {
                removeColorPulser(scene.getMeshByID(scene.meshes[xkl].id));
                highLight.removeMesh(scene.meshes[xkl]);

            }
            hlCounter=0;
        }

        document.getElementById('info').style.display='none';

    }
}

canvas.addEventListener("pointermove", onPointerMove, false);
var alpha = .2;
var colorPulser = function(mesh) {
;
if(typeof mesh === 'undefined' || mesh=='' || !mesh){ return false;}
    if(mesh.hasOwnProperty('object'))
    {
        mesh.object.material.emissiveColor = new BABYLON.Color3.Green();
    }else {
        mesh.material.emissiveColor = new BABYLON.Color3.Green();
    }
};

var removeColorPulser = function(mesh)
{
    if(typeof mesh === 'undefined' || mesh=='' || !mesh){ return false;}
    mesh.material.emissiveColor =new BABYLON.Color3(0,0,0);
}




/*
var options = new BABYLON.SceneOptimizerOptions(30,900);
options.addOptimization(new BABYLON.HardwareScalingOptimization(0,1));
//options.addOptimization(new BABYLON.HardwareScalingOptimization(10,2));
options.addOptimization(new BABYLON.TextureOptimization(20));
options.addOptimization(new BABYLON.ShadowsOptimization(30));
//options.addOptimization(new BABYLON.MergeMeshesOptimization(40));
options.addCustomOptimization(function () {
    camera.checkCollisions = false;
    scene.collisionsEnabled = false;

    blackPBRTextured.bumpTexture = null;
    blackPBRTextured.enableSpecularAntiAliasing = false;
    blackPBRTextured.sheen.isEnabled = false;


    copperPBRTextured.bumpTexture = null;
    copperPBRTextured.enableSpecularAntiAliasing = false;
    copperPBRTextured.sheen.isEnabled = false;

    blackLightPBRTextured.bumpTexture = null;
    blackLightPBRTextured.enableSpecularAntiAliasing = false;
    blackLightPBRTextured.sheen.isEnabled = false;

    blackPBRTexturedShiny.bumpTexture = null;
    blackPBRTexturedShiny.enableSpecularAntiAliasing = false;
    blackPBRTexturedShiny.sheen.isEnabled = false;

    plasticPBRLightBlue.bumpTexture = null;
    plasticPBRLightBlue.enableSpecularAntiAliasing = false;
    plasticPBRLightBlue.sheen.isEnabled = false;

    plasticPBRGrey.bumpTexture = null;
    plasticPBRGrey.enableSpecularAntiAliasing = false;
    plasticPBRGrey.sheen.isEnabled = false;

    plasticPBRPink.bumpTexture = null;
    plasticPBRPink.enableSpecularAntiAliasing = false;
    plasticPBRPink.sheen.isEnabled = false;

    return true;
}, function () {
    return "Turning bump off";
});

// Optimizer
var optimizer = new BABYLON.SceneOptimizer(scene, options);
setTimeout(function () {
    optimizer.start();
},3000);
/*
BABYLON.SceneOptimizer.OptimizeAsync(scene, BABYLON.SceneOptimizerOptions.HighDegradationAllowed(),
    function() {
        // On success
      //  alert('Всё ок')
    }, function() {
       alert('Ваша графическая карта не обеспечивает должный FPS. Пожалуйста, выйдите!');
    });*/
				  
                    
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
</html>