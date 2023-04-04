/*var nullLinePBRTextured = new BABYLON.PBRMaterial("nullLinePBRTextured", scene);
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
copperPBR.microSurfaceTexture =  new BABYLON.Texture("../../copper_new_bmp.png", scene);*/

var blackPBRTextured = new BABYLON.PBRMaterial("blackPBRTextured", scene);
blackPBRTextured.albedoColor = new BABYLON.Color3(0, 0,0);
if(location.href.indexOf('noBump')==-1) blackPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
if(location.href.indexOf('noBump')==-1) blackPBRTextured.bumpTexture.level = 0.1;
if(location.href.indexOf('noBump')==-1) blackPBRTextured.microSurface = 1;
if(location.href.indexOf('noBump')==-1) blackPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
blackPBRTextured.metallic = 0.16;
blackPBRTextured.roughness = 0.42;
blackPBRTextured.enableSpecularAntiAliasing = true;
blackPBRTextured.environmentIntensity = 0.64;
blackPBRTextured.sheen.isEnabled = true;
blackPBRTextured.sheen.intensity = 0.13;
blackPBRTextured.directIntensity = 0.56;
blackPBRTextured.specularIntensity = 0.536;
blackPBRTextured.freeze();



var blackPBRTexturedShiny = new BABYLON.PBRMaterial("blackPBRTexturedShiny", scene);
blackPBRTexturedShiny.albedoColor = new BABYLON.Color3(0, 0,0);
if(location.href.indexOf('noBump')==-1) blackPBRTexturedShiny.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
if(location.href.indexOf('noBump')==-1) blackPBRTexturedShiny.bumpTexture.level = 0.1;
if(location.href.indexOf('noBump')==-1) blackPBRTexturedShiny.microSurface = 1;
if(location.href.indexOf('noBump')==-1) blackPBRTexturedShiny.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
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
if(location.href.indexOf('noBump')==-1) blackLightPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
if(location.href.indexOf('noBump')==-1) blackLightPBRTextured.bumpTexture.level = 0.8;
if(location.href.indexOf('noBump')==-1) blackLightPBRTextured.microSurface = 1;
if(location.href.indexOf('noBump')==-1) blackLightPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
blackLightPBRTextured.metallic = 0.1;
blackLightPBRTextured.roughness = 0.7;
blackLightPBRTextured.sheen.isEnabled = true;
blackLightPBRTextured.sheen.intensity = 0.2;
blackLightPBRTextured.anisotropy.isEnabled = true;
blackLightPBRTextured.anisotropy.intensity = 0.6;
blackLightPBRTextured.enableSpecularAntiAliasing = true;


var blackLightPBRTexturedHelix = new BABYLON.PBRMaterial("blackLightPBRTexturedHelix", scene);
blackLightPBRTexturedHelix.albedoColor = new BABYLON.Color3(0.007, 0.007,0.007);
if(location.href.indexOf('noBump')==-1) blackLightPBRTexturedHelix.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
if(location.href.indexOf('noBump')==-1) blackLightPBRTexturedHelix.bumpTexture.level = 0.8;
if(location.href.indexOf('noBump')==-1) blackLightPBRTexturedHelix.microSurface = 1;
if(location.href.indexOf('noBump')==-1) blackLightPBRTexturedHelix.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
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
if(location.href.indexOf('noBump')==-1) copperPBRTextured.microSurface = 1;
if(location.href.indexOf('noBump')==-1) copperPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
if(location.href.indexOf('noBump')==-1) copperPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
if(location.href.indexOf('noBump')==-1) copperPBRTextured.bumpTexture.level = 0.8;
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
/*
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

*/
var plenkaPBRTextured = new BABYLON.PBRMaterial("plenkaPBRTextured",scene);
plenkaPBRTextured.albedoColor = new BABYLON.Color3(0.5,0.5,0.5);
if(location.href.indexOf('noBump')==-1) plenkaPBRTextured.bumpTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/NormalMap.png",scene);
if(location.href.indexOf('noBump')==-1) plenkaPBRTextured.bumpTexture.level = 1;
if(location.href.indexOf('noBump')==-1) plenkaPBRTextured.microSurface = 1;
if(location.href.indexOf('noBump')==-1) plenkaPBRTextured.microSurfaceTexture = new BABYLON.Texture("http://cablegen.sianlab.site/textures/aluminium/TexturesCom_Metal_AluminumBrushed_512_metallic.png",scene);
plenkaPBRTextured.reflectionTexture = new BABYLON.Texture("../../textures/copper/TexturesCom_RepolishedCopper_1K_metallic.png",scene);
plenkaPBRTextured.metallic = 1;
plenkaPBRTextured.roughness = 0.5;
plenkaPBRTextured.alpha = 0.9;
plenkaPBRTextured.sheen.isEnabled = true;
plenkaPBRTextured.sheen.intensity = 0.001;
plenkaPBRTextured.sheen.linkSheenWithAlbedo = false;
/*
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

*/

