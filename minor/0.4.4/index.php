<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <title>Кабель-генератор</title>
        <!--- Link to the last version of BabylonJS --->
      <!--  <script src="https://cdn.babylonjs.com/babylon.js"></script>
        <script src="https://cdn.babylonjs.com/loaders/babylonjs.loaders.min.js"></script>
        <script src="https://cdn.babylonjs.com/gui/babylon.gui.min.js"></script>-->
        
        <script src="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.js"></script>
        <link rel="preload" href="https://cdn.jsdelivr.net/gh/loadingio/ldLoader@v1.0.0/dist/ldld.min.css" as="style">

        <script src="../../js/babylon.js"></script>
        
         <script src="../../js/babylonjs.loaders.min.js"></script>
        <script src="../../js/babylon.gui.min.js"></script>
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
                display:   none;
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
             setTimeout(function(){ document.getElementById('my-loader').remove();},7000);
            });
        </script>
    </head>
    <body>
    <div id="my-loader" class="loader">
        <img src="Infinity-1s-200px (1).svg">
    </div>
    <div id="info" style="position: absolute; width:auto;top:5vh; left:45%; height:auto; padding: 20px; display: none; background-color: #336699; border-color: #336699;    color: #ffffff;"></div>
        <canvas id="renderCanvas"></canvas>
        <script>
            window.addEventListener('DOMContentLoaded', function() {

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
					var engine = new BABYLON.Engine(canvas, true);

					// createScene function that creates and return the scene

					var delayCreateScene = function() {
						// Create a scene.
						var scene = new BABYLON.Scene(engine);
					//	scene.enablePhysics();

                    var nullLinePBRTextured = new BABYLON.PBRMaterial("pbrpl", scene);
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


var plusLinePBRTextured = new BABYLON.PBRMaterial("pbrpl", scene);
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

var groundLinePBRTextured = new BABYLON.PBRMaterial("pbrpl", scene);
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

var pvhPBRTextured = new BABYLON.PBRMaterial("pvh_pbr",scene);
pvhPBRTextured.albedoColor = new BABYLON.Color3(1.0,1.0,1.0);
pvhPBRTextured.reflectivityColor = new BABYLON.Color3(1.9, 1.9, 1.9);
pvhPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png",scene);
pvhPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_roughness.png", scene);
pvhPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
pvhPBRTextured.bumpTexture.level = 0.2;
pvhPBRTextured.metallic = 1.3;
pvhPBRTextured.roughness = 0.8;


var alumPBRTextured = new BABYLON.PBRMaterial('alum_textured',scene);
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


var alumLightPBRTextured = new BABYLON.PBRMaterial('alum_textured',scene);
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


var copperPBR = new BABYLON.PBRMetallicRoughnessMaterial("pbrCop", scene);
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


var blackPBRTextured = new BABYLON.PBRMaterial("black", scene);
blackPBRTextured.albedoColor = new BABYLON.Color3(0, 0,0);
blackPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
blackPBRTextured.bumpTexture.level = 0.3;
blackPBRTextured.microSurface = 1;
blackPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
blackPBRTextured.metallic = 0.4;
blackPBRTextured.roughness = 0.2;

var blackLightPBRTextured = new BABYLON.PBRMaterial("black", scene);
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


var copperPBRTextured = new BABYLON.PBRMaterial("copper", scene);
copperPBRTextured.albedoTexture = new BABYLON.Texture("../../copper_new.jpg", scene);
copperPBRTextured.albedoColor = new BABYLON.Color3(0.25,0.25,0.25);
copperPBRTextured.metallicTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
copperPBRTextured.reflectionTexture = new  BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_albedo.png", scene);
copperPBRTextured.microSurface = 1;
copperPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
copperPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
copperPBRTextured.bumpTexture.level = 0.8;
copperPBRTextured.metallic = 0.9;
copperPBRTextured.roughness = 0.5;
copperPBRTextured.sheen.isEnabled = true;
copperPBRTextured.sheen.intensity = 0;
copperPBRTextured.anisotropy.isEnabled = true;
copperPBRTextured.anisotropy.intensity = 0.1;
copperPBRTextured.enableSpecularAntiAliasing = true;

var copperLightPBRTextured = new BABYLON.PBRMaterial("copper", scene);
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


var plenkaPBRTextured = new BABYLON.PBRMaterial("plenka",scene);
plenkaPBRTextured.albedoColor = new BABYLON.Color3(1,1,0.878);
plenkaPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
plenkaPBRTextured.bumpTexture.level = 1;
plenkaPBRTextured.microSurface = 1;
plenkaPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
plenkaPBRTextured.reflectionTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_metallic.png",scene);
plenkaPBRTextured.metallic = 1;
plenkaPBRTextured.roughness = 0.5;
plenkaPBRTextured.alpha = 0.6;


var copperPBRNew =  new BABYLON.PBRMaterial("copperpbr",scene);
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



var plasticPBRGrey = new BABYLON.PBRMaterial("plasticpbr",scene);
plasticPBRGrey.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb.png");
plasticPBRGrey.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRGrey.microSurface = 1;
plasticPBRGrey.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
plasticPBRGrey.metallic = 0.2;
plasticPBRGrey.roughness = 0.7;
plasticPBRGrey.sheen.isEnabled = true;
plasticPBRGrey.sheen.intensity = 0.1;


var plasticPBRBlue = new BABYLON.PBRMaterial("plasticpbr",scene);
plasticPBRBlue.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic8-alb.png");
plasticPBRBlue.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRBlue.bumpTexture.level =2
plasticPBRBlue.microSurface = 3;
plasticPBRBlue.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
plasticPBRBlue.metallic = 0.2;
plasticPBRBlue.roughness = 0.5;
plasticPBRBlue.sheen.isEnabled = true;
plasticPBRBlue.sheen.intensity = 0.2;

var plasticPBRBlack = new BABYLON.PBRMaterial("plasticpbr",scene);
plasticPBRBlack.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic7-alb.png");
plasticPBRBlack.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRBlack.microSurface = 0.5;
plasticPBRBlack.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
plasticPBRBlack.metallic = 0.15;
plasticPBRBlack.roughness = 0.5;
plasticPBRBlack.sheen.isEnabled = true;
plasticPBRBlack.sheen.intensity = 0.2;

var plasticPBRGround = new BABYLON.PBRMaterial("plasticpbr",scene);
plasticPBRGround.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic9-alb.png");
plasticPBRGround.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRGround.microSurface = 0.5;
plasticPBRGround.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
plasticPBRGround.metallic = 0.15;
plasticPBRGround.roughness = 0.5;
plasticPBRGround.sheen.isEnabled = true;
plasticPBRGround.sheen.intensity = 0.2;


var plasticPBRPink = new BABYLON.PBRMaterial("plasticpbr",scene);
plasticPBRPink.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic10-alb.png");
plasticPBRPink.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRPink.microSurface = 0.5;
plasticPBRPink.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.png",scene);
plasticPBRPink.metallic = 0.15;
plasticPBRPink.roughness = 0.5;
plasticPBRPink.sheen.isEnabled = true;
plasticPBRPink.sheen.intensity = 0.2;

var plasticPBRLightBlue = new BABYLON.PBRMaterial("plasticpbr",scene);
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
ropePBR.microSurface = 0.5;
ropePBR.microSurfaceTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Displacement.jpg",scene);
ropePBR.metallic = 0.15;
ropePBR.roughness = 0.5;
ropePBR.sheen.isEnabled = true;
ropePBR.sheen.intensity = 0.2;
ropePBR.metallicTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Metalness.jpg",scene);

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


var highLight;
var prevHighLight;

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
        tessellation : 64,
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
       createTubes(10,innerElemsRadius/(elemCount*1.1) ,10,'','',elemCoords.x/2.5,elemCoords.y,elemCoords.z);
       }else {
           createTubes(10,innerElemsRadius/(elemCount*1.1),10,'','',elemCoords.x/1.4,elemCoords.y,elemCoords.z);
       }
   }
}

