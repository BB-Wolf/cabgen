var copper = new BABYLON.StandardMaterial("copper", scene);
copper.diffuseTexture = new BABYLON.Texture("./copper.jpg", scene);
copper.bumpTexture = new BABYLON.Texture("./NormalMap.png", scene);


var plusLine = new BABYLON.StandardMaterial("pl", scene);
plusLine.diffuseColor = new BABYLON.Color3(0.05, 0.0, 0.7);
plusLine.bumpTexture = new BABYLON.Texture("./bmp.png", scene);
plusLine.specularColor = new BABYLON.Color3(0.15, 0.15, 0.15);
plusLine.bumpTexture.level = 0.3;
plusLine.bumpTexture.vAng = 90;
plusLine.bumpTexture.wAng = 90;


var nullLine = new BABYLON.StandardMaterial("nl", scene);
nullLine.diffuseColor = new BABYLON.Color3(0.12, 0.01, 0.0);
nullLine.bumpTexture = new BABYLON.Texture("./bmp.png", scene);
nullLine.bumpTexture.level = 0.3;
nullLine.specularColor = new BABYLON.Color3(0.09, 0.09, 0.09);
nullLine.bumpTexture.vAng = 90;
nullLine.bumpTexture.wAng = 90;
nullLine.forceIrradianceInFragment = true;


var nullLinePBR = new BABYLON.PBRMaterial("pbr", scene);
nullLinePBR.albedoColor = new BABYLON.Color3(210, 105, 30);
//    nullLinePBR.reflectivityColor = new BABYLON.Color3(1.0, 0.766, 0.736);
nullLinePBR.metallic = 1.1;
nullLinePBR.roughness = 0.09;
nullLinePBR.bumpTexture = new BABYLON.Texture("./bmp.png", scene);
nullLinePBR.bumpTexture.level = 0.8;
nullLinePBR.bumpTexture.vAng = 90;
nullLinePBR.bumpTexture.wAng = 90;
nullLinePBR.forceIrradianceInFragment = true;


var plusLinePBR = new BABYLON.PBRMaterial("pbrpl", scene);
//  plusLinePBR.diffuseColor = new BABYLON.Color3(1.0,0.0, 1.0);
plusLinePBR.albedoColor = new BABYLON.Color3(6, 6, 255);
plusLinePBR.reflectivityColor = new BABYLON.Color3(1.0, 1.0, 1.0);
plusLinePBR.metallic = 1.9;
plusLinePBR.roughness = 0.09;
plusLinePBR.bumpTexture = new BABYLON.Texture("./bmp.png", scene);
plusLinePBR.bumpTexture.level = 0.8;
plusLinePBR.bumpTexture.vAng = 90;
plusLinePBR.bumpTexture.wAng = 90;
plusLinePBR.forceIrradianceInFragment = true;



var pvhPBR = new BABYLON.PBRMaterial("pbrPvh", scene);
pvhPBR.diffuseColor = new BABYLON.Color3(213, 213, 113);
//pvhPBR.albedoColor =  new BABYLON.Color3(1.0, 0.7, 0.7);
pvhPBR.reflectivityColor = new BABYLON.Color3(0.3, 0.3, 0.3);
pvhPBR.metallic = 0.3;
pvhPBR.roughness = 1.0;
pvhPBR.forceIrradianceInFragment = true;
pvhPBR.bumpTexture = new BABYLON.Texture("./bmp.png", scene); 
pvhPBR.clearCoat.isEnabled = true;
pvhPBR.clearCoat.intensity =1.0;
pvhPBR.bumpTexture.vAng = 50;
pvhPBR.bumpTexture.wAng = 90;
pvhPBR.bumpTexture.level = 0.8; 
pvhPBR.clearCoat.bumpTexture =  new BABYLON.Texture("./bmp.png", scene); 


var pvh = new BABYLON.StandardMaterial('pvh', scene);
pvh.diffuseColor = new BABYLON.Color3(0.53, 0.53, 0.53);

//  pvhPBR.bumpTexture = new BABYLON.Texture("./nm2.png", scene);

var alumPBR = new BABYLON.PBRMetallicRoughnessMaterial("pbrPvh", scene);
alumPBR.baseColor = new BABYLON.Color3(0.633, 0.635, 0.637)
//     alumPBR.albedoColor = new BABYLON.Color3(0.9, 0.9, 0.9);
alumPBR.reflectivityColor = new BABYLON.Color3(0.7, 0.7, 0.7);
alumPBR.metallic = 5.0;
alumPBR.roughness = 0.5;
alumPBR.bumpTexture = new BABYLON.Texture("./nm2.png", scene);
alumPBR.bumpTexture.vAng = 80;
alumPBR.bumpTexture.wAng = 100;
alumPBR.bumpTexture.level = 10.5;

var copperPBR = new BABYLON.PBRMetallicRoughnessMaterial("pbrCop", scene);
// var copperPBR = new BABYLON.PBRMaterial("pbrCop", scene);
copperPBR.baseTexture = new BABYLON.Texture("./copper_new.jpg", scene);//copperPBR.albedoTexture = new BABYLON.Texture("./copper_new.jpg", scene);
copperPBR.reflectivityTexture = new BABYLON.Texture("./copper_new_spec.png", scene);



// copperPBR.albedoColor = new BABYLON.Color3(0.5, 0.150, 0.16);
copperPBR.reflectivityColor = new BABYLON.Color3(1.0, 0.766, 0.736);
copperPBR.metallic = 3.0;
copperPBR.roughness = .5;
copperPBR.reflectivityTexture.wAng = 80;
copperPBR.forceIrradianceInFragment = true;
copperPBR.bumpTexture = new BABYLON.Texture("./copper_new_bmp.png", scene);
copperPBR.bumpTexture.vAng = 80;
copperPBR.bumpTexture.wAng = 100;
copperPBR.bumpTexture.level =3;
copperPBR.microSurfaceTexture =  new BABYLON.Texture("./copper_new_bmp.png", scene);


var black = new BABYLON.StandardMaterial("black", scene);
black.diffuseColor = new BABYLON.Color3(0.1, 0.1, 0.1);
black.bumpTexture = new BABYLON.Texture("./bmp.png", scene);
black.bumpTexture.vAng = 70;
black.bumpTexture.wAng = 90;


var blacknobump = new BABYLON.StandardMaterial("black", scene);
blacknobump.diffuseColor = new BABYLON.Color3(0.1, 0.1, 0.1);


var blackPBR = new BABYLON.PBRMaterial("pbr", scene);
blackPBR.albedoColor = new BABYLON.Color3(0.0001, 0.0001, 0.0001);
blackPBR.reflectivityColor = new BABYLON.Color3(0.05, 0.05, 0.05);
blackPBR.microSurface = 1;

//blackPBR.albedoColor = new BABYLON.Color3(1.0, 0.766, 0.336);
//blackPBR.reflectivityColor = new BABYLON.Color3(0.0, 0.766, 0.336);

blackPBR.forceIrradianceInFragment = true;
blackPBR.bumpTexture = new BABYLON.Texture("./bmp.png", scene); 
blackPBR.bumpTexture.vAng = 50;
blackPBR.bumpTexture.wAng = 90;
blackPBR.bumpTexture.level = 1; 