var plasticPBRGrey = new BABYLON.PBRMaterial("plasticPBRGrey",scene);
plasticPBRGrey.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRGrey.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRGrey.microSurface = 1;
if(location.href.indexOf('noBump')==-1) {plasticPBRGrey.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.jpg",scene);
    plasticPBRGrey.metallic = 0.2;
    plasticPBRGrey.roughness = 0.7;
}else {
    plasticPBRGrey.metallic = 0.11;
    plasticPBRGrey.roughness = 0.97;
}
plasticPBRGrey.metallicTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg");
plasticPBRGrey.roughnessTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.jpg");
plasticPBRGrey.roughness = 0.7;
plasticPBRGrey.sheen.isEnabled = true;
plasticPBRGrey.sheen.intensity = 0.1;
plasticPBRGrey.metallicF0Factor = 0.3;
/*
var plasticPBRGreyForCut = new BABYLON.PBRMaterial("plasticPBRGreyForCut",scene);
plasticPBRGreyForCut.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.png");
plasticPBRGreyForCut.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRGreyForCut.microSurface = 1;
plasticPBRGreyForCut.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png",scene);
plasticPBRGreyForCut.metallic = 0.2;
plasticPBRGreyForCut.metallicTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRGreyForCut.roughnessTexture =  new BABYLON.Texture("../../textures/plastic/scuffed-plastic2-alb_1.png");
plasticPBRGreyForCut.roughness = 0.7;
plasticPBRGreyForCut.sheen.isEnabled = false;
plasticPBRGreyForCut.metallicF0Factor = 0.3;
*/
/*
var plasticPBRBlue = new BABYLON.PBRMaterial("plasticPBRBlue",scene);
plasticPBRBlue.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic8-alb.jpg");
plasticPBRBlue.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg");
plasticPBRBlue.bumpTexture.level =2
plasticPBRBlue.microSurface = 1;
plasticPBRBlue.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg",scene);
plasticPBRBlue.metallic = 0.2;
plasticPBRBlue.roughness = 0.5;
plasticPBRBlue.sheen.isEnabled = true;
plasticPBRBlue.sheen.intensity = 0.2;
*/
/*
var plasticPBRBlack = new BABYLON.PBRMaterial("plasticPBRBlack",scene);
plasticPBRBlack.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic7-alb.png");
plasticPBRBlack.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png");
plasticPBRBlack.microSurface = 0.5;
plasticPBRBlack.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.png",scene);
plasticPBRBlack.metallic = 0.15;
plasticPBRBlack.roughness = 0.5;
plasticPBRBlack.sheen.isEnabled = true;
plasticPBRBlack.sheen.intensity = 0.2;

*/
var plasticPBRGround = new BABYLON.PBRMaterial("plasticPBRGround",scene);
plasticPBRGround.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic9-alb.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRGround.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRGround.microSurface = 0.5;
if(location.href.indexOf('noBump')==-1) {plasticPBRGround.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.jpg",scene);
    plasticPBRGround.metallic = 0.15;
    plasticPBRGround.roughness = 0.5;
}else {
    plasticPBRGround.metallic = 0.11;
    plasticPBRGround.roughness = 0.97;
}
plasticPBRGround.sheen.isEnabled = true;
plasticPBRGround.sheen.intensity = 0.2;


var plasticPBRPink = new BABYLON.PBRMaterial("plasticPBRPink",scene);
plasticPBRPink.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic10-alb.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRPink.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRPink.microSurface = 0.5;
if(location.href.indexOf('noBump')==-1){ plasticPBRPink.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.jpg",scene);
plasticPBRPink.metallic = 0.15;
plasticPBRPink.roughness = 0.5;}else {
    plasticPBRPink.metallic = 0.11;
    plasticPBRPink.roughness = 0.97;
}
plasticPBRPink.sheen.isEnabled = true;
plasticPBRPink.sheen.intensity = 0.2;


var plasticPBRLightBlue = new BABYLON.PBRMaterial("plasticPBRLightBlue",scene);
plasticPBRLightBlue.albedoTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic11-alb.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRLightBlue.bumpTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-normal.jpg");
if(location.href.indexOf('noBump')==-1) plasticPBRLightBlue.microSurface = 0.5;
if(location.href.indexOf('noBump')==-1) {plasticPBRLightBlue.microSurfaceTexture = new BABYLON.Texture("../../textures/plastic/scuffed-plastic-ao.jpg",scene);
    plasticPBRLightBlue.metallic = 0.15;
    plasticPBRLightBlue.roughness = 0.5;
}else {
    plasticPBRLightBlue.metallic = 0.11;
    plasticPBRLightBlue.roughness = 0.97;
}
plasticPBRLightBlue.metallic = 0.15;
plasticPBRLightBlue.roughness = 0.5;
plasticPBRLightBlue.sheen.isEnabled = true;
plasticPBRLightBlue.sheen.intensity = 0.2;


var ropePBR = new BABYLON.PBRMaterial('ropePBR',scene);
ropePBR.albedoTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Color.jpg");
if(location.href.indexOf('noBump')==-1) ropePBR.bumpTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Normal.jpg");
if(location.href.indexOf('noBump')==-1) ropePBR.microSurface = 1;
if(location.href.indexOf('noBump')==-1) ropePBR.microSurfaceTexture = new BABYLON.Texture("../../textures/rope/Rope002_1K_Displacement.jpg",scene);
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

/*
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
*/

if(location.href.indexOf('noHDR')==-1)
{
var hdrTexture =  new BABYLON.HDRCubeTexture("../../textures/cubemap/sky/reinforced_concrete_02_1k.hdr", scene, 128, false, true, false, true);
scene.environmentTexture = hdrTexture;
}

scene.fogMode = BABYLON.Scene.FOGMODE_EXP;
scene.fogDensity = 0.002;

var materialCollection = [];
materialCollection[0] = blackPBRTexturedShiny;
materialCollection[1] = blackPBRTextured;
materialCollection[2] = plasticPBRPink;
materialCollection[3] = plasticPBRGrey;
materialCollection[4] = plasticPBRLightBlue;
materialCollection[5] = plasticPBRGround;
materialCollection[6] = ropePBR;
materialCollection[7] = blackPBRTextured;


if(location.href.indexOf('noBump')!=-1)
{
    for(var mI=0;mI<materialCollection.length;mI++)
    {
       // materialCollection[mI].bumpTexture =  false;
    }
}