var realBias = function (val,offs) {

    var rdm = getRandomInt(0,3);
    if(rdm==0)
    {
        val = val + offs;
        console.log('ofb');
    }else {
        console.log('bb');
        val = val -  offs;
    }

    return val;

}

var scaleBias = function (obj,offs) {

    var rdm = getRandomInt(0,3);
    if(rdm==0)
    {
        obj.scale.y-=0.1;
        console.log('ofb');
    }else {
       obj.scale.y+=0.1;
    }

}

var buildFlatCable = function(rad,elems)
{
    var coordsUpLeft = getCoords(rad,315);
    var coordsStart = getCoords(rad,315);

    coordsStart.x = bodyLength*1.6;

    for(var i=0;i<4;i++)
    {
        var cabLen = getRandomInt(4, 9);
        if(i==0){cabLen = 12;}
        var z_offset = realBias(coordsStart.z+ (1.4*i),0.05);
        createCableFilling(0,cabLen,'',1.5,1.5,1.5,'',
            '','',coordsStart.x,coordsStart.y,z_offset);
        createCableFilling(0,cabLen+1,copperPBRNew,1,1,1,'',
            '','',coordsStart.x+2,coordsStart.y,z_offset,'','',cutFillings);
    }

    for(var i=0;i<5;i++)
    {      
        var cabLen = getRandomInt(4, 9);
        if(i==0){cabLen = 12;}
        
        if(i!=2) {
            var z_offset = realBias(coordsStart.z + (1.5 * i), 0.1);
            var y_offset = realBias(coordsStart.y - 1.3, 0.2);
            createCableFilling(0, cabLen, '', 1.5, 1.5, 1.5, '',
                '', '', coordsStart.x, y_offset, z_offset);
            createCableFilling(0, cabLen, copperPBRNew, 1, 1, 1, '',
                '', '', coordsStart.x + 5, y_offset, z_offset, '', '', cutFillings);
        }else {
            var z_offset = realBias(coordsStart.z + (1.5 * i), 0.1);
            var y_offset = realBias(coordsStart.y - 1.3, 0.2);
            createCableFilling(0, 14, pvhPBRTextured, 1, 1, 1, '',
                '', '', coordsStart.x+2, y_offset, z_offset,'','',cutFillings);
            createCableFilling(0, 18, ropePBR, 0.8, 0.8, 0.8, '',
                '', '', coordsStart.x+2, y_offset, z_offset,'','',cutFillings);
        }

    }

    for(var i=0;i<5;i++)
    {
        var cabLen = getRandomInt(4, 9);
        if(i==0){cabLen = 12;}
        var z_offset = realBias((coordsStart.z-0.75) + (1.5*i),0.2);
        var y_offset =realBias( coordsStart.y-2.6,0.2);
        createCableFilling(0,getRandomInt(6,9),'',1.5,1.5,1.5,'',
            '','',coordsStart.x,y_offset,z_offset);
        createCableFilling(0,getRandomInt(6,9),copperPBRNew,1,1,1,'',
            '','',coordsStart.x+5,y_offset,z_offset,'','',cutFillings);
    }

    for(var i=0;i<4;i++)
    {
        var cabLen = getRandomInt(4, 9);
        if(i==0){cabLen = 12;}

        var z_offset = realBias(coordsStart.y - (1.5*i),0.05);
        var y_offset =realBias( coordsStart.z+0.9,0.1);
        createCableFilling(0,getRandomInt(6,9),'',1.5,1.5,1.5,'',
            '','',coordsStart.x,y_offset,z_offset);
        createCableFilling(0,getRandomInt(6,9),copperPBRNew,1,1,1,'',
            '','',coordsStart.x+5,y_offset,z_offset,'','',cutFillings);
    }

    for(var i=0;i<2;i++)
{
    var cabLen = getRandomInt(4, 9);
    if(i==0){cabLen = 9;}
    
    var z_offset = realBias((coordsStart.y - (1.5*i))-2,0.05);
    var y_offset =realBias( coordsStart.z,0.1);
    createCableFilling(0,getRandomInt(6,9),'',1.5,1.5,1.5,'',
        '','',coordsStart.x,y_offset,z_offset);
   // createCableFilling(0,getRandomInt(6,9),copperPBRNew,1,1,1,'',
     //   '','',coordsStart.x+5,y_offset,z_offset,'','',cutFillings);
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



var createMainBody = function(length,diameter,diameterTop,diameterBottom,mat=blackPBRTextured)
{
    bodyMainCylinder = BABYLON.MeshBuilder.CreateCylinder("Внешняя оболочка", {
        height : length*3,
        diameterTop : diameter,
        diameterBottom : diameter,
        tessellation : 128
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


var createTubes = function(count,radius = 0.2,steps=10,mod=0.5,mat = copperPBRTextured,positionX,positionY,positionZ)
{
    for(var i=1; i<=count;i++)
    {
        var tube = BABYLON.MeshBuilder.CreateTube("Токопроводящая жила", {
            path: otherCurve('',0.25,3,5,1), radius: radius, sideOrientation: BABYLON.Mesh.DOUBLESIDE, updatable: true,
            cap: BABYLON.Mesh.CAP_ALL
        }, scene);
        tube.material = copperPBRTextured;
        tube.position.x = positionX;
        tube.position.y = positionY
        tube.position.z =positionZ;

        tube.rotation.x = i;
            tube.id = tube.id+getRandomInt(1,1000000);
    }
}


//Главная оболочка
//@bodyMainLength = bml;
//@bodyDiameter = bd;
//@bodyDiameterTop  = bdt;
//@bodyDiameterBottom  = bdb;
if(getUriParam('bml',location.href)) { bodyLength = getUriParam('bml',location.href);}


						//scene.createDefaultCamera(true, true, true);
//scene.activeCamera.alpha += Math.PI;

// Parameters: name, alpha, beta, radius, target position, scene
var camera = new BABYLON.ArcRotateCamera("Camera", 0, 0, 0, new BABYLON.Vector3(0, 0,0), scene);
// Positions the camera overwriting alpha, beta, radius
camera.setPosition(new BABYLON.Vector3(60, 0, 60));
// This attaches the camera to the canvas
camera.attachControl(canvas, true);
camera.minZ = 0.05;
camera.lowerRadiusLimit = 0.7;
camera.upperRadiusLimit = 100;
camera.wheelDeltaPercentage = 0.01;
//var layer = new BABYLON.Layer('','https://fwlogistics.com/wp-content/uploads/2019/09/FWL_Sept_BlogImages_1_Warehouse.jpg', scene, true);
scene.clearColor = new BABYLON.Color3(0.85, 0.85, 0.85);               
				   
				  							 
				 
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

				  

				  
				  var createHelix = function(helixMaterial = pvhPBRTextured,objectDiameter =0.3,offset = 20,helixPositionX = 0, helixPositionY = 0,helixPositionZ=0,stepLen = 50) {
    pathHelix = [];
    for (var i = 0; i <= stepLen; i++) {
        var v = 2.0 * Math.PI * i / 20;
        pathHelix.push(new BABYLON.Vector3(3 * Math.cos(v), i / 4, 3 * Math.sin(v)));
    }

    var helix = BABYLON.MeshBuilder.CreateRibbon("Сепаратор по скрученным жилам", {
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


var firstRowMaterial,secondRowMaterial,globalWireMaterial;
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

globalWireMaterial =  parseUri('globalWireMaterial');
firstRowMaterial = parseUri('firstRowMaterial','fRowMat');
secondRowMaterial = parseUri('secondRowMaterial','sRowMat');

if(typeof globalWireMaterial!='undefined' && globalWireMaterial!='')
{
  firstRowMaterial = globalWireMaterial;
  secondRowMaterial  = globalWireMaterial;
}

bodyDiameter = elemsFirstRow;

if(getUriParam('bodyMainDiameter',location.href))
{
 bodyDiameter = getUriParam('bodyMainDiameter',location.href);
 bodyDiameterTop = getUriParam('bodyMainDiameter',location.href);
 bodyDiameterBottom = getUriParam('bodyMainDiameter',location.href);
}

if(getUriParam('innerElemsRadius',location.href))
{
  innerElemsRadius = getUriParam('innerElemsRadius',location.href);
}

var magicParam = 3.08;
var curSpacing = 3.08 - innerElemsRadius;

var bodyModifier = 0.5;

bodyModifier = parseUri('bodyModifier','diameterMod');

bodyDiameter = bodyDiameter * innerElemsRadius * bodyModifier;
createMainBody(bodyLength,bodyDiameter,bodyDiameter,bodyDiameter);


if(getUriParam('secondBody',location.href))
{
 bodyMainCylinder.position.x=-6;
 createCableFilling(0,bodyLength,blackLightPBRTextured,bodyDiameter-0.5,bodyDiameter-0.5,bodyDiameter-0.5,
     'helix',plenkaPBRTextured,0,bodyLength*1.2,0,0,'','',cutFillings,'Дополнительная оболочка для защиты от скручивания');
 createHelix(plenkaPBRTextured,bodyDiameter/3.9,20,20,0,0,50);
 createHelix(plenkaPBRTextured,bodyDiameter/4.1,20,30,0,0,50);
}else {
 createHelix(plenkaPBRTextured,bodyDiameter/3.9,20,30,0,0,50);
}



buildCable(elemsFirstRow,innerElemsRadius,bodyDiameter/3.08,8);
buildCable(elemsSecondRow,innerElemsRadius,bodyDiameter/5.5,18,15,1);

createCableFilling(1,bodyLength*2.5,blackLightPBRTextured,6,6,6,'','','',
    bodyLength*1.6,0,0,'','','','Изоляция упрочняющего сердечника');
 createCableFilling(1,bodyLength*2.7,ropePBR,5,5,5,'','','',
     bodyLength*1.6,0,0,'','','','Упрочняющий сердечник');



let totalElems = elemsFirstRow + elemsSecondRow;

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

highLight = new BABYLON.HighlightLayer("highLight", scene);

var onPointerMove = function(e) {
 if(prevHighLight!='' && typeof prevHighLight != 'undefined'){
 /*highLight.removeMesh(prevHighLight);
  for(var k=0; k<scene.meshes.length;k++)
  {
    highLight.removeExcludedMesh(scene.meshes[k]);
  }*/
  removeColorPulser(prevHighLight);
  document.getElementById('info').style.display='none';
 }
 var result = scene.pick(scene.pointerX, scene.pointerY);
 if (result.hit) {
  if(result.pickedMesh.id != prevHighLight) {
  /* for(var k=0; k<scene.meshes.length;k++)
   {
     if(result.pickedMesh.id != scene.meshes[k].id) {
      highLight.addExcludedMesh(scene.meshes[k]);
     }else {
      highLight.addMesh(scene.meshes[k], new BABYLON.Color3.Green());
     }
   }*/
   prevHighLight = result.pickedMesh;
   colorPulser(scene.getMeshByID(result.pickedMesh.id));
   document.getElementById('info').textContent = result.pickedMesh.name;
   document.getElementById('info').style.display = 'block';
  }else {

  }
 }
}

canvas.addEventListener("pointermove", onPointerMove, false);
var alpha = .2;
var colorPulser = function(mesh) {
 mesh.material.emissiveColor = new BABYLON.Color3.Green();
};

var removeColorPulser = function(mesh)
{
 mesh.material.emissiveColor = new BABYLON.Color3(0,0,0);
}
				  
                    
                    //     camera.setPosition(new BABYLON.Vector3(0, 0, 5));
                    return scene;
                };

                // call the createScene function
                var scene = delayCreateScene();

                // run the render loop
                engine.runRenderLoop(function() {
                    scene.render();
